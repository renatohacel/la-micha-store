<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModeloProductos extends Model{
    protected $table      = 'productos';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','descripcion','precio','descuento','id_categoria','stock','activo'];
}