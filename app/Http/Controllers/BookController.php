<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_book = Book::all();
        $jumlah_book = $data_book->count();
        $total_harga = $data_book->sum('harga');

        return view('book.index', compact('data_book', 'jumlah_book', 'total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'tgl_terbit' => 'required|date',
        ]);

        if ($request->hasFile('photo')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Filename to store
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('photo')->storeAs('photos', $filenameSimpan, 'public');
        }

        $book = new Book($validatedData);
        $book->save();
    
        return redirect()->route('book.index')->with('success', 'Data buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementasikan jika perlu
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'tgl_terbit' => 'required|date',
        ]);

        $book->update($validatedData);

        return redirect()->route('book.index')->with('success', 'Data buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }

        $book->delete();

        return redirect()->route('book.index')->with('success', 'Data buku berhasil dihapus');
    }

    public function upload(Request $request, $id)
    {
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $book = Book::find($id);
        if (!$book) {
            return redirect()->route('book.index')->with('error', 'Buku tidak ditemukan');
        }
    
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('photos', 'public');
    
            $book->photo = $path;
            $book->save();
        }
    
        return redirect()->route('book.index')->with('success', 'Foto buku berhasil diupload');
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }
}
