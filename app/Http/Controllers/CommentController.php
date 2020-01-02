<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {//validar si está logueado con el middleware
        $this->middleware('auth');
    }

    public function save(Request $request) {
    	//Validación de los campos
    	$validate = $this->validate($request, [
    		'image_id' => 'int|required',
    		'content'  => 'string|required'
    	]);
    	//Recoger los campos del formulario
    	$user = \auth::user();
    	$image_id = $request->input('image_id');
    	$content = $request->input('content');

    	//Asignar los valores a mi nuevo objeto a guardar
    	$comment = new Comment();
    	$comment->user_id = $user->id;
    	$comment->image_id = $image_id;
    	$comment->content = $content;
    	//Guardar en la bd
    	$comment->save();

    	//Redirección
    	return redirect()->route('image.detail', ['id' => $image_id])
    					->with([
    						'message' => 'Has publicado tu comentario correctamente!!'
    					]);

    }

    public function delete($id) {
    	//Conseguir datos del usuario logueado
    	$user= \Auth::user();

    	//Conseguir objeto del comentario
    	$comment = Comment::find($id);
    	//Comprobar si soy el dueño del comentario o de la publicación
    	if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
    		$comment->delete();
    		return redirect()->route('image.detail', ['id' => $comment->image->id])
    					->with([
    						'message' => 'Comentario eliminado correctamente!!'
    					]);
    	}else{
    		return redirect()->route('image.detail', ['id' => $comment->image->id])
    					->with([
    						'message' => 'EL COMENTARIO NO SE HA ELIMINADO !!'
    					]);
    	}
    }
}
