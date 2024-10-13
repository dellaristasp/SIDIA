<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Arsip</title>
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
    </style>
</head>

<body>
    <header>
        <h1>Daftar Arsip</h1>
    </header>

    <div class="container">
        <a href="{{ route('arsip.create') }}">Tambah Arsip</a>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <!-- Tampilkan daftar arsip di sini -->
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
                        <td>{{ $item->type }}</td>
                        <td>
                            <a href="{{ route('arsip.edit', $item->id) }}">Edit</a>
                            <a href="{{ route('arsip.destroy', $item->id) }}"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();">Hapus</a>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('arsip.destroy', $item->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
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
