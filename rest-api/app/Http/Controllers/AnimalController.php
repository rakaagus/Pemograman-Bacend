<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{

    public $animals = ["Kucing", "Anjing", "Ayam", "Kambing", "Sapi", "Ikan"];

    public function index(){
        echo "Menampilkan data animals";
        echo "</br>";
        foreach($this->animals as $data => $value){
            echo "[$data] = $value";
            echo "</br>";
        }
    }

    public function store(Request $request){
        echo "Menambah Data Hewan Baru $request->nama";
        echo "</br>";
        array_push($this->animals, $request->nama);
        $this->index();
    }

    public function update(Request $request, $id){
       // Cek apakah ID tersebut ada dalam array $animals
        if (isset($this->animals[$id])) {
        // Cek apakah data nama dikirim dalam request dan tidak kosong
            if ($request->has('nama') && !empty($request->nama)) {
                echo "Mengupdate Data Hewan Index / Id: $id";
                echo "</br>";

                // Update data di array
                $this->animals[$id] = $request->nama;

                // Tampilkan data setelah diupdate
                $this->index();
            } else {
                echo "Nama hewan tidak valid atau kosong!";
            }
        } else {
            echo "ID tidak ditemukan!";
        }
    }

    public function destroy($id){
        echo "Menghapus data hewan id $id";
        echo "</br>";
        unset($this->animals[$id]);
        $this->index();
    }
}
