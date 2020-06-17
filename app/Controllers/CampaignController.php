<?php
namespace App\Controllers;

class CampaignController extends BaseController{
    public function getCampaign(){
        return $this->renderHTML("campaign.twig");
    }
}