@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header">{{ __('Edit User') }}</div>
            <form action="{{route('user.update', $user->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{$user->name}}">
                        @error('name')
                        <span class="invalid-pengaduan" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{$user->email}}">
                        @error('email')
                        <span class="invalid-pengaduan" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password">
                        @error('password')
                        <span class="invalid-pengaduan" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Role</label>
                        <select name="role" id="role" class="form-control
                         @error('role') is-invalid @enderror" required>
                            <option value="">Silahkan Pilih</option>
                            <option value="admin"
                                {{ old('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="user"
                                {{ old('role') == 'user' ? 'selected' : '' }}>
                                User
                            </option>
                        </select>
                        @error('role')
                        <span class="invalid-pengaduan" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
