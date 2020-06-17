<?php
namespace App\Controllers;

class NotFoundController extends BaseController{
    public function getNotFound(){
        return $this->renderHTML("404.twig");
    }
}