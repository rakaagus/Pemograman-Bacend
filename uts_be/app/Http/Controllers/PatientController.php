<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patients;
use App\Models\PatientsInfo;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    //
    public function index(){
        $students = Patients::all();

        if($students->isEmpty()){
            return response()->json([
                'error' => false,
                'message' => 'Data Is Empty',
            ], 200);
        }else {
            $data = [
                'error' => false,
                'message' => 'Get All Patients Successfully',
                'data' => $students,
            ];
            return response()->json($data, 200);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'status' => 'required|string',
            'in_date_at' => 'required|string',
            'out_date_at' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => "Validation Errors",
                'data' => $validator->errors(),
            ], 422);
        }else {

            $patientsInfoInput = [
                'phone' => $request->phone,
                'address' => $request->address
            ];

            $patientInfos = PatientsInfo::create($patientsInfoInput);

            $input = [
                'nama' => $request->nama,
                'status' => $request->status,
                'in_date_at' => $request->in_date_at,
                'out_date_at' => $request->out_date_at,
                'patients_infos_id' => $patientInfos->id
            ];

            $student = Patients::create($input);

            $data = [
                'error' => false,
                'messagge' => 'Patient is Added Successfully',
                'data' => $student,
            ];

            return response()->json($data, 201);
        }
    }

    public function show($id){
        $patient = Patients::with('patientsInfo')->find($id);

        if(!$patient){
            return response()->json([
                'error' => true,
                'message' => 'Patient not founds'
            ], 404);
        }else {
            $data = [
                'error' => false,
                'message' => 'Get Detail Patient',
                'data' => [
                    'id' => $patient->id,
                    'nama' => $patient->nama,
                    'status' => $patient->status,
                    'phone' => $patient->patientsInfo->phone ?? null, // Pastikan data relasi ada
                    'address' => $patient->patientsInfo->address ?? null,
                    'in_date_at' => $patient->in_date_at,
                    'out_date_at' => $patient->out_date_at,
                ],
            ];

            return response()->json($data, 200);
        }
    }

    public function update(Request $request, $id){
        $patient = Patients::find($id);

        if(!$patient){
            return response()->json([
                'error' => true,
                'message' => 'Patient not founds'
            ], 404);
        }else {
            $validator = Validator::make($request->all(), [
                'nama' => 'nullable|string',
                'status' => 'nullable|string',
                'in_date_at' => 'nullable|string',
                'out_date_at' => 'nullable|string',
                'phone' => 'nullable|string',
                'address' => 'nullable|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'message' => "Validation Errors",
                    'data' => $validator->errors(),
                ], 422);
            } else {

                $input = [
                    'nama' => $request->nama ?? $patient->nama,
                    'status' => $request->status ?? $patient->status,
                    'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
                    'out_date_at' => $request->out_date_at ?? $patient->out_date_at,
                ];

                $patient->update($input);

                if($patient->patientsInfo){
                    $patient->patientsInfo->update([
                        'phone' => $request->phone ?? $patient->patientsInfo->phone,
                        'address' => $request->address ?? $patient->patientsInfo->address,
                    ]);
                }

                $data = [
                    'error' => false,
                    'message' => 'patient Update Successfully',
                    'data' => $patient,
                ];

                return response()->json($data, 200);
            }
        }
    }

    public function destroy($id){
        $patient = Patients::find($id);

        if(!$patient){
            return response()->json([
                'error' => true,
                'message' => 'patient not founds'
            ], 404);
        }else {
            $patient->delete();

            $data = [
                'error' => false,
                'message' => 'Delete patient Successfully',
            ];

            return response()->json($data, 200);
        }
    }

    public function searchPatientsByName($name){

    }

    public function searchPatientsPositive(){

    }

    public function searchPatientsRecovered(){

    }

    public function searchPatientsDead(){

    }
}
