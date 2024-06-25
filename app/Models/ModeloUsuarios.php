<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloUsuarios extends Model
{
    protected $table      = 'usuarios';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idUser';
    protected $allowedFields = ['user', 'password', 'email', 'telefono', 'domicilio', 'ciudad','activo', 'iniciado'];

   
}
