<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengingat Pelatihan Akan Dimulai dalam {{ $selisihHari }} Hari Lagi</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px; line-height: 1.6;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #e67e22;">
            Pengingat Pelatihan <span style="color: #2980b9;">{{ $pelatihan->nama }}</span> - Akan Dimulai {{ $selisihHari }} Hari
        </h2>

        <p>Halo <strong>{{ $pendaftaran->user->name ?? 'Peserta' }}</strong>,</p>
        <p>Ini adalah pengingat bahwa Anda telah mendaftar pada pelatihan berikut:</p>

        <ul style="list-style: none; padding: 0;">
            <li><strong>Nama Pelatihan:</strong> {{ $pelatihan->nama }}</li>
            <li><strong>Tanggal Pelatihan:</strong> {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d-m-Y') }}</li>
            <li><strong>Mode:</strong> {{ ucfirst($pelatihan->tag) }}</li>
            <li><strong>Pelatihan Akan Dimulai: </strong> {{ $selisihHari }} Hari Lagi</li>
            
        </ul>

        <p>Mohon pastikan Anda telah menyiapkan segala keperluan yang dibutuhkan untuk mengikuti pelatihan ini. Kami sangat menantikan kehadiran Anda.</p>

        @if($pelatihan->tag == 'online')
        <div style="background-color: #ecf0f1; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Catatan:</strong><br>
            Pelatihan ini akan dilakukan secara online. Link Zoom akan dikirim H-1 melalui email dan WhatsApp.
        </div>
        @endif

        <p>Jika ada pertanyaan, silakan hubungi kami melalui email ini atau melalui kontak resmi kami.</p>

        <p style="margin-top: 30px;">Sampai jumpa pada hari pelatihan!</p>

        <p>Salam hangat, Dari Panitia LSM<br>
        <strong>Panitia Pelatihan LSM</strong></p>
    </div>
</body>
</html>
