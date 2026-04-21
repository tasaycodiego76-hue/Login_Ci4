<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use App\Controllers\BaseController;

class AuthController extends BaseController{


public function login(){
    if (session()->get('usuario_id')){
        return $this->redirigirSegunRol();
    }

    return view('auth/login');
}

public function verificar(){
  //Middlewarer (funcion intermediaria | mecanismo de validacion)

  $rules =[
    'nombreusuario' => 'required|min_length[3]',
    'claveacceso'   => 'required|min_length[6]'
  ];
  if (!$this->validate($rules)){
    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

  }

  $model = new UsuarioModel();
  $usuario = $model ->verificarCredenciales(
    $this->request->getPost('nombreusuario'),
    $this->request->getPost('claveacceso')
  );

  if (!$usuario){
    return redirect()->back()->withInput()->with('error', 'Usuario o contraseña incorrecta');
  }

  session()->set([
    'usuario_id'  => $usuario->id,
    'nombreusuario'  => $usuario->nombreusuario,
    'nivelacceso'  => $usuario->nivelacceso,
    'logged_in'  => $usuario->id,
  ]);

  return $this->redirigirSegunRol();
}

public function logout(){

//cerros sesion
session()->destroy();
return redirect()->to('/auth/login')->with('info','Sesión cerrada correctamente');
}

public function redirigirSegunRol(){
    //es imposible llegar a este metodo si no hemos iniciado session
    return session()->get('nivelacceso') === 'administrador'?
    redirect()->to('/admin/dashboard'):
    redirect()->to('/invitado/panel');
}




}