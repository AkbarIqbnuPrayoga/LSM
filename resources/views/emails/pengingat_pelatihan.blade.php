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
            <li><strong>Tanggal Pelatihan:</strong> {{ \Carbon\Carbon::parse($pelatihan->tanggal)->locale('id')->translatedFormat('d F Y') }}</li>
            <li><strong>Waktu Pelatihan:</strong> {{ \Carbon\Carbon::parse($pelatihan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($pelatihan->waktu_selesai)->format('H:i') }} WIB</li>
            <li><strong>Mode:</strong> {{ ucfirst($pelatihan->tag) }}</li>

            @if(in_array($pelatihan->tag, ['offline', 'hybrid']))
            <li><strong>Lokasi:</strong> {{ $pelatihan->lokasi ?? '-' }}</li>
            @endif

            @if(in_array($pelatihan->tag, ['online', 'hybrid']))
            <li><strong>Link Zoom:</strong> {{ $pelatihan->zoom_link ?? '-' }}</li>
            @endif

            <li><strong>Pelatihan Akan Dimulai:</strong> {{ $selisihHari }} Hari Lagi</li>
        </ul>

        <p>Mohon pastikan Anda telah menyiapkan segala keperluan yang dibutuhkan untuk mengikuti pelatihan ini. Kami sangat menantikan kehadiran Anda.</p>

        @if($pelatihan->tag == 'online')
        <div style="background-color: #ecf0f1; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Catatan:</strong><br>
            Pelatihan ini akan dilakukan secara online melalui Zoom. Link Zoom tertera di atas. Harap bergabung 15 menit sebelum pelatihan dimulai.
        </div>
        @elseif($pelatihan->tag == 'hybrid')
        <div style="background-color: #ecf0f1; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Catatan:</strong><br>
            Pelatihan ini dilaksanakan secara hybrid: peserta dapat hadir di lokasi atau mengikuti melalui Zoom. Pastikan Anda memilih metode yang sesuai dan menyiapkan perlengkapan masing-masing.
        </div>
        @endif

        <p>Jika ada pertanyaan, silakan hubungi kami melalui email ini atau kontak resmi kami.</p>

        <p style="margin-top: 30px;">Sampai jumpa pada hari pelatihan!</p>

        <p>Salam hangat dari kami,<br>
        <strong>Panitia PUSDIKLAT</strong></p>
    </div>
</body>
</html>
