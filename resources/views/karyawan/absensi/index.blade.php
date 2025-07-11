@extends('layouts.templates.main_karyawan')

@section('content')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @if ($tipe)
        <form id="absensiForm" method="POST" action="{{ route('karyawan.absensi.store') }}">
            @csrf
            <input type="hidden" name="image_data" id="fotoInput">
            <input type="hidden" name="lokasi" id="lokasiInput">
            <input type="hidden" name="tipe" value="{{ $tipe }}">

            <div class="row g-3 align-items-stretch">
                <div class="col d-flex flex-column">
                    <div class="mb-3 w-100 border rounded overflow-hidden flex-fill" style="background-color: black;">
                        <video id="video" class="w-100 h-auto d-block" autoplay></video>
                        <canvas id="canvas" class="d-none"></canvas>
                    </div>
                    <button type="button" onclick="capture()" class="btn btn-primary w-100"><i class="fas fa-camera me-2"></i>
                        Ambil Foto</button>
                </div>

                <div class="col d-flex flex-column">
                    <div class="mb-3 w-100 border rounded overflow-hidden flex-fill d-flex justify-content-center align-items-center"
                        style="background-color: black;">
                        <img id="preview" src="" alt="Preview" style="display:none;">
                    </div>
                    <button id="sendBtn" type="button" onclick="send()" class="btn btn-success w-100" disabled><i
                            class="fas fa-check me-2"></i> Kirim
                        Absensi</button>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex flex-column my-4">
                    <span id="koordinat">Mendeteksi lokasi...</span>
                    <span id="lokasiDisplay" class="d-none">Lokasi: (Loading...)</span>
                </div>
            </div>
        </form>
        <script src="<?= asset('js/webcam-easy.min.js') ?>"></script>
        <script>
            const koordinat = document.getElementById('koordinat');
            const lokasiDisplay = document.getElementById('lokasiDisplay');
            let displayLocation = null;

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

            initLocation();

            function initLocation() {
                getLocation()
                    .then(async (coords) => {
                        koordinat.textContent = `Koordinat: ${coords[0]}, ${coords[1]}`;
                        document.getElementById('lokasiInput').value = `${coords[0]}, ${coords[1]}`;
                        try {
                            lokasiDisplay.classList.remove('d-none');
                            const res = await fetch(`https://api-bdc.net/data/reverse-geocode-client?latitude=${coords[0]}&longitude=${coords[1]}&localityLanguage=id`);
                            const data = await res.json();
                            displayLocation = `${data.localityInfo.administrative[3].name}, ${data.localityInfo.administrative[2].name}`;
                            lokasiDisplay.innerHTML = `Lokasi: ${displayLocation} <a href="https://www.google.com/maps?q=${document.getElementById('lokasiInput').value}" target="_blank">Lihat</a>`;
                        } catch (err) {
                            lokasiDisplay.innerHTML = `Lokasi: Gagal mendapatkan lokasi. <a href="#" onclick="initLocation()">Refresh</a>`;
                        }
                    })
                    .catch((err) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal mendapatkan lokasi. Pastikan izin lokasi aktif.',
                        });
                    });
            }

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

                ctx.textAlign = 'left';
                ctx.fillText('<?= $nama ?>', 10, 25);

                // Nama di pojok kiri bawah
                ctx.textAlign = 'left';
                if (displayLocation) ctx.fillText(displayLocation, 10, canvasElement.height - 10);

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

            function send() {
                const form = document.getElementById('absensiForm');
                const fotoInput = document.getElementById('fotoInput');

                if (!previewElement.src || previewElement.src === window.location.href) {
                    alert("Silakan ambil foto dulu!");
                    return;
                }

                fotoInput.value = previewElement.src;

                form.submit();
            }
        </script>
    @endif
@endsection