<?php 

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
class AuthFilter implements FilterInterface{

public function before(RequestInterface $request, $arguments=null){
    $session = session();

    if(!$session->get('usuario_id')){
        return redirect()->to('/auth/login')->with('error','Debes iniciar sesión');
    }

    if ($arguments){
        $nivelRequerido = $arguments[0]?? null;

        if ($nivelRequerido && $session->get('nivelacceso')!== $nivelRequerido){
            return redirect()->to('/sin-permiso'); //vista error

        }
    }
}
public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
    //no se realiza ninguna operacion
}

}