@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    Pelapor : {{ $pengaduan->user->name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{$pengaduan->judul}}</h1>
                            <span>{{ $pengaduan->no_aduan }} / {{ $pengaduan->tanggal }}</span>
                            <h3>{{$pengaduan->isi_laporan}}</h3>
                            @if (Auth::user()->role == 'admin')
                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                data-target="#exampleModal">{{ $pengaduan->status }}</button>
                            @else
                            <button type="button" class="btn btn-sm btn-outline-primary">{{ $pengaduan->status }}</button>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <img src="{{ asset($pengaduan->foto) }}" class="rounded float-right responsive" alt="Lampiran"
                                width="500pz">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('tanggapan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="text" name="pengaduan_id" value="{{$pengaduan->id}}" hidden>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Tanggapan Laporan</label>
                                    <textarea class="form-control @error('isi_laporan') is-invalid @enderror" rows="3" name="isi_laporan"></textarea>
                                    @error('isi_laporan')
                                    <span class="invalid-pengaduan" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control
                                  @error('status') is-invalid @enderror" required>
                                        <option value="">Silahkan Pilih</option>
                                        <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>
                                            Process
                                        </option>
                                        <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>
                                            Complete
                                        </option>
                                        <option value="spam" {{ old('status') == 'spam' ? 'selected' : '' }}>
                                            Spam
                                        </option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-pengaduan" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            @if ($pengaduan->tanggapan)
            <div class="card mb-4">
                <div class="card-header">
                    Tanggapan
                </div>
                <div class="card-body">
                    @foreach ($pengaduan->tanggapan as $tanggapan)
                    <div class="mb-4">
                        <span class="text-muted">
                            [{{ $tanggapan->tanggal }}]
                        </span>
                        <span>
                            {{ $tanggapan->isi_laporan }}
                        </span>
                        <strong>
                            ({{ $tanggapan->status }})
                        </strong>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
<div>
@endsection
