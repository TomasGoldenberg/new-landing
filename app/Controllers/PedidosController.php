<?php
namespace App\Controllers;
use  App\Models\Contact;


class PedidosController extends BaseController{
    public function getPedidos(){
        $contact = Contact::all();

        return $this->renderHTML("pedidos.twig",[
            "contact"=> $contact
        ]);
    }
}