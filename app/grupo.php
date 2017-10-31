<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model {
    protected $fillable = ['nome'];

    //public static  $rules = [ 'nome' => 'required|min:1|max:50' ];
}
