<!DOCTYPE html>
<html>
<head>
    <title>{{ $book['title'] ?? 'Detail Buku' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #FFD700, #FF8C00);
            color: #fff;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #C62828;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .book-image {
            width: 40%;
        }

        .book-image img {
            width: 100%;
            border-radius: 10px;
        }

        .book-info {
            width: 55%;
        }

        h1, h3, p, li {
            color: white;
        }

        ul {
            padding-left: 20px;
        }

        .price {
            margin-top: 25px;
            font-size: 24px;
            font-weight: bold;
            color: rgb(249, 249, 249);
        }

        .pay-box {
            margin-top: 30px;
            background-color: #C62828;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .pay-box button {
            background-color:rgb(255, 213, 0);
            color: white;
            padding: 12px 25px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .pay-box button:hover {
            background-color:rgb(159, 133, 0);
        }

        .info-box {
            display: none;
            margin-top: 15px;
            background-color: #fff3cd;
            color: #856404;
            padding: 12px;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .book-image, .book-info {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="book-image">
            <img src="{{ asset('biz') }}/assets/img/portfolio/bukus.jpg" alt="Cover Buku">
        </div>

        <div class="book-info">
            <h1>{{ $book['title'] }}</h1>

            <p><strong>Deskripsi:</strong></p>
            <p>{{ $book['description'] }}</p>

            <h3>Benefit dari buku ini jika dibeli:</h3>
            <ul>
                @foreach ($book['benefits'] as $benefit)
                    <li>{{ $benefit }}</li>
                @endforeach
            </ul>

            <p class="price">Harga buku: Rp{{ number_format($book['price'], 0, ',', '.') }}</p>

            <div class="pay-box">
                <p style="color: white; font-weight: bold; font-size: 18px;">Tertarik? Segera bayar sekarang!</p>
                <button onclick="showInfo()">Bayar Sekarang</button>
                <div class="info-box" id="infoBox">
                    Fitur pembayaran belum tersedia. Silakan coba lagi nanti.
                </div>
            </div>
        </div>
    </div>

    <script>
        function showInfo() {
            document.getElementById("infoBox").style.display = "block";
        }
    </script>
</body>
</html>
