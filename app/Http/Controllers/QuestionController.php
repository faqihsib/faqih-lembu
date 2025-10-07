<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //utk nampilin smua
        //dd($request->all());

        //validasi
        $request->validate([
            'nama'  => 'required|max:10',
            'email' => ['required', 'email'],
            'pertanyaan' => 'required|max:300|min:8',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'pertanyaan.required' => 'pertanyaan tidak berbobot'
        ]);


        //utk simpan
        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['pertanyaan'] = $request->pertanyaan;

        //return view('home-question-respon', $data);

        //return redirect()->back();

        //mengarahkan pakai redirect
        //menampilkan make return view
        return redirect()->route('home')->with('info', 'Terimakasih '.$data['nama']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
