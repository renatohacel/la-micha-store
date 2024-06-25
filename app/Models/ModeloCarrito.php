<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloCarrito extends Model
{
    protected $table      = 'productos_carrito';
    // Uncomment below if you want add primary key
    //protected $primaryKey = 'id';

    protected $allowedFields = ['idUser', 'idProducto', 'cantidad'];

}
