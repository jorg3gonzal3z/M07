<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class CrudController extends Controller
{
    public function form()
    {
        $libros=Libro::orderBy('id','DESC')->paginate(3);
        
        return view('crud',compact('libros')); 
    }
    public function show($id)
    {
        $libro = Libro::find($id);
        return view("libro/info" , compact('libro'));
    }
    public function create(){
        return view("libro/create");
    }
    public function store(){
        $data = request()->validate([
            'nombre' => 'required',
            'resumen' => 'required',
            'npagina' => 'required|integer',
            'edicion' => 'required',
            'autor' => 'required',
            'precio' => 'required|numeric',
        ]);
        $libro=Libro::create([
            'nombre' => $data['nombre'],
            'resumen' => $data['resumen'],
            'npagina' => $data['npagina'],
            'edicion' => $data['edicion'],
            'autor' => $data['autor'],
            'precio' => $data['precio'],
        ]);
        return redirect()->route('crud'); 
    }
    public function destroy($id)
    {
        $libro=Libro::find($id);
        $libro->delete();
        return redirect()->route('crud');
    }
    public function edit($id){
        $libro = Libro::find($id);
        return view("libro/edit" , compact('libro'));
    }
    public function update($id){
        $libro = Libro::find($id);
        $data = request()->validate([
            'nombre' => 'required',
            'resumen' => 'required',
            'npagina' => 'required|integer',
            'edicion' => 'required',
            'autor' => 'required',
            'precio' => 'required|numeric',
        ]);
        $libro->update([
            'nombre' => $data['nombre'],
            'resumen' => $data['resumen'],
            'npagina' => $data['npagina'],
            'edicion' => $data['edicion'],
            'autor' => $data['autor'],
            'precio' => $data['precio'],
        ]);
        return redirect()->route('crud');
    }

}
