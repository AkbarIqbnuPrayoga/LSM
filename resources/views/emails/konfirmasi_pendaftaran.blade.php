<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pendaftaran Pelatihan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f7f7f7; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #2c3e50;">Terima kasih telah mendaftar <span style="color: #2980b9;">Pelatihan: {{ $data['pelatihan'] }}</span>!</h2>
        
        <p>Halo <strong>{{ $data['nama_lengkap'] }}</strong>,</p>
        <p>Terima kasih atas kepercayaan Anda untuk mengikuti pelatihan kami. Berikut adalah detail pendaftaran Anda:</p>

        <ul style="list-style: none; padding: 0;">
            <li><strong>Nama Lengkap:</strong> {{ $data['nama_lengkap'] }}</li>
            <li><strong>Email:</strong> {{ $data['email'] }}</li>
            <li><strong>No. Telepon:</strong> {{ $data['no_telp'] }}</li>
            <li><strong>Instansi:</strong> {{ $data['instansi'] }}</li>
            <li><strong>Pelatihan:</strong> {{ $data['pelatihan'] }}</li>
            <li><strong>Lokasi Pelatihan:</strong> {{ $data['lokasi'] ?? '-' }}</li>
        </ul>

        <p>Untuk menyelesaikan proses pendaftaran, silakan lakukan pembayaran ke rekening berikut:</p>

        <div style="background-color: #ecf0f1; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>No. Rekening:</strong> {{ $data['rekening'] ?? '-' }}<br>
            <strong>Bank:</strong> {{ $data['bank'] ?? '-' }}<br>
            <strong>a.n:</strong> {{ $data['atas_nama'] ?? '-' }}
        </div>

        <p>Setelah melakukan pembayaran, harap konfirmasi melalui website dengan mngupload bukti pembayaran.</p>

        <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>

        <p>Salam hangat,<br>
        <strong>Panitia PUSDIKLAT</strong></p>
    </div>
</body>
</html>
