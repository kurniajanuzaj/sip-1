@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data User') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                                <td>
                                    <form action="{{route('user.delete', $item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('user.edit',$item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                        <button class="btn btn-sm btn-warning">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $user->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-header">{{ __('Add User') }}</div>
            <form action="{{route('user.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                    @error('name')
                    <span class="invalid-pengaduan" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <span class="invalid-pengaduan" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
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
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                            User
                        </option>
                    </select>
                    @error('role')
                    <span class="invalid-pengaduan" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
