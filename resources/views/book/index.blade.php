@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Book</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a @can('create-book') href="{{ route('book.create') }}" @endcan
                        class="btn btn-success mb-3 @if (!auth()->user()->can('create-book')) disabled @endif">CREATE</a>
                    </div>
                <div class="col-6">
                    <x-alert/>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Year</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($books as $key => $book)
                        <tr>
                            <td>{{ $books->firstitem() + $key}}</td>
                            <td style="width: 200px">
                                <img src="{{ $book->cover_url }}" class="img-fluid"/>
                            </td>
                            <td>{{ $book->title}}</td>
                            <td>{{ $book->description}}</td>
                            <td>{{ $book->year}}</td>
                            <td>{{ $book->quantity}}</td>
                            <td>
                                @foreach ($book->categories as $key =>$category )
                                    <li> {{ $category->name }} | {{ $category->pivot->update_at }} </li>
                                @endforeach
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning me-3"> EDIT </a>
                                <x-button.delete :action="route('book.destroy', $book->id)"/>

                                {{-- <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger">DELETE</button>
                                </form> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Category is empty</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
