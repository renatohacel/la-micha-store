<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\ModeloCarrito;
use App\Models\ModeloProductos;
use PDO;

class Carrito extends BaseController
{
    protected $productos_carrito;
    protected $productos;
    public function __construct()
    {
        $this->productos_carrito = new ModeloCarrito();
        $this->productos = new ModeloProductos();
    }
    public function addCarrito()
    {

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $session = session();

            if ($session->get('iniciado') != 0) {

                if (!$session->has('carrito')) {
                    $session->set('carrito', ['productos' => []]);
                }

                $carrito = $session->get('carrito');

                if (isset($carrito['productos'][$id])) {
                    $carrito['productos'][$id]++;
                    $this->productos_carrito->where('idUser', $session->get('idUser'))->where('idProducto', $id)->set('cantidad', $carrito['productos'][$id])->update();
                } else {
                    $carrito['productos'][$id] = 1;
                    $datosSessionCarrito = [
                        'idUser' => $session->get('idUser'),
                        'idProducto' => $id,
                        'cantidad' => $carrito['productos'][$id]
                    ];
                    $this->productos_carrito->insert($datosSessionCarrito);
                }

                $session->set('carrito', $carrito);

                $response['numero'] = count($carrito['productos']);
                $response['respuesta'] = true;
                $session->set('num_cart', count($carrito['productos']));

                return $this->response->setJSON($response);
            } else {
                $response['respuesta'] = false;
                return $this->response->setJSON($response);
            }
        } else {
            $response['respuesta'] = false;
            return $this->response->setJSON($response);
        }
    }

    public function mostrar_carrito()
    {
        $session = session();
        $response = [];
        $productos = $session->get('carrito.productos');
        $lista_carrito = [];

        if (!empty($productos)) {
            $db = \Config\Database::connect();

            foreach ($productos as $clave => $cantidad) {
                $query = $db
                    ->table('productos')
                    ->select('id, nombre, precio, descuento, ' . $cantidad . ' AS cantidad')
                    ->where('id', $clave)
                    ->where('activo', 1)
                    ->get();

                $producto = $query->getRowArray();

                $lista_carrito[] = $producto;
                $response['lista_carrito'] = $lista_carrito;
            }
        }
        echo view('template/header_title') . view('productos/carrito', $response) . view('template/footer');
    }

    public function updateCarrito()
    {

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $action = $this->request->getVar('action');
            $session = session();

            if ($session->get('iniciado') != 0) {
                if (isset($action)) {
                    if ($action == 'agregar') {
                        $cantidad = $this->request->getVar('cantidad');
                        $respuesta = Carrito::agregar($id, $cantidad);
                        if ($respuesta > 0) {
                            $response['respuesta'] = true;
                        } else {
                            $response['respuesta'] = false;
                        }
                        $response['sub'] = '$' . number_format($respuesta, 2, '.', ',');
                    } else if ($action == 'eliminar') {
                        $response['respuesta'] = Carrito::eliminar($id);
                    } else {
                        $response['respuesta'] = false;
                    }
                } else {
                    $response['respuesta'] = false;
                }
                return $this->response->setJSON($response);
            } else {
                $response['respuesta'] = false;
                return $this->response->setJSON($response);
            }
        } else {
            $response['respuesta'] = false;
            return $this->response->setJSON($response);
        }
    }

    public function agregar($id, $cantidad)
    {
        $res = 0;
        $carrito = session()->get('carrito');

        if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
            if (isset($carrito['productos'][$id])) {
                $carrito['productos'][$id] = $cantidad;
                $db = \Config\Database::connect();
                $query = $db
                    ->table('productos')
                    ->select('precio, descuento')
                    ->where('id', $id)
                    ->where('activo', 1)
                    ->limit(1)
                    ->get();
                $row = $query->getRowArray();
                $precio = $row['precio'];
                $descuento = $row['descuento'];
                $precio_desc = $precio - (($precio * $descuento) / 100);
                $res = $cantidad * $precio_desc;

                return $res;
            }
        } else {
            return $res;
        }
    }

    public function updateSession()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $cantidad = $this->request->getVar('cantidad');
            $session = session();
            $carrito = $session->get('carrito');

            // Actualiza la cantidad del producto en el carrito
            if (isset($carrito['productos'][$id])) {
                $carrito['productos'][$id] = $cantidad;
                $session->set('carrito', $carrito);
                $datos = [
                    'cantidad' => $cantidad
                ];
                $this->productos_carrito->where('idUser', $session->get('idUser'))->where('idProducto', $id)->set($datos)->update();
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito');
        $session = session();
        if ($id > 0) {
            if (isset($carrito['productos'][$id])) {
                unset($carrito['productos'][$id]);
                $session->set('carrito', $carrito);
                $session->set('num_cart', count($carrito['productos']));
                $this->productos_carrito->where('idUser', $session->get('idUser'))->where('idProducto', $id)->delete();
                return true;
            }
        }
    }
}
