<?php
namespace App\Controllers;

class PortfolioController extends BaseController{
    public function getPortfolio(){
        return $this->renderHTML("portfolio.twig");
    }
}