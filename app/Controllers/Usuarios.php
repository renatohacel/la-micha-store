<?php

namespace App\Controllers;

use App\Models\ModeloCarrito;
use App\Models\ModeloUsuarios;
use App\Controllers\BaseController;


class Usuarios extends BaseController
{

    protected $usuarios;
    protected $carrito;
    public function __construct()
    {

        $this->usuarios = new ModeloUsuarios();
        $this->carrito = new ModeloCarrito();
    }
    public function registrar()
    {
        return view('template/header_title') . view('usuarios/registrar') . view('template/footer');
    }

    public function iniciar()
    {
        return view('template/header_title') . view('usuarios/iniciar') . view('template/footer');
    }

    public function guardar_registro()
    {

        $user = $this->request->getVar('usuario');
        $password = $this->request->getVar('password');
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $email = $this->request->getVar('email');
        $telefono = $this->request->getVar('telefono');
        $domicilio = $this->request->getVar('domicilio');
        $ciudad = $this->request->getVar('ciudad');

        $validaUser = $this->usuarios->where('user', $user)->countAllResults();
        $validaEmail = $this->usuarios->where('email', $email)->countAllResults();
        $validaTelefono = $this->usuarios->where('telefono', $telefono)->countAllResults();

        if ($validaUser == 0 && $validaEmail == 0 && $validaTelefono == 0) {
            $datos = [
                'user' => strtolower($user),
                'password' => $password_hash,
                'email' => $email,
                'telefono' => $telefono,
                'domicilio' => strtoupper($domicilio),
                'ciudad' => strtoupper($ciudad)
            ];

            $this->usuarios->insert($datos);

            $alert['msg'] = 'Registro exitoso, ahora puedes iniciar sesión';
            return view('template/header_title') . view('usuarios/iniciar', $alert) . view('template/footer');
        } else {
            if ($validaUser != 0) {
                $alert['msg'] = 'El usuario ya está en uso';
                return view('template/header_title') . view('usuarios/registrar', $alert) . view('template/footer');
            } elseif ($validaEmail != 0) {
                $alert['msg'] = 'el email ya está en uso';
                return view('template/header_title') . view('usuarios/registrar', $alert) . view('template/footer');
            } elseif ($validaTelefono != 0) {
                $alert['msg'] = 'el telefono ya está en uso';
                return view('template/header_title') . view('usuarios/registrar', $alert) . view('template/footer');
            }
        }
    }

    public function valida_inicio()
    {
        $user = $this->request->getVar('user');
        $password = $this->request->getVar('password');

        $datos = $this->usuarios->where('user', $user)->first();
        if ($datos != null && $datos['activo'] == 1) {
            if (password_verify($password, $datos['password'])) {

                $this->usuarios->where('idUser', $datos['idUser'])->set('iniciado', 1)->update();

                $datos = $this->usuarios->where('user', $user)->first();

                $carritoData = $this->carrito->where('idUser', $datos['idUser'])->findAll();
                if (!empty($carritoData)) {
                    $carrito = [];
                    foreach ($carritoData as $item) {
                        $carrito['productos'][$item['idProducto']] = $item['cantidad'];
                    }
                    session()->start();
                    session()->set('carrito', $carrito);
                    session()->set('num_cart',count($carrito['productos']));
                }

                $datosSesion = [
                    'idUser' => $datos['idUser'],
                    'user' => $datos['user'],
                    'email' => $datos['email'],
                    'telefono' => $datos['telefono'],
                    'domicilio' => $datos['domicilio'],
                    'ciudad' => $datos['ciudad'],
                    'activo' => $datos['activo'],
                    'iniciado' => $datos['iniciado'],

                ];
                session()->start();
                session()->set($datosSesion);
                return redirect()->to(base_url());
            } else {
                $datos['msg'] = "Las contraseñas no coinciden, intentalo de nuevo";
                echo view('template/header_title') . view('usuarios/iniciar', $datos) . view('template/footer');
            }
        } else {
            $datos['msg'] = "El usuario no existe, ¡registrate!";
            echo view('template/header_title') . view('usuarios/registrar', $datos) . view('template/footer');
        }
    }

    public function salir()
    {
        if (session()->get('iniciado') == '1') {
            $datos = $this->usuarios->where('user', session()->get('user'))->first();

            $this->usuarios->where('idUser', $datos['idUser'])->set('iniciado', 0)->update();

            session()->destroy();

            return redirect()->to(base_url());
        } else {
            return $this->response->redirect(base_url());
        }
    }
}
