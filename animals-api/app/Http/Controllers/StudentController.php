<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $data = [
            'message' => 'Get all students',
            'data' => $students
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'nim' => 'numeric|required|unique:students',
            'email' => 'email|required|unique:students',
            'jurusan' => 'required'
        ]);
        $student = Student::create($validateData);
        $data = [
            'message' => 'Student is created succesfully',
            'data' => $student,
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            $validateData = $request->validate([
                'nama' => 'required',
                'nim' => 'numeric|required|unique:students,nim,' . $id,
                'email' => 'email|required|unique:students,email,' . $id,
                'jurusan' => 'required'
            ]);
            $student->update($validateData);
            $data = [
                'message' => 'Student is updated',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            $data = [
                'message' => 'Student is deleted'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];
            return response()->json($data, 404);
        }
    }
}
