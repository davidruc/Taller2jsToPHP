<?php
    //Construir el algoritmo para un programa que ingrese tres
    //notas de un alumno, si el promedio es menor o igual a 3.9
    //mostrar un mensaje "Estudie“, de lo contrario un mensaje que
    //diga "becado"

   header("Content-Type: application/json; charset:UTF-8");
   $_DATA = json_decode(file_get_contents("php://input"), true);
   $METHOD = $_SERVER["REQUEST_METHOD"];

   function validar($arg){
    return ($arg<=3.9) ? "Estudie" : "Estas becado";
   }
   function algoritmo(float $nota, float $nota2, float $nota3){ 
    $promedio = ($nota+$nota2+$nota3)/3;
    return $promedio;
   }
   try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
   }catch (\Throwable $th) {
    $res = "ERROR";
   };
   $mensaje = (array) [
    "mensaje" => validar($res),
    "notas" => $_DATA,
    "promedio" => $res
   ];
   echo json_encode($mensaje, JSON_PRETTY_PRINT);

   

?>