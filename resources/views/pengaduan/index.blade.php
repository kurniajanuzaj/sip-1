@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role == 'user')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pengaduan') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No Aduan</th>
                                <th>Nama Warga</th>
                                <th>Tanggal Lapor</th>
                                <th>Isi Judul</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $item)
                            <tr>
                                <td>{{$item->no_aduan}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->tanggal}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <a href="{{route('pengaduan.show', $item->id)}}"
                                        class="btn btn-sm btn-primary">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-header">{{ __('Lapor') }}</div>
            <form action="{{route('pengaduan.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                        placeholder="Judul Aduan">
                    @error('judul')
                    <span class="invalid-pengaduan" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Isi Aduan</label>
                    <textarea class="form-control @error('isi_laporan') is-invalid @enderror" rows="3"
                        name="isi_laporan"></textarea>
                    @error('isi_laporan')
                    <span class="invalid-pengaduan" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Upload Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                    @error('foto')
                    <span class="invalid-pengaduan" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        @elseif(Auth::user()->role == 'admin')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pengaduan') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No Aduan</th>
                                <th>Nama Warga</th>
                                <th>Tanggal Lapor</th>
                                <th>Isi Judul</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $item)
                            <tr>
                                <td>{{$item->no_aduan}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->tanggal}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <a href="{{route('pengaduan.show', $item->id)}}"
                                        class="btn btn-sm btn-primary">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
