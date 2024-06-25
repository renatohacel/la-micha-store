<?php

namespace App\Controllers;
use App\Models\ModeloProductos;
class Home extends BaseController
{
    protected $productos;
    public function __construct(){
        $this->productos = new ModeloProductos();
    }
    public function index(){
        //$datos['productos'] = $this->productos->findAll(); 
        return view('template/header') . view('productos/productos') . view('template/footer');
    }
}
