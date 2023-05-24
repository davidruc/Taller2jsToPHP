<?php

    // 8. Programa que Ingrese por teclado:
    // a. el valor del lado de un cuadrado para mostrar por pantalla el
    // perímetro del mismo
    // b. la base y la altura de un rectángulo para mostrar el área del
    // mismo

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
        
    function validar($arg){
        return $arg;
    }
    function algoritmo(){
    global $_DATA;
    $allCalculos = array();
    $total = 0;
    foreach ($_DATA as $elemento) {
        $lado = $elemento['lado'];
        $base = $elemento['base'];
        $altura = $elemento['altura'];
        if(is_numeric($lado)){
            $perimetro = 4*$lado;
        } else {
            $perimetro = "ingrese un dao valido";
        }
        if(is_numeric($base) && is_numeric($altura)){
            $area = $base*$altura;
        } 
        else {
            $area = "ingrese un dao valido";
        }
        $datos = array(
            "Lado" => $lado,
            "perimetro Cuadrado" => $perimetro,
            "Alto" => $altura,
            "Base" => $base,
            "Area rectangulo" => $area
        );
        array_push($allCalculos, $datos);
    }
    return $allCalculos;
    }
    try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
    }catch (\Throwable $th) {
        $res = "ERROR";
    };
    $mensaje = (array) [
        "Calculos" => validar($res)
    ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>