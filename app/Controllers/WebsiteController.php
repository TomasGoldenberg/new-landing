<?php
namespace App\Controllers;

class WebsiteController extends BaseController{
    public function getWebsite(){
        return $this->renderHTML("website.twig");
    }
}