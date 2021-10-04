<?php

/* Swagger documentation */
/**
 * @OA\Info(title="Backend-Part1", version="0.2")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost/Backend-Part1/api/", description="Development Environment" ),
 * ),
 * @OA\SecurityScheme(securityScheme="ApiKeyAuth", type="apiKey", in="header", name="Authentication" )
 */


Flight::route('POST /register', function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->register($data);
  Flight::json(["message" => "Confirmation email has been sent. Please confirm your account"]);
});


Flight::route('POST /login', function(){
  Flight::json(Flight::jwt(Flight::userService()->login(Flight::request()->data->getData())));
});

?>