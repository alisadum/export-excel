<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f4f1; /* Hijau Lumut yang lebih lembut */
            font-family: 'Comic Sans MS', sans-serif;
        }
        .container {
            border-radius: 15px;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h4 {
            color: #3e5c43; /* Hijau Lumut */
            font-size: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .btn-primary, .btn-success {
            font-size: 1.2rem;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .btn-primary:hover, .btn-success:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        table {
            border: 2px solid #3e5c43;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
            padding: 15px;
            font-size: 1.1rem;
        }
        th {
            background-color: #3e5c43;
            color: white;
            border-bottom: 2px solid #c3d0b8;
        }
        tr:nth-child(even) {
            background-color: #e2e9d1;
        }
        .modal-content {
            border-radius: 15px;
            background-color: #e2e9d1;
            animation: popUp 0.3s ease-out;
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

        @keyframes popUp {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <!-- Dashboard Pengguna Title -->
    <div class="mb-4">
        <h4>Dashboard Pengguna</h4>
    </div>

    <div class="d-flex justify-content-start align-items-center mb-3">
        <!-- Tombol untuk Export dan Tambah User di kiri -->
        <a href="{{ url('users/export') }}" class="btn btn-success me-3">Export ke Excel</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formUserModal">
            Tambah User
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel User --}}
    <table class="table table-bordered">
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

<!-- Modal untuk tambah user -->
<div class="modal fade" id="formUserModal" tabindex="-1" aria-labelledby="formUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formUserModalLabel">Tambah User</h5>
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
