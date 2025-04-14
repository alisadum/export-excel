<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d1b08d;
            font-family: 'Comic Sans MS', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
        }

        h4 {
            text-align: center;
            color: #3e5c43;
            font-size: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .btn-primary,
        .btn-success {
            font-size: 1.2rem;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Agar tabel lebih kecil */
        table {
            border: 2px solid #3e5c43;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.9rem;
            /* Ukuran font lebih kecil */
        }

        thead th {
            background-color: #8b6e4f !important;
            /* Coklat gelap untuk judul tabel */
            color: white;
            padding: 10px;
            /* Padding lebih kecil */
            text-align: center;
            font-size: 1rem;
            /* Ukuran font sedikit lebih kecil */
        }

        td {
            text-align: center;
            padding: 10px;
            /* Padding lebih kecil */
            font-size: 1rem;
            /* Ukuran font sedikit lebih kecil */
        }

        tr:nth-child(even) {
            background-color: #e2e9d1;
        }

        /* Menambahkan jarak antara tombol dan tabel */
        .d-flex {
            margin-bottom: 20px;
            /* Jarak antara tombol dan tabel */
        }

        .modal-content {
            border-radius: 15px;
            background-color: #e2e9d1;
        }

        .modal-header {
            background-color: #3e5c43;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .modal-title {
            font-size: 1.5rem;
        }

        .btn-close {
            background-color: #3e5c43;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="mb-3">
            <h4>Dashboard Pengguna</h4>
        </div>

        <div class="d-flex justify-content-start align-items-center mb-5">
            <a href="{{ url('users/export') }}" class="btn btn-success me-3">Export ke Excel</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formUserModal">
                Tambahkan User
            </button>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tabel User --}}
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Dibuat</th>
                    <th>Diupdate</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="formUserModal" tabindex="-1" aria-labelledby="formUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formUserModalLabel">Tambahkan User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success w-100">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
