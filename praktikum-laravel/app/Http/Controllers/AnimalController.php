<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    // Properti yang menyimpan data hewan
    private $animals = ['Kucing', 'Ayam', 'ikan'];

    // Menampilkan seluruh data hewan Animals
    public function index() {
        return response()->json($this->animals);
    }
    // hai

    // Menambahkan hewan baru
    public function store(Request $request) {
        // Menambahkan data hewan animals
        $newAnimal = $request->input('name');
        array_push($this->animals, $newAnimal);

        return response()->json([
            'pesan' => "Hewan berhasil ditambahkan.",
            'animals' => $this->animals
        ]);
    }

    // Memperbarui data hewan 
    public function update(Request $request, $id) {
        // Validasi apakah ID ada dalam array
        if (isset($this->animals[$id])) {
            $this->animals[$id] = $request->input('name');
            return response()->json([
                'message' => "Hewan berhasil diperbarui.",
                'animals' => $this->animals
            ]);
        } else {
            return response()->json([
                'message' => "Hewan tidak ditemukan."
            ], 404);
        }
    }

    // Menghapus data hewan berdasarkan ID (index array)
    public function destroy($id) {
        // Validasi apakah ID ada dalam array
        if (isset($this->animals[$id])) {
            unset($this->animals[$id]);
            // Reindex array setelah penghapusan
            $this->animals = array_values($this->animals);
            return response()->json([
                'message' => "Hewan berhasil dihapus.",
                'animals' => $this->animals
            ]);
        } else {
            return response()->json([
                'message' => "Hewan telah di hapus"
            ], 404);
        }
    }
}