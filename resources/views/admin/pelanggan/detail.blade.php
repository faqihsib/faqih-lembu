@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Pelanggan: {{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</h1>
        </div>
        <div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<div class="row">
    {{-- Kolom Kiri: Informasi Pelanggan --}}
    <div class="col-12 col-lg-6 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <h5 class="card-title">Informasi Umum</h5>
                <hr>
                <dl class="row">
                    <dt class="col-sm-4">Nama Lengkap</dt>
                    <dd class="col-sm-8">{{ $pelanggan->first_name }} {{ $pelanggan->last_name }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $pelanggan->email }}</dd>

                    <dt class="col-sm-4">Telepon</dt>
                    <dd class="col-sm-8">{{ $pelanggan->phone }}</dd>

                    <dt class="col-sm-4">Gender</dt>
                    <dd class="col-sm-8">{{ $pelanggan->gender }}</dd>

                    <dt class="col-sm-4">Tanggal Lahir</dt>
                    <dd class="col-sm-8">{{ $pelanggan->birthday }}</dd>
                </dl>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Upload & List File --}}
    <div class="col-12 col-lg-6 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <h5 class="card-title">File Pendukung</h5>
                <hr>

                {{-- Pesan Sukses/Error --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Form Upload --}}
                <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf

                    {{-- INPUT HIDDEN (Kunci Utama Tugas Ini) --}}
                    {{-- Ini memberitahu sistem bahwa file ini milik tabel 'pelanggan' dengan ID sekian --}}
                    <input type="hidden" name="ref_table" value="pelanggan">
                    <input type="hidden" name="ref_id" value="{{ $pelanggan->pelanggan_id }}">

                    <div class="mb-3">
                        <label for="files" class="form-label">Upload Dokumen Baru</label>
                        <input type="file" class="form-control" name="files[]" id="files" multiple required>
                        <small class="text-muted">Bisa upload banyak file sekaligus.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-upload me-1"></i> Upload File
                    </button>
                </form>

                {{-- List File --}}
                <h6 class="mt-4">Daftar File Tersimpan:</h6>
                @if($files->isEmpty())
                    <p class="text-muted fst-italic">Belum ada file pendukung.</p>
                @else
                    <ul class="list-group">
                        @foreach($files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ asset('uploads/' . $file->filename) }}" target="_blank" class="text-decoration-none">
                                        <i class="fas fa-file me-2"></i> {{ $file->filename }}
                                    </a>
                                </div>
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus file ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
