<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Pelatihan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f7f7f7; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <h2 style="color: #2c3e50;">Selamat, <span style="color: #27ae60;">Anda Telah Menyelesaikan Pelatihan!</span></h2>

        <p>Halo <strong>{{ $nama }}</strong>,</p>

        <p>Terima kasih telah mengikuti pelatihan <strong>{{ $pelatihan }}</strong>. Kami sangat mengapresiasi partisipasi Anda.</p>

        <p><strong>Data Peserta:</strong></p>
        <ul style="list-style: none; padding-left: 0;">
            <li><strong>Nama:</strong> {{ $nama }}</li>
            <li><strong>Instansi:</strong> {{ $instansi }}</li>
            <li><strong>No. Telepon:</strong> {{ $telp }}</li>
            <li><strong>Pelatihan:</strong> {{ $pelatihan }}</li>
        </ul>

        <p><strong>Sertifikat Anda:</strong></p>

        @isset($sertifikatCid)
            <div style="text-align: center; margin: 20px 0;">
                <img src="{{ $sertifikatCid }}" alt="Sertifikat" style="max-width: 100%; border: 1px solid #ccc; border-radius: 6px; padding: 5px;">
            </div>
        @else
            <p style="color: red;">(Sertifikat dilampirkan sebagai file, tidak bisa ditampilkan langsung.)</p>
        @endisset

        <p>Sertifikat ini juga telah dilampirkan dan dapat Anda unduh langsung dari email ini.</p>

        <p>Semoga pelatihan ini bermanfaat dan menambah wawasan Anda.</p>

        <p style="margin-top: 30px;">Salam hangat,<br><strong>Panitia Pelatihan</strong></p>
    </div>
</body>
</html>
