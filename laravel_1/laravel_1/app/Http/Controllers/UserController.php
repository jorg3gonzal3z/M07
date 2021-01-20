<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function nou()
    {
        return view('nou_usuari');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password|min:6',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/prova');
        //return back()->with('succes','El usuario ha sigut creat correctament.');
        //return Redirect::to('prova')->with('notice', 'El usuario ha sigut creat correctament.');
    }

    public function show(Request $id)
    {
        
        $users = User::find($id);

        return view('info_usuari', compact('users'));
    }

    public function destroy(Request $id)
    {
        $usuario = User::findOrFail($id);
        if ($usuario->delete())
            return redirect()->route('users.index')->withSuccess("El usuario se ha eliminado correctamente.");
        else
            return redirect()->route('users.index')->withWarning("Error al eliminar el usuario.");
    }
}
