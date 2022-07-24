<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::all();
        $response = [
            'massage' => 'Data Buku',
            'data' => $book,
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "judul" => ['required'],
            "penulis" => ['required'],
            "tahun" => ['required'],
            "penerbit" => ['required'],
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),
                422
            );
        }
        try{
            $book = new Book;

            $book->judul = $request->judul;
            $book->penulis = $request->penulis;
            $book->tahun = $request->tahun;
            $book->penerbit = $request->penerbit;
            $book->save($request->all());
            // $book->save = Book::save($request->all());
            $response=[
                'massage' => 'Berhasil Disimpan',
                'data' => $book,
            ];
            return response()->json($response, 201);
        } catch(QueryExeption $e){
            return response()->json([
                'massage' => "Gagal" . $e->errorInfo,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            return response()->json([
                "success" => false,
                "massage" => "Data buku tidak ditemukan",   
            ]);
        }
        return response()->json([
            "success" => true,
            "massage" => "Data buku tidak ditemukan",   
            "data" => $book,   
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json([
            "success" => true,
            "massage" => "Data buku telah diubah",   
            "data" => $book,  
            ]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRows = Book::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "massage" => "Data buku berhasil dihapus",   
            "data" => $deleteRows,  
            ]); 
    }
}
