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

       // Menghitung jumlah data buku
       $jumlah_book = $data_book->count();
        
       // Menghitung total harga semua buku
       $total_harga = $data_book->sum('harga');

       // Mengirimkan data ke view
       return view('book.index', compact('data_book', 'jumlah_book', 'total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $buku = new Book();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
    
        return redirect('/book');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.edit', compact('book'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->harga = $request->harga;
        $book->tgl_terbit = $request->tgl_terbit;
        $book->save();

        return redirect('/book')->with('success', 'Data buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Buku::find($id);
        $book->delete();

        return redirect('/book');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
