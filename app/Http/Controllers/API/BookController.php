<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::get();

        $output = array(
            'error' => false,
            'msg' => 'Data Berhasil Ditampilkan',
            'data' => $data
        );
        return $output;
    }

    public function get_book(){
        $book = Book::all();
        return response()->json(['book'=> $book]);
    }

    // public function get_book_by_id($id_buku)
    // {
    //     return response()->json(['book' => Book::find($id_buku)]);
    // }

    public function get_book_by_id($id){
        $book = Book::where('id_buku',$id_buku)->get();
        return response()->json(['book'=> $book]);
    }

    public function create_book(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_buku' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'genre_buku' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $book = Book::create([
            'kode_buku' => $request->kode_buku,
            'judul_buku' => $request->judul_buku,
            'genre_buku' => $request->genre_buku,
         ]);
        
        return response()->json(['Program created successfully.', new BookResource($book)]);
    }

    
    // public function create_book(Request $request)
    // {
    //     $request->validate([
    //         'kode_buku' => 'required|string|max:255',
    //         'judul_buku' => 'required|string|max:255',
    //         'genre_buku' => 'required|string|max:255',
    //     ]);

    //     Book::create($request->all());

    //     return response()->json(['book' => Book::all()]);
    // }

    // public function create_book(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'kode_buku' => 'required|string|max:255',
    //         'judul_buku' => 'required|string|max:255',
    //         'genre_buku' => 'required|string|max:255',
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors());       
    //     }

    //     $book = Book::create([
    //         'kode_buku' => $request->kode_buku,
    //         'judul_buku' => $request->judul_buku,
    //         'genre_buku' => $request ->genre_buku
    //      ]);

    //     $token = $book->createToken('auth_token')->plainTextToken;

    //     return response()
    //         ->json(['data' => $book,'access_token' => $token, 'token_type' => 'Bearer', ]);
    // }

    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'kode_buku' => 'required|string|max:255',
    //         'judul_buku' => 'required|string|max:255',
    //         'genre_buku' => 'required|string|max:255',
    //     ]);
    //     $update = Book::where('id_buku', $request->id_buku)->update($request->all());
    //     if ($update) {
    //         return response()->json(['msg' => 'update data successfully']);
    //     }
    // }
    public function update_book(Request $request)
    {
        $where = array('id_buku' => $request->id_buku);
        $data = array('kode_buku' => $request->kode_buku, 'judul_buku' => $request->judul_buku,'genre_buku' => $request->genre_buku);
        $update = Book::where($where)->update($data);
        if($update){
            return response()
            ->json(['message' => 'Update Data Success ', 'code' => 200, 'update data ' => $data, ]);
        }else{
            return response()
            ->json(['message' => 'Update Data Filed ', 'code' => 401, 'update data ' =>null, ]);
        }
    }

    public function destroy($id_buku)
    {
        $del = Book::where('id_buku', $id_buku)->delete();
        if ($del) {
            return response()->json(['msg' => 'delete data successfully']);
        }
    }
}
