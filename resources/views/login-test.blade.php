@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <strong>Login Billman Absensi</strong>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
