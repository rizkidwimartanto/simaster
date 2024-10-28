<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <style>
        /* CSS untuk me-reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Mengatur tinggi dan lebar halaman agar konten berada di tengah */
        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
        }

        /* Container utama */
        .content {
            background-color: #ffffff;
            padding: 3rem; /* Menggunakan rem untuk padding */
            width: 90%;
            max-width: 70rem; /* Lebar maksimal dalam rem */
            border-radius: 1rem;
            box-shadow: 0px 0.625rem 1.25rem rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        /* Judul */
        .content h2 {
            text-align: center;
            font-size: 2rem;
            color: #4e54c8;
            margin-bottom: 2rem;
        }

        /* Styling untuk daftar informasi dalam dua kolom */
        .info-list {
            list-style: none;
            font-size: 1.2rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Dua kolom */
            gap: 1rem; /* Spasi antar item */
            max-height: 25rem;
            overflow-y: auto;
            padding-right: 0.625rem;
        }

        .info-list li {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            background-color: #f9f9f9;
        }

        .info-title {
            font-weight: bold;
            color: #333;
            flex: 1;
        }

        .info-data {
            color: #666;
            text-align: right;
            flex: 2;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 37.5rem) { /* 600px dalam rem */
            .info-list {
                grid-template-columns: 1fr; /* Satu kolom pada layar kecil */
            }
        }

        /* Animasi fadeIn */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-1.25rem); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="content">
    <h2>Data Pengguna</h2>
    <ul class="info-list">
        <li>
            <span class="info-title">Jenis Keypoint:</span>
            <span class="info-data">{{$keypoint->jenis_keypoint}}</span>
        </li>
        <li>
            <span class="info-title">Nomor Tiang:</span>
            <span class="info-data">{{$keypoint->nomor_tiang}}</span>
        </li>
        <li>
            <span class="info-title">Status Keypoint:</span>
            <span class="info-data">{{$keypoint->status_keypoint}}</span>
        </li>
        <li>
            <span class="info-title">Kondisi Keypoint:</span>
            <span class="info-data">{{$keypoint->kondisi_keypoint}}</span>
        </li>
        <li>
            <span class="info-title">Merk:</span>
            <span class="info-data">{{$keypoint->merk}}</span>
        </li>
        <li>
            <span class="info-title">No Seri:</span>
            <span class="info-data">{{$keypoint->no_seri}}</span>
        </li>
        <li>
            <span class="info-title">Setting OCR:</span>
            <span class="info-data">{{$keypoint->setting_ocr}}</span>
        </li>
        <li>
            <span class="info-title">Setting Grupaktif:</span>
            <span class="info-data">{{$keypoint->setting_grupaktif}}</span>
        </li>
        <li>
            <span class="info-title">Alamat:</span>
            <span class="info-data">{{$keypoint->alamat}}</span>
        </li>
        <li>
            <span class="info-title">Tanggal Har:</span>
            <span class="info-data">{{$keypoint->tanggal_har}}</span>
        </li>
        <li>
            <span class="info-title">Tanggal Pasang:</span>
            <span class="info-data">{{$keypoint->tanggal_pasang}}</span>
        </li>
    </ul>
</div>

</body>
</html>
