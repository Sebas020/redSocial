<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //Relación Many To one / de muchos a uno
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');//se le pasa por parámetro el nameSpace de la entidad de la tabla y el cambo foráneo con el que se crea la relación
    }

    //Relación Many To one / de muchos a uno
    public function image() {
    	return $this->belongsTo('App\Image', 'image_id');//se le pasa por parámetro el nameSpace de la entidad de la tabla y el cambo foráneo con el que se crea la relación
    }
}
