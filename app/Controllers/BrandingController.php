<?php
namespace App\Controllers;

class BrandingController extends BaseController{
    public function getBranding(){
        return $this->renderHTML("branding.twig");
    }
}