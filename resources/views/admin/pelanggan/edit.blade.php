@extends('layouts.admin.app')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pelanggan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Pelanggan & Upload File</h1>
        </div>
        <div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>

@if (session('success'))
<div class="alert alert-info">
    {!! session('success') !!}
</div>
@endif

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                {{-- PENTING: Tambahkan enctype="multipart/form-data" --}}
                <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        {{-- Kolom Kiri --}}
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" id="first_name" class="form-control" required name="first_name" value="{{ $dataPelanggan->first_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" id="last_name" class="form-control" required name="last_name" value="{{ $dataPelanggan->last_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" id="birthday" class="form-control" name="birthday" value="{{ $dataPelanggan->birthday }}">
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option selected>Gender</option>
                                    <option value="Female" {{ $dataPelanggan->gender == 'Female' ? 'selected': ''}}>Female</option>
                                    <option value="Male" {{ $dataPelanggan->gender == 'Male' ? 'selected': ''}}>Male</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" required name="email" value="{{ $dataPelanggan->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" name="phone" value="{{ $dataPelanggan->phone }}">
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Upload File Multiple --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="files" class="form-label fw-bold">Upload Dokumen Pendukung (Multiple)</label>
                                {{-- Input dengan name="files[]" dan attribute multiple --}}
                                <input type="file" class="form-control" name="files[]" id="files" multiple>
                                <small class="text-muted">Bisa memilih lebih dari satu file (jpg, jpeg, png, pdf, docx).</small>
                            </div>
                        </div>
                    </div>

                    {{-- Menampilkan File yang Sudah Diupload --}}
                    @if($dataPelanggan->files->count() > 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label fw-bold">File yang tersimpan:</label>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Aksi</th> {{-- Nanti bisa tambahkan fitur delete per file disini --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataPelanggan->files as $file)
                                        <tr>
                                            <td>
                                                <a href="{{ asset('uploads/pelanggan/' . $file->filename) }}" target="_blank">
                                                    {{ $file->filename }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Tersimpan</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update & Upload</button>
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
