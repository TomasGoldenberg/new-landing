<?php 
namespace App\Models;
require_once("Printable.php");

class BaseElement {
    public $name;
    public $email;
    public $description;
    public $budget;
    public $time;

    public function __construct($name,$email,$description,$budget,$time) {
        $this->name=$name;
        $this->email=$email;
        $this->description = $description;
        $this->budget = $budget;
        $this->time = $time;       
    }



}