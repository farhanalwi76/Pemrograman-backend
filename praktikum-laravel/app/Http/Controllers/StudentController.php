<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // Method index
    public function index()
    {
        // Mengambil semua data students
        $students = Student::all();

        // Cek jika data kosong
        if ($students->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data students yang ditemukan'], 404);
        }

        // Response jika data ditemukan
        $response = [
            'data' => $students,
            'message' => 'Berhasil menampilkan semua data students'
        ];

        return response()->json($response, 200);
    }

    // Method untuk menambahkan data
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nim' => 'required|string|unique:students',
            'email' => 'required|email|unique:students',
            'majority' => 'required|string'
        ]);

        // Cek jika ada error pada validasi
        if ($validator->fails()) {
            return response()->json(['message' => 'Data tidak lengkap atau tidak valid', 'errors' => $validator->errors()], 400);
        }

        // Membuat data student
        $student = Student::create($request->all());

        $response = [
            'message' => 'Successfully created new student',
            'data' => $student
        ];

        return response()->json($response, 201);
    }

    // Method untuk memperbarui data
    public function update(Request $request, $id)
    {
        // Cari student berdasarkan ID
        $student = Student::find($id);

        // Jika student tidak ditemukan, kembalikan respons 404
        if (!$student) {
            return response()->json(['message' => 'Student tidak ditemukan'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'nim' => 'sometimes|required|string|unique:students,nim,' . $id,
            'email' => 'sometimes|required|email|unique:students,email,' . $id,
            'majority' => 'sometimes|required|string'
        ]);

        // Cek jika ada error pada validasi
        if ($validator->fails()) {
            return response()->json(['message' => 'Data tidak lengkap atau tidak valid', 'errors' => $validator->errors()], 400);
        }

        // Update data student
        $student->update($request->only(['name', 'nim', 'email', 'majority']));

        $response = [
            'message' => 'Successfully updated student',
            'data' => $student
        ];

        return response()->json($response, 200);
    }

    // Method untuk menghapus data
    public function destroy($id)
    {
        // Cari student berdasarkan ID
        $student = Student::find($id);

        // Jika student tidak ditemukan, kembalikan respons 404
        if (!$student) {
            return response()->json(['message' => 'Student tidak ditemukan'], 404);
        }

        // Hapus data student
        $student->delete();

        $response = [
            'message' => 'Berhasil menghapus student',
            'data' => $student
        ];

        return response()->json($response, 200);
    }
    // Menampilkan data menggunakan ID
    public function show($id){
        $student = student::find($id);

        if ($student){
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Student not found',
            ];
            return response()->json($data, 404);
        }
    }
}