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
            color:rgb(249, 249, 249);
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
        </div>
    </div>
</body>
</html>
