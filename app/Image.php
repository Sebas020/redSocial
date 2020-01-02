<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Utilizará el ORM Eloquent
//Un ORM es un sistema de mapeo relacional de elementos de forma que lo que hacemos es representar la bd en modelos u objetos para programación

class Image extends Model
{//Documentación oficial eloquen orm laravel
	//Lo primero que hacemos es indicar que tabla va a modificar
    protected $table = 'images';

    //Relación One To Many / de uno a muchos
    public function comments() {
    	return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    //Relación One To Many / de uno a muchos
    public function likes() {
    	return $this->hasMany('App\Like');//Me va a sacar todos los elementos relacionado con el id de mi tabla like
    }

    //Relación Many To one / de muchos a uno
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');//se le pasa por parámetro el nameSpace de la entidad de la tabla y el cambo foráneo con el que se crea la relación
    }

}
