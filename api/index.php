<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__).'/services/UserService.class.php';



Flight::set('flight.log_errors', TRUE);

/* error handling for our API */
    Flight::map('error', function(Exception $ex){
    Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
  });



  Flight::route('GET /swagger', function(){
    $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
    header('Content-Type: application/json');
    echo $openapi->toJson();
  });



  /* include all routes */
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/comment.php";
require_once dirname(__FILE__)."/routes/post.php";

Flight::start();

?>