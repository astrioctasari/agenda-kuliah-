<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->tugas()->orderBy('deadline')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'matkul' => 'nullable|string|max:100',
            'deadline' => 'nullable|date',
            'waktu' => 'nullable|string',
        ]);

        $tugas = $request->user()->tugas()->create($data);
        return response()->json($tugas, 201);
    }

    public function update(Request $request, Tugas $tuga)
    {
        abort_if($tuga->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'judul' => 'sometimes|required|string|max:150',
            'matkul' => 'nullable|string|max:100',
            'deadline' => 'nullable|date',
            'waktu' => 'nullable|string',
            'done' => 'sometimes|boolean',
        ]);

        $tuga->update($data);
        return response()->json($tuga);
    }

    public function destroy(Request $request, Tugas $tuga)
    {
        abort_if($tuga->user_id !== $request->user()->id, 403);
        $tuga->delete();
        return response()->json(['message' => 'Dihapus'], 200);
    }
}
