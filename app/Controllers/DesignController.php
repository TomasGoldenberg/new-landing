<?php
namespace App\Controllers;

class DesignController extends BaseController{
    public function getDesign(){
        return $this->renderHTML("design.twig");
    }
}