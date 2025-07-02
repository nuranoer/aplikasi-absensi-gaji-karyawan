@extends('layouts.templates.main_karyawan')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4 text-center">Absensi Menggunakan Kamera</h4>

            <form method="POST" action="{{ route('absensi.kamera.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="image_data" id="fotoInput">
                <input type="hidden" name="lokasi" id="lokasiInput">
                <input type="hidden" name="user_agent" value="{{ request()->header('User-Agent') }}">
                <input type="hidden" name="status" value="hadir">

                <div class="text-center mb-3">
                    <video id="video" width="100%" height="300" autoplay class="border rounded"></video>
                </div>

                <div class="text-center mb-3">
                    <button type="button" id="ambilFotoBtn" class="btn btn-primary me-2">📸 Ambil Foto</button>
                    <button type="submit" class="btn btn-success">✅ Kirim Absensi</button>
                </div>

                <div class="text-center">
                    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
                    <img id="preview" src="" alt="Preview" class="img-fluid rounded shadow-sm mt-3" style="display:none; max-width: 100%;">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('video');
    const canvas = document.createElement('canvas'); // canvas tersembunyi untuk ambil gambar
    const preview = document.getElementById('preview');
    const fotoInput = document.getElementById('fotoInput');

    // 🔄 Aktifkan kamera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            console.log('✅ Kamera berhasil diakses');
        })
        .catch(error => {
            console.error("❌ Tidak bisa mengakses kamera:", error);
            alert("Gagal akses kamera: " + error.message);
        });

    // 📸 Ambil foto
    document.getElementById('ambilFotoBtn').addEventListener('click', () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = canvas.toDataURL('image/png');
        preview.src = imageData;
        preview.style.display = 'block';
        fotoInput.value = imageData;
        console.log('📷 Foto diambil & ditampilkan');
    });
});
</script>
@endpush


