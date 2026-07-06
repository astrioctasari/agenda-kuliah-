<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->galeris()->latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'nullable|string|max:150',
            'image' => 'required|string', // base64 data URL
            'rot' => 'nullable|string',
        ]);

        $galeri = $request->user()->galeris()->create($data);
        return response()->json($galeri, 201);
    }

    public function destroy(Request $request, Galeri $galeri)
    {
        abort_if($galeri->user_id !== $request->user()->id, 403);
        $galeri->delete();
        return response()->json(['message' => 'Dihapus'], 200);
    }
}
