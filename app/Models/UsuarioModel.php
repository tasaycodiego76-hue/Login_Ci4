<?php
 
 namespace App\Models;

 Use CodeIgniter\Model;

 class UsuarioModel extends Model{


  protected $table = 'usuarios';
  protected $primaryKey = 'id';
  protected $returnType = 'object';

  protected $allowedFields = ['nombreusuario','claveacceso','nivelacceso'];

  
  
  public function verificarCredenciales(string $usuario, string $clave): ?object

  {
    $row = $this->where('nombreusuario', $usuario)->first();

    if($row && password_verify($clave, $row->claveacceso)){
        //acceso correcto
        return $row;
    }
    return null;
  }
 }