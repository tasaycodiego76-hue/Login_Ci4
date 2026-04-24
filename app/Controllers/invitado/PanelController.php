<?php
namespace App\Controllers\Admin;

use CodeIgniter\Controller;


class DashboardController extends Controller{
    public function index(){
        $data['titulo'] = 'Panel de Invitado';
        return view('admin/controller', $data);
    }
}