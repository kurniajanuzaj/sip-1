@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                                    <a href="{{route('pengaduan.show', $item->id)}}" class="btn btn-sm btn-primary">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
