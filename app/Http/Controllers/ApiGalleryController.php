<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ApiGalleryController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Galeri 1',
                    'description' => 'Deskripsi gambar 1',
                    'picture' => 'path/to/image.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                // Data tambahan
            ],
        ]);
    }

}
