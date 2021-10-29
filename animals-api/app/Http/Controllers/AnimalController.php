<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animals = ["Kucing", "Ayam", "Ikan"];

    public function index()
    {
        echo "Menampilkan data animals <br>";
        foreach ($this->animals as $animal) {
            echo $animal . "<br>";
        }
    }

    public function store(Request $request)
    {
        array_push($this->animals, $request->nama);
        echo "Nama hewan: $request->nama";
        echo "<br>";
        echo "Menambahkan hewan baru";
        echo "<br><br>";
        echo $this->index();
    }

    public function update(Request $request, $id)
    {
        $this->animals[$id] = $request->nama;
        echo "Nama hewan: $request->nama";
        echo "<br>";
        echo "Mengupdate data hewan id $id";
        echo "<br><br>";
        echo $this->index();
    }

    public function destroy($id)
    {
        unset($this->animals[$id]);
        echo "Menghapus data hewan id $id";
        echo "<br><br>";
        echo $this->index();
    }
}
