<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model {
    protected $fillable = ['id_grupo', 'nome', 'login', 'senha'];


}
