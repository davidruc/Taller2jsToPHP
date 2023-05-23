<?php

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
        function validar($arg){
            return ($arg);
        }
       function algoritmo(float $num1, float $num2){
        $array = array(); 
        $suma = $num1+$num2;
        $array["suma"]= $suma;
        $resta = $num1-$num2;
        $array["resta"]= $resta;
        $array2 = array();
        $multiplicacion = $num1*$num2;
        $array2["multiplicacion"]= $multiplicacion;
        $division = $num1/$num2;
        $array2["division"]= $division;
        return ($num1 > $num2) ? $array : $array2;
       }
       try {
        $res = match($METHOD){
            "POST" => algoritmo(...$_DATA)
        };
       }catch (\Throwable $th) {
        $res = "ERROR: Los datos ingresados no son valores numericos";
       };
       $mensaje = (array) [
        "Datos" => $_DATA,
        "Resultado" => validar($res),
       ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>