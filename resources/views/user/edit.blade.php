@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4><b>Edit User</b></h4>
            </div>
            <div class="card-body">
                <form class="row g-3" method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <div class="col-12">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Masukkan Nama Anda" value="{{ old('name',$user->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail4"  placeholder="example@example.com" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="inputRoles" class="form-label">Roles</label>
                        <select class="form-select" id="inputRoles" name="roles">
                            <option value="ADMIN" @if($user->roles === 'ADMIN') selected @endif >ADMIN</option>
                            <option value="USER" @if($user->roles === 'USER') selected @endif >USER</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword4">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                          </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                        <label for="inputPassword5" class="form-label">Confirmation Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword5">
                        </div>
                        </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                      <button type="submit" class="btn btn-primary">Edit</button>
                      <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection
