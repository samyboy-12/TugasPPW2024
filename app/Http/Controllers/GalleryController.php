<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Http;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get(route('api.gallery'));
    
        if ($response->successful()) {
            $data = [
                'menu' => 'Gallery',
                'galleries' => $response->json('data'),
            ];
        } else {
            $data = [
                'menu' => 'Gallery',
                'galleries' => [],
            ];
        }
    
        return view('gallery.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'required',
        'picture' => 'image|nullable|max:1999'
    ]);

    if ($request->hasFile('picture')) {
        $filenameWithExt = $request->file('picture')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('picture')->getClientOriginalExtension();
        $basename = uniqid() . time();
        
        $smallFilename = "small_{$basename}.{$extension}";
        $mediumFilename = "medium_{$basename}.{$extension}";
        $largeFilename = "large_{$basename}.{$extension}";
        $filenameSimpan = "{$basename}.{$extension}";

        $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
    } else {
        $filenameSimpan = 'noimage.png';
    }

    $post = new Post;
    $post->picture = $filenameSimpan;
    $post->title = $request->input('title');
    $post->description = $request->input('description');
    $post->save();

    return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
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
        // Temukan gallery berdasarkan ID yang diberikan
        $gallery = Post::findOrFail($id);
    
        // Tampilkan halaman edit dengan data gallery yang ditemukan
        return view('gallery.edit', compact('gallery'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'description' => 'required|string|max:255',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opsional, jika ingin update gambar
        ]);
    
        // Temukan gallery berdasarkan ID yang diberikan
        $gallery = Post::findOrFail($id);
    
        // Update deskripsi
        $gallery->description = $request->input('description');
    
        // Update gambar jika ada file baru yang diunggah
        if ($request->hasFile('picture')) {
            // Hapus gambar lama
            if ($gallery->picture && file_exists(storage_path('app/public/posts_image/' . $gallery->picture))) {
                unlink(storage_path('app/public/posts_image/' . $gallery->picture));
            }
    
            // Upload gambar baru
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->storeAs('public/posts_image', $fileName);
            $gallery->picture = $fileName;
        }
    
        // Simpan perubahan
        $gallery->save();
    
        // Redirect kembali ke halaman gallery dengan pesan sukses
        return redirect()->route('gallery.index')->with('success', 'Gambar berhasil diperbarui');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $gallery = Post::findOrFail($id);
    $gallery->delete();
    return redirect()->route('gallery.index')->with('success', 'Gambar berhasil dihapus');
    }
}
