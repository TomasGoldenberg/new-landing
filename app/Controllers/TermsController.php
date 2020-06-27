<?php
namespace App\Controllers;

class TermsController extends BaseController{
    public function getTerms(){
        return $this->renderHTML("terms.twig");
    }
}