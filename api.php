<?php
    //Construir el algoritmo para un programa que ingrese tres
    //notas de un alumno, si el promedio es menor o igual a 3.9
    //mostrar un mensaje "Estudie“, de lo contrario un mensaje que
    //diga "becado"

   header("Content-Type: application/json; charset:UTF-8");
   $_DATA = json_decode(file_get_contents("php://input"), true);
   $METHOD = $_SERVER["REQUEST_METHOD"];

   function validar($arg){
    return ($arg == 0) ? "Par" : "Impar";
   }
   function validar2($arg){
    return ($arg > 10) ? "Es mayor que 10" : "Menor de 10" ;
   }
   function algoritmo(float $num){ 
    $modulo = $num % 2;
    return $modulo;
   }
   function algoritmo2(float $num){
    return $num;
   }
   
   try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
    $res2 = match($METHOD){
        "POST" => algoritmo2(...$_DATA)
    };
   }catch (\Throwable $th) {
    $res = "ERROR";
    $res2 = "ERROR";
   };
   $mensaje = (array) [
    "TIPO" => validar($res),
    "VALIDACION" => validar2($res2)
   ];
   echo json_encode($mensaje, JSON_PRETTY_PRINT);

   

?>