<?php
    // 3. Construir el algoritmo para determinar el voltaje de un
    // circuito a partir de la resistencia y la intensidad de corriente.

   header("Content-Type: application/json; charset:UTF-8");
   $_DATA = json_decode(file_get_contents("php://input"), true);
   $METHOD = $_SERVER["REQUEST_METHOD"];

   function validar($arg){
    if (is_numeric($arg)){
        return ("$arg volts");
    } else {
        return "ERROR";
    }
   }
   
   function algoritmo(float $resistencia, float $intensidad){ 
    $voltaje = $resistencia * $intensidad;
    return $voltaje;
   } 
   try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
   }catch (\Throwable $th) {
    $res = "ERROR";
   };
   $mensaje = (array) [
    "VOLTAJE" => validar($res),
   ];
   echo json_encode($mensaje, JSON_PRETTY_PRINT);

   

?>