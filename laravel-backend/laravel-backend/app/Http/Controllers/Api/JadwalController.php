<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->jadwals()->orderBy('mulai')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hari' => 'required|string',
            'matkul' => 'required|string|max:150',
            'mulai' => 'required|string',
            'selesai' => 'nullable|string',
            'ruang' => 'nullable|string|max:100',
        ]);

        $jadwal = $request->user()->jadwals()->create($data);
        return response()->json($jadwal, 201);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        abort_if($jadwal->user_id !== $request->user()->id, 403);

        $data = $request->validate([
            'hari' => 'required|string',
            'matkul' => 'required|string|max:150',
            'mulai' => 'required|string',
            'selesai' => 'nullable|string',
            'ruang' => 'nullable|string|max:100',
        ]);

        $jadwal->update($data);
        return response()->json($jadwal);
    }

    public function destroy(Request $request, Jadwal $jadwal)
    {
        abort_if($jadwal->user_id !== $request->user()->id, 403);
        $jadwal->delete();
        return response()->json(['message' => 'Dihapus'], 200);
    }
}
