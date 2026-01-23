@extends('layouts.main')

@section('title', 'Login Billman Absensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-8">
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white text-center">
                <h5>Login Billman Absensi</h5>
            </div>
            <div class="card-body">
                <!-- Alert Error -->
                <div id="alert-container">
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>

                <!-- Form Login -->
                <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="kata_sandi" class="form-label">Kata Sandi</label>
                        <input type="password" name="kata_sandi" class="form-control" id="kata_sandi" required>
                    </div>

                    <button type="submit" id="btnLogin" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                &copy; {{ date('Y') }} Billman Absensi
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('kata_sandi').value.trim();

    if (!email || !password) {
        e.preventDefault();
        alert('Email dan Kata Sandi wajib diisi!');
    } else {
        // Disable tombol saat submit
        document.getElementById('btnLogin').disabled = true;
        document.getElementById('btnLogin').innerText = 'Loading...';
    }
});
</script>
@endsection
