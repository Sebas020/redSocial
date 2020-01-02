<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{

	public function __construct()
    {//validar si está logueado
        $this->middleware('auth');
    }

    public function index($search = null) {
        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                                ->orWhere('name', 'LIKE', '%'.$search.'%')//Condición where con el or, si quisiera con el and solamente haría nuevamente el where
                                ->orWhere('surname', 'LIKE', '%'.$search.'%')
                                ->orderBy('id', 'desc')
                                ->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }
        return  view('user.index', [
            'users' => $users
        ]);
    }
    
    public function config() {
    	return view('user.config');
    }

    public function update(Request $request) {
    	//Conseguir usuario identificado
    	$user = \Auth::user();
    	$id = $user->id;

    	//Validar formulario
    	$validate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);
    	//Recoger los datos del formulario
    	$name = $request->input('name');
    	$surname = $request->input('surname');
    	$nick = $request->input('nick');
    	$email = $request->input('email');

    	//subir la imagen
    	$image_path = $request->file('image_path');
    	if($image_path) {
    		// Poner nombre único
    		$image_path_name = time().$image_path->getClientOriginalName();

    		//Utilizar el elemento storage
    		//Sacar el fichero y con el metodo put del storare guardarle en el directorio de storage (storage/app/users)
    		Storage::disk('users')->put($image_path_name, File::get($image_path));

    		//Setear el nombre de la imagen en el objeto
    		$user->image = $image_path_name;
    	}

    	//Asignar nuevos valores al objeto del usuario

    	$user->name = $name;
    	$user->surname = $surname;
    	$user->nick = $nick;
    	$user->email = $email;

    	//Ejecutar consulta y cambio en la bd
    	$user->update();

    	return redirect()->route('config')
    					 ->with(['message' => 'Usuario actualizado correctamente']);



    }

    public function getImage($filename) {
    	$file = Storage::disk('users')->get($filename);

    	return new Response($file, 200);
    }

    public function profile($id) {
        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }



}
