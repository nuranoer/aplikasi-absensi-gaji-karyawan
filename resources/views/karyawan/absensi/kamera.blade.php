@extends('layouts.templates.main_karyawan')
@section('title', 'Absensi')

@section('content')
    @if ($available)
        <form id="absensiForm" method="POST" action="{{ route('karyawan.absensi.kamera.store') }}">
            @csrf
            <input type="hidden" name="image_data" id="fotoInput">
            <input type="hidden" name="lokasi" id="lokasiInput">
            <input type="hidden" name="user_agent" value="{{ request()->header('User-Agent') }}">
            <input type="hidden" name="status" value="hadir">

            <div class="row g-3 align-items-stretch">
                <div class="col d-flex flex-column">
                    <div class="mb-3 w-100 border rounded overflow-hidden flex-fill" style="background-color: black;">
                        <video id="video" class="w-100 h-auto d-block" autoplay></video>
                        <canvas id="canvas" class="d-none"></canvas>
                    </div>
                    <button type="button" onclick="capture()" class="btn btn-primary w-100">📸 Ambil Foto</button>
                </div>

                <div class="col d-flex flex-column">
                    <div
                        class="mb-3 w-100 border rounded overflow-hidden flex-fill d-flex justify-content-center align-items-center">
                        <img id="preview" src="" alt="Preview" style="display:none;">
                    </div>
                    <button id="sendBtn" type="button" onclick="send()" class="btn btn-success w-100" disabled>✅ Kirim
                        Absensi</button>
                </div>
            </div>
        </form>
        <script src="<?= asset('js/webcam-easy.min.js') ?>"></script>
        <script>
            const sendBtn = document.getElementById('sendBtn');
            const videoElement = document.getElementById('video');
            const canvasElement = document.getElementById('canvas');
            const ctx = canvasElement.getContext('2d');
            const previewElement = document.getElementById('preview');
            const webcam = new Webcam(videoElement, 'user', canvasElement);
            webcam.start()
                .then(result => {
                    console.log("webcam started");
                })
                .catch(err => {
                    console.log(err);
                });

            function getLocation() {
                return new Promise((resolve, reject) => {
                    if ('geolocation' in navigator) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                resolve([position.coords.latitude, position.coords.longitude]);
                            },
                            (err) => {
                                reject(err);
                            }
                        )
                    } else {
                        reject("Browser tidak support!");
                    }
                });
            }

            function capture() {
                canvasElement.height = videoElement.scrollHeight;
                canvasElement.width = videoElement.scrollWidth;

                ctx.clearRect(0, 0, canvasElement.width, canvasElement.height);

                ctx.save();
                ctx.translate(canvasElement.width, 0);
                ctx.scale(-1, 1);
                ctx.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
                ctx.restore();

                ctx.font = '14px Arial';
                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                ctx.textBaseline = 'bottom';

                // Nama di pojok kiri bawah
                ctx.textAlign = 'left';
                ctx.fillText('<?= $nama ?>', 10, canvasElement.height - 10);

                // Timestamp di pojok kanan bawah
                const now = new Date();
                const timestamp = dayjs().format('YYYY-MM-DD HH:mm:ss');

                ctx.textAlign = 'right';
                ctx.fillText(timestamp, canvasElement.width - 10, canvasElement.height - 10);

                const image = canvasElement.toDataURL('image/jpeg');
                if (image) {
                    previewElement.src = image;
                    previewElement.style = 'block';

                    sendBtn.removeAttribute('disabled');
                }
            }

            async function send() {
                try {
                    const form = document.getElementById('absensiForm');
                    const fotoInput = document.getElementById('fotoInput');
                    const lokasiInput = document.getElementById('lokasiInput');

                    if (!previewElement.src || previewElement.src === window.location.href) {
                        alert("Silakan ambil foto dulu!");
                        return;
                    }

                    const [lat, long] = await getLocation();
                    fotoInput.value = previewElement.src;
                    lokasiInput.value = `${lat}, ${long}`;

                    form.submit();
                } catch (err) {
                    console.error(err);
                    alert("Gagal mendapatkan lokasi. Pastikan izin lokasi aktif.");
                }
            }
        </script>
    @else
        <div class="alert alert-success" role="alert">
            Anda telah melakukan absensi atau perizinan hari ini.
        </div>
    @endif
@endsection

@push('scripts')
@endpush