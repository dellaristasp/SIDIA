<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Arsip</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f9;
            color: #333;
            padding: 20px;
        }

        header {
            background: #0056b3;
            padding: 10px 0;
            color: #fff;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container a {
            display: inline-block;
            background: #0056b3;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: background 0.3s ease;
        }

        .container a:hover {
            background: #004494;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #0056b3;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        footer {
            background: #0056b3;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            background: #0056b3;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #004494;
        }

        .alert {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tambah Arsip</h1>
    </header>

    <div class="container">
        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form untuk menambah arsip -->
        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <input type="text" id="description" name="description" required>
            </div>

            <div class="form-group">
                <label for="type">Jenis Arsip:</label>
                <select id="type" name="type" required>
                    <option value="">Pilih Jenis Arsip</option>
                    <option value="vital">Vital</option>
                    <option value="aktif">Aktif</option>
                    <option value="inaktif">Inaktif</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" id="file" name="file" required>
            </div>

            <button type="submit" class="btn">Simpan Arsip</button>
        </form>

        <!-- Tampilkan daftar arsip di sini -->
        <h2 class="mt-4">Daftar Arsip</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Jenis Arsip</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arsip as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ ucfirst($item->type) }}</td>
                        <td>
                            <a href="{{ route('arsip.edit', $item->id) }}" class="btn btn-info">Edit</a>

                            <!-- Form untuk menghapus arsip -->
                            <form action="{{ route('arsip.destroy', $item->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} SIDIA. All rights reserved.</p>
    </footer>
</body>

</html>
