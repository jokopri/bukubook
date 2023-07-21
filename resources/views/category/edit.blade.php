@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Form Edit Category</h3>
            </div>
            <div class="card-body">
                <form class="row g-3" method="POST" action="{{ route('category.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-6">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Masukkan Category" value="{{ old('name',$category->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                        <div class="col-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>            </div>
        </div>
    </div>
@endsection
