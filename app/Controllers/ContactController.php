<?php

namespace App\Controllers;

use App\Models\Contact;
use Respect\Validation\Validator as v;

class ContactController extends BaseController {
    public function getAddContactAction($request){


        $responseMessage=null;


         if($request->getMethod()=="POST"){

            $postData = $request->getParsedBody();

            $contactValidator = v::key("name",v::stringType()->notEmpty())
                            ->key("email", v::stringType()->notEmpty())
                            ->key("description", v::stringType()->notEmpty())
                            ->key("budget", v::stringType()->notEmpty())
                            ->key("time", v::stringType()->notEmpty());
            
            
            //$contactValidator->assert($postData); 
            //con estas validaciones  validate si se aprueban se guardara el body del post en la base de datos y devuelve un true || si no cumple devuelven un false
            //en lugar de validate assert te da un error con un stack trace que podes manejar con un try catch
            
            try{
                $contactValidator->assert($postData); 
            $postData = $request->getParsedBody();

                



                $contact = new Contact();
                $contact->name= $postData["name"];
                $contact->email= $postData["email"];
                $contact->description= $postData["description"];
                $contact->budget= $postData["budget"];
                $contact->time= $postData["time"];

                $contact->save(); 

                $responseMessage="Thank you ! Our representative will contact you shortly.";
            }catch(\Exception $e){
                
                $responseMessage="ALL THE FIELDS MUST BE FILLED";

            }
        
        };
 
        return $this->renderHTML("contact.twig",[
            "responseMessage"=> $responseMessage
        ]);
    }
}