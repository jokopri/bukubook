<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Book::with('categories')->paginate(5));
        return view('book.index', [
            'books' => Book::with('categories')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create', [
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $formData = $request->validated();

        try {
            $formData['cover'] = $request->file('cover')
                                    ->store('book-cover', 'public');

            $formData['created_by'] = Auth::user()->id;
            $formData['updated_by'] = Auth::user()->id;

            $book = Book::create($formData);

            $book->categories()->attach($formData['category']);

            return redirect()
                    ->route('book.index')
                    ->with('success', 'Book added succesfully');

        } catch (\Exception $e) {
            dd($e);
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //dd($request->validated(), $book);

        $formData = $request->validated();

        try {
            if($request->hasFile('cover')){
                Storage::delete('public/'. $book->cover);
                $formData['cover'] = $request->file('cover')->store('book-cover', 'public');
            }
            $formData['updated_by'] = Auth::user()->id;

            $book->update($formData);

            $book->categories()->sync($formData['category']);

            return redirect()
                ->route('book.index')
                ->with('success', 'Book updated successfully');
        } catch (\Exception $e) {
            dd($e);
            return redirect()
                ->back()
                ->with('error', 'Error Updating'. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            // 1. hapus relasi kategori
            $book->categories()->detach();
            // 2. hapus file cover
            if($book->cover){
                Storage::delete('public/' . $book->cover);
            }
            // 3.hapus data buku
            $book->delete();

            return redirect()
                ->route('book.index')
                ->with('success', 'Book deleted successfuly');

        } catch (\Exception $e) {
            return redirect()
                ->route('book.index')
                ->with('error', 'Error deleting'. $e->getMessage());
        }
    }
}
