<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AuthController extends Controller {

    public function login() {
        if (session()->get('isLoggedIn')) {
            return $this->redirigirSegunRol();
        }
        return view('auth/login');
    }

    public function verificar() {
    $rules = [
        'nombreusuario' => 'required|min_length[3]',
        'claveacceso'   => 'required|min_length[6]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $model    = new UsuarioModel();
    $username = $this->request->getPost('nombreusuario');
    $password = $this->request->getPost('claveacceso');

    // ← Ahora usa el método del modelo
    $usuario = $model->verificarCredenciales($username, $password);

    if (!$usuario) {
        return redirect()->back()->withInput()->with('error', 'Usuario o contraseña incorrecta');
    }

    $this->setSession($usuario);

    return $this->redirigirSegunRol();
}
    private function setSession($usuario) {
        session()->set([
            'usuario_id'    => $usuario->id,
            'nombreusuario' => $usuario->nombreusuario,
            'nivelacceso'   => $usuario->nivelacceso,
            'isLoggedIn'    => true,
        ]);
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/auth/login')->with('info', 'Sesión cerrada correctamente');
    }

    // Cambiado a protected por seguridad
    protected function redirigirSegunRol() {
    return session()->get('nivelacceso') === 'administrador'
        ? redirect()->to('/admin/dashboard')
        : redirect()->to('/invitado/dashboard');
}
}