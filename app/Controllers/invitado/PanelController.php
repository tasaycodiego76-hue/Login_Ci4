<?php
namespace App\Controllers\Invitado; 

use CodeIgniter\Controller;

class PanelController extends Controller {  
    public function index() {
        $data['titulo'] = 'Panel de Invitado';
        return view('invitado/panel', $data);
    }
}