<?php
namespace App\Controllers;

class PackagingController extends BaseController{
    public function getPackaging(){
        return $this->renderHTML("packaging.twig");
    }
}