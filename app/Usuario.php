<?php

namespace sistemaCelComunicaciones;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuario';

    protected $primaryKey='id';

    public $timestamps=false;

    //campos
    protected $fillable=[
    'nombre',
    'documento',
    'idRol',
    'estado'
    ];

    protected $guarded =[
  
    ];
}
