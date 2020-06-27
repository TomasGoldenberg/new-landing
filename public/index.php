<?php
require_once "../vendor/autoload.php";

ini_set("display_errors",1);
ini_set("display_starup_error",1);
error_reporting(E_ALL);

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__  . "/..");
$dotenv->load();





use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use Laminas\Diactoros\Response\RedirectResponse;


$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => "mysql",
    'host'      => "localhost",
    'database'  =>  "landing",
    'username'  => getEnv('DB_USER'),
    'password'  => "",
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    ]);
    
    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();


    //http request handler
    $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );


    //Router
    $routerContainer = new RouterContainer();

    $map = $routerContainer->getMap(); //The route map matches names with routes
    //          name   route   file


//INDEX
    $map->get("index","/", [
        "controller" => "App\Controllers\IndexController",
        "action"     => "getIndex"
    ]);

//CONTACT
    $map->get("getContact" ,"/contact",[
        "controller" => "App\Controllers\ContactController",
        "action"     => "getAddContactAction"
    ]);

    $map->post("sendContact" ,"/contact",[
        "controller" => "App\Controllers\ContactController",
        "action"     => "getAddContactAction"
    ]);

//PORTFOLIO
$map->get("portfolio","/portfolio", [
    "controller" => "App\Controllers\PortfolioController",
    "action"     => "getPortfolio"
]);

//PEDIDOS
$map->get("pedidos","/pedidos", [
    "controller" => "App\Controllers\PedidosController",
    "action"     => "getPedidos"
]);

//TERMS & PRIVACY
$map->get("terms","/terms", [
    "controller" => "App\Controllers\TermsController",
    "action"     => "getTerms"
]);

$map->get("privacy","/privacy", [
    "controller" => "App\Controllers\PrivacyController",
    "action"     => "getPrivacy"
]);

//PRODUCTS
    $map->get("branding","/branding", [
        "controller" => "App\Controllers\BrandingController",
        "action"     => "getBranding"
    ]);

    $map->get("website","/website",[
        "controller" => "App\Controllers\WebsiteController",
        "action"     => "getWebsite"
    ]);

    $map->get("ui","/ui",[
        "controller" => "App\Controllers\UiController",
        "action"     => "getUi"
    ]);

    $map->get("packaging","/packaging",[
        "controller" => "App\Controllers\PackagingController",
        "action"     => "getPackaging"
    ]);

    $map->get("design","/design",[
        "controller" => "App\Controllers\DesignController",
        "action"     => "getDesign"
    ]);

    $map->get("campaign","/campaign",[
        "controller" => "App\Controllers\CampaignController",
        "action"     => "getCampaign"
    ]);
    
    
    
    
    
    
    
    
    
    $map->get("notfound","/notfound", [
        "controller" => "App\Controllers\NotFoundController",
        "action"     => "getNotFound"
    ]);
    $matcher = $routerContainer->getMatcher();
    $route = $matcher->match($request);

    





    if(!$route){
        header('Location: /notfound');

    }else{
        //trabajamos sobre este objeto
        // { ["controller"]=> string(31) "App\Controllers\IndexController" ["action"]=> string(11) "indexAction" } 
        $handlerData=$route->handler;
        $actionName=$handlerData["action"];
        $controllerName= $handlerData["controller"];
 
        
        $controller= new $controllerName;
        $response=$controller->$actionName($request);
     
        foreach($response->getHeaders() as $name => $values){ //recorrer todos los valores del header

            foreach($values as $value){//si el header tiene mas de un valor los recorremos igual
                header(sprintf("%s:  %s", $name, $value),false); //convertir en string valores || el primer %s para el rpimer valor el 2do %s para el segundo valor eetc
            }
        }
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }

    


