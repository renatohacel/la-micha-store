<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\ModeloProductos;

class Productos extends BaseController
{
    protected $productos;
    public function __construct()
    {
        $this->productos = new ModeloProductos();
    }
    public function productos()
    {
        //if ($this->request->isAjax()) {
        $datos['productos'] = $this->productos->findAll();
        return $this->response->setJSON($datos);
        //}
    }
    public function listar(){
        return view('template/header_title') . view('productos/productos') . view('template/footer');
    }
}
