<?php
namespace App\Controllers;

class UiController extends BaseController{
    public function getUi(){
        return $this->renderHTML("ui.twig");
    }
}