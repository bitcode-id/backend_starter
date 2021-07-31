<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use File;
use Validator;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // list kategori untuk admin dan publik
    public function index ()
    {
    	$data = DB::table('kategori')
                ->orderBy('nama', 'asc')
                ->select('id', 'nama', 'slug', 'updated_at')
                ->limit(5000)->get();

    	return response()->json([
    		'data' => $data
    	]);
    }

    // tampilkan kategori
    public function show ($slug)
    {
    	$data = Kategori::where('slug', $slug)->first();

    	return response()->json([
    		'data' => $data
    	]);	
    }

    // buat atau update kategori
    public function store (Request $request)
    {
    	$this->validate($request, [
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama kategori harus diisi',
        ]);

        $slug = $request->slug ?? Str::slug($request->nama, '-');
        
        $kategori = Kategori::updateOrCreate(
          [
            'id' => $request->id
          ],
          [
            'nama' => $request->nama,
            'slug' => $slug
          ]);

        if ($kategori) {
        	return response()->json([
        		'info' => 'Kategori '.$request->nama.' telah dibuat'
        	]);
        }
    }

    // hapus data, softdeletes
    public function destroy ($id)
    {
        $data = Kategori::find($id);
        if ($data->delete()) {
            return response()->json([
            	'info' => 'Data telah dihapus'
            ]);
        }
    }
}
