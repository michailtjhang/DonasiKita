@extends('Backend.layouts.app')

@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User List</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page_title }}</li>
            </ol>
        </nav>
        <div class="card-body">
            <form action="{{ route('user.update', $data['user']->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $data['user']->name }}"
                            placeholder="Please Enter Name">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ $data['user']->email }}"
                            placeholder="Please Enter Email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>

                    <select class="custom-select rounded-0 @error('role_id') is-invalid @enderror" id="role"
                        name="role_id">
                        <option>Select</option>

                        @foreach ($data['role'] as $row)
                            <option value="{{ $row->id }}" {{ $data['user']->role_id == $row->id ? 'selected' : '' }}>
                                {{ $row->name }}</option>
                        @endforeach

                    </select>

                    @error('role_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Please Enter Password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="col-8 mt-2">
                        <div class="icheck-primary">
                            <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                            <label for="showPassword">
                                Show Password
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            *Gunakan password yang kuat (minimal 8 karakter) untuk menjaga keamanan akun Anda.*
                            <br>(Do you want to change password? Please enter new password. Otherwise leave it blank)
                        </small>
                    </div>

                </div>

                <div class="col d-flex justify-content-between align-items-center mt-3">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-success">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
@endsection
