<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FormulariController extends Controller
{
    public function formulari()
    {
        return view('formulari');
    }
    public function dades()
    {
        
        $data = request()->validate([
            'email' => 'required|email', //|exists:users,email'
            'nif' => 'required',
            'fitxer' => 'required|max:1024',
            'imatge' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=1920,min_height=1080',
        ]);

        $mail = $data['email'];
        $nif= $data['nif'];
        $fitxer= $data['fitxer']->store('public');
        $url_fitxer = Storage::url($fitxer);
        $img = $data['imatge']->store('public');
        $url_img = Storage::url($img);

        return view('dades_formulari', compact('mail','nif','url_fitxer','url_img'));
    }
}
