<?php
namespace App\Controllers;

class PrivacyController extends BaseController{
    public function getPrivacy(){
        return $this->renderHTML("privacy.twig");
    }
}