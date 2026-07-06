<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->catatans()->latest()->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'matkul' => 'nullable|string|max:100',
            'html' => 'nullable|string',
            'rot' => 'nullable|string',
        ]);

        $catatan = $request->user()->catatans()->create($data);
        return response()->json($catatan, 201);
    }

    public function update(Request $request, Catatan $catatan)
    {
        abort_if($catatan->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'matkul' => 'nullable|string|max:100',
            'html' => 'nullable|string',
        ]);

        $catatan->update($data);
        return response()->json($catatan);
    }

    public function destroy(Request $request, Catatan $catatan)
    {
        abort_if($catatan->user_id !== $request->user()->id, 403);
        $catatan->delete();
        return response()->json(['message' => 'Dihapus'], 200);
    }
}
