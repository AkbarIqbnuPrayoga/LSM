<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Validasi Bukti Pembayaran</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px; line-height: 1.6;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        
        <h2 style="color: #27ae60;">Bukti Pembayaran Telah Divalidasi ✅</h2>

        <p>Halo <strong>{{ $pendaftaran['nama_user'] ?? 'Peserta' }}</strong>,</p>

        <p>Selamat! Bukti pembayaran Anda untuk pelatihan berikut telah berhasil divalidasi oleh admin kami:</p>

        <ul style="list-style: none; padding: 0;">
            <li><strong>Nama Pelatihan:</strong> {{ $pendaftaran['nama_pelatihan'] }}</li>
            <li><strong>Tanggal Pelatihan:</strong> {{ \Carbon\Carbon::parse($pendaftaran['tanggal_pelatihan'])->format('d-m-Y') }}</li>
            <li><strong>Mode:</strong> {{ ucfirst($pendaftaran['mode']) }}</li>
        </ul>

        @if($pendaftaran['mode'] === 'online')
        <div style="background-color: #ecf0f1; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <strong>Catatan:</strong><br>
            Pelatihan ini akan dilakukan secara online. Link Zoom akan dikirim H-1 melalui email dan WhatsApp.
        </div>
        @endif

        <p>Terima kasih atas partisipasi Anda. Kami tidak sabar menyambut Anda dalam sesi pelatihan.</p>

        <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami melalui email ini atau melalui kontak resmi LSM.</p>

        <p style="margin-top: 30px;">Salam hangat,<br>
        <strong>Panitia Pelatihan LSM</strong></p>
    </div>
</body>
</html>
