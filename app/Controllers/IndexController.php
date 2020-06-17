<?php
namespace App\Controllers;

class IndexController extends BaseController{
    public function getIndex(){
        return $this->renderHTML("index.twig");
    }
}