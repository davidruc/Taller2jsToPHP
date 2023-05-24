<?php

    // 9. N atletas han pasado a finales en salto triple en los juegos
    // olímpicos femenino de 2022. Diseñe un programa que pida por
    // teclado los nombres de cada atleta finalista y a su vez, sus
    // 10. Desarrolle un programa cíclico que capture un dato
    // numérico cada vez, y los vaya acumulando. El programa se
    // detiene cuando el usuario digita un cero. El programa debe
    // mostrar: LA SUMATORIA DE LOS VALORES, EL VALOR DEL
    // PROMEDIO, CUÁNTOS VALORES FUERON DIGITADOS, MAYOR
    // VALOR Y MENOR VALOR.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
        
    function validar($arg){
        return $arg;
    }
    function algoritmo(){
        global $_DATA;
        $datos = array();
        foreach($_DATA as $elemento){
            $dato = floatval($elemento['num']);
            (is_numeric($dato))? array_push($datos, $dato) : "Error";
        }
        $suma = array_sum($datos);
        $numDatos = count($datos);
        $promedio = $suma / $numDatos;
        $maxVal = max($datos);
        $minVal = min($datos);
        if (in_array(0, $datos)){
            return "El programa finalizo";
        } else {
            return array(
                "suma" => $suma,
                "promedio" => $promedio,
                "numero de datos digitados" => $numDatos,
                "valor menor" => $minVal,
                "valor mayor" => $maxVal,
            );
        }
    }
    try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
    }catch (\Throwable $th) {
        $res = "ERROR";
    };
    $mensaje = (array) [
        "Data" => $_DATA,
        "Calculos" => validar($res),
        
    ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>