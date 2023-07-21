@extends('layouts.app')
@section('css')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit Book</h3>
            </div>
            <div class="card-body">
                <x-alert/>
                <form class="row g-3" method="POST" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-3 mb-3 row">
                        <div class="col-12">
                            <label for="inputTitle" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="inputTitle" placeholder="Masukkan Title" value="{{ old('title', $book->title) }}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="inputDescription" class="form-label">Description</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                                id="inputDescription"
                                name="description">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="inputYear" class="form-label">Year</label>
                            <input type="number" name="year" min="2010" max="{{ date('Y') }}" class="form-control @error('year') is-invalid @enderror" id="inputYear" placeholder="Masukkan Tahun" value="{{ old('year', $book->year) }}">
                            @error('year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="inputQuantity" class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="inputQuantity" placeholder="Masukkan Quantity" value="{{ old('quantity', $book->quantity ) }}">
                            @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="selectCategory" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror"
                                id="selectCategory"
                                name="category[]"
                                multiple>
                                @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}"
                                    {{$book->categories->pluck('id')->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="inputCover" class="form-label">Cover</label>
                            <input type="file" name="cover"
                                accept="image/*"
                                class="form-control"
                                id="inputCover"
                                onchange="updatePreview(this,'image-preview')"/>
                            <img id="image-preview"
                                src="{{ $book->cover_url }}"
                                class="img-fluid img-thumbnail"
                                style="width: 200px"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('book.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                  </form>
                </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( '#selectCategory' ).select2( {
            theme: 'bootstrap-5'
        } );

        function updatePreview(input, target){
            let file = input.files[0];
            let reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function (){
                let img = document.getElementById(target);
                img.src = reader.result;
            }
        }
    </script>
@endsection
