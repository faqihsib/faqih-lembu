@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pelanggan</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit User</h1>
                <p class="mb-0">Form untuk menambahkan data user baru.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="far fa-question-circle me-1"></i>
                    Kembali</a>
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
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                {{-- Input Profile Picture --}}
                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture">

                                    {{-- Preview Foto Lama --}}
                                    @if ($dataUser->profile_picture)
                                        <div class="mt-2">
                                            <label>Foto Saat Ini:</label><br>
                                            <img src="{{ Storage::url($dataUser->profile_picture) }}" alt="Profile Picture"
                                                class="img-thumbnail" style="max-width: 150px;">
                                        </div>
                                    @endif
                                </div>
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">name</label>
                                    <input type="text" id="first_name" class="form-control" required name ="name"
                                        value="{{ $dataUser->name }}">
                                </div>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" required name ="email"
                                        value="{{ $dataUser->email }}">
                                </div>
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" class="form-control" required name ="password"
                                        value="{{ $dataUser->password }}">
                                </div>
                                {{-- password confirmation --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label">Konfirmasi Password</label>
                                    <input type="password" id="password" class="form-control" required
                                        name ="password_confirmation" value="{{ $dataUser->password_confirmation }}">
                                </div>
                                <div class="mb-3">
                                        <label for="role" class="form-label">Pilih Role</label>
                                        <select id="role" name="role" class="form-select" name ="role"
                                            value="{{ old('role') }}">
                                            <option value="Super Admin">Super Admin</option>
                                            <option value="Pelanggan">Pelanggan</option>
                                            <option value="Mitra">Mitra</option>
                                        </select>
                                    </div>
                            <div class="col-lg-4 col-sm-12">
                                <!-- Buttons -->
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- end main content --}}
@endsection
