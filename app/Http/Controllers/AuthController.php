<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function funLogin(Request $request){
        
        // validar
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if(!Auth::attempt($credenciales)){
            return response()->json(["mesage" =>"Credenciales Incorrectos"]);
        }
        $usuario = $request->user();
        $token = $usuario->createToken('Token auth')->plainTextToken;

        return response()->json();
    }

    public function funRegister(Request $request){
        // validar
        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|same:c_password",
        ]);

        // guardar
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->save();

        return response()->json(["mensaje"=>"Usuario Registrado"],201);

        // generar una respuesta
    }

    public function funProfile(Request $request){

    }

    public function funLogout(Request $request){

    }
}
