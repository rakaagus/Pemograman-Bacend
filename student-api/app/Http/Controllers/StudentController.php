<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();

        if($students->isEmpty()){
            return response()->json([
                'error' => false,
                'message' => 'No students found',
                'data' => [],
            ], 200);
        }else {
            $data = [
                'error' => false,
                'message' => 'Get All Student Successfully',
                'data' => $students,
            ];
            return response()->json($data, 200);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nim' => 'required|string',
            'email' => 'required|string',
            'jurusan' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => "Validation Errors",
                'data' => $validator->errors(),
            ], 422);
        }else {
            $input = [
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan
            ];

            $student = Student::create($input);

            $data = [
                'error' => false,
                'messagge' => 'Student is created Successfully',
                'data' => $student,
            ];

            return response()->json($data, 201);
        }
    }

    public function show($id){
        $student = Student::find($id);

        if(!$student){
            return response()->json([
                'error' => true,
                'message' => 'Student not founds'
            ], 404);
        }else {
            $data = [
                'error' => false,
                'message' => 'Get Student',
                'data' => $student,
            ];

            return response()->json($data, 200);
        }
    }

    public function update(Request $request, $id){
        $student = Student::find($id);

        if(!$student){
            return response()->json([
                'error' => true,
                'message' => 'Student not founds'
            ], 404);
        }else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string',
                'nim' => 'required|string',
                'email' => 'required|string',
                'jurusan' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'message' => "Validation Errors",
                    'data' => $validator->errors(),
                ], 422);
            } else {
                $input = [
                    'nama' => $request->nama ?? $student->nama,
                    'nim' => $request->nim ?? $student->nim,
                    'email' => $request->email ?? $student->email,
                    'jurusan' => $request->jurusan ?? $student->jurusan
                ];

                $student->update($input);

                $data = [
                    'error' => false,
                    'message' => 'Student Update Successfully',
                    'data' => $student,
                ];

                return response()->json($data, 200);
            }
        }
    }

    public function destroy($id){
        $student = Student::find($id);

        if(!$student){
            return response()->json([
                'error' => true,
                'message' => 'Student not founds'
            ], 404);
        }else {
            $student->delete();

            $data = [
                'error' => false,
                'message' => 'Delete Student Successfully',
            ];

            return response()->json($data, 200);
        }
    }
}
