<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post berhasil ditambahkan',
            'data' => $post
        ], 201);
    }

    public function show(string $id)
    {
        return Post::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        // VALIDASI
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post berhasil diupdate',
            'data' => $post
        ]);
    }

    public function destroy(string $id)
    {
        Post::destroy($id);

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ]);
    }
}