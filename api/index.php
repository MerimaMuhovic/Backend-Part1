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


?>