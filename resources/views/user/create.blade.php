@extends('layouts.main')

@section('container')
    <form method="post" action="{{ route('users.store') }}" class="">
        @csrf
        <div class="mb-3">
            <label for="nama_depan" class="form-label">First Name</label>
            <input type="text" name="nama_depan" class="form-control @error('firstName') is-invalid @enderror"
                id="nama_depan" value="{{ old('nama_depan') }}">

            @error('firstName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama_belakang" class="form-label">Last Name</label>
            <input type="text" name="nama_belakang" class="form-control @error('lastName') is-invalid @enderror"
                id="nama_belakang" aria-describedby="emailHelp" value="{{ old('nama_belakang') }}">

            @error('lastName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                aria-describedby="emailHelp" value="{{ old('email') }}">

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
