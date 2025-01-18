<?php

namespace App\Http\Controllers;

class PetController extends Controller
{
    public function show(int $id)
    {
        return view('pet', ['id' => $id]);
    }
}
