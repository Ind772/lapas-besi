<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pejabat = Pejabat::orderBy('tipe_jabatan', 'asc')
            ->orderBy('urutan', 'asc')
            ->get();
        
        return view('Admin.Pejabat.index', compact('pejabat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Pejabat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat_golongan' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'tahun_menjabat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tipe_jabatan' => 'required|in:kepala,struktural',
            'urutan' => 'nullable|integer',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pejabat', 'public');
        }

        // Handle checkbox is_active (checkbox tidak terkirim jika tidak dicentang)
        $validated['is_active'] = $request->has('is_active');

        Pejabat::create($validated);

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Data pejabat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pejabat $pejabat)
    {
        return view('admin.pejabat-show', compact('pejabat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pejabat $pejabat)
    {
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pejabat $pejabat)
    {
        $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:255',
        'pangkat_golongan' => 'required|string',
        'jabatan' => 'required|string',
        'tipe_jabatan' => 'required|in:kepala,struktural',
        'pendidikan' => 'nullable|string',
        'tahun_menjabat' => 'nullable|string',
        'urutan' => 'nullable|integer',
        'foto' => 'nullable|image|max:2048',
        'is_active' => 'required|boolean',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pejabat->foto) {
                Storage::disk('public')->delete($pejabat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pejabat', 'public');
        }

        $pejabat->update($validated);

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Data pejabat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pejabat $pejabat)
    {
        // Hapus foto jika ada
        if ($pejabat->foto) {
            Storage::disk('public')->delete($pejabat->foto);
        }
        
        $pejabat->delete();

        return redirect()->route('admin.pejabat.index')
            ->with('success', 'Data pejabat berhasil dihapus!');
    }
}