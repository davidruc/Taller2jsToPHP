<?php
    // 4. Construir el algoritmo que solicite el nombre y edad de 3
    // personas y determine el nombre de la persona con mayor edad.
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
    $array = array();
    for ($i=1; $i <= 3 ; $i++) { 
        $name[$i] = $_DATA['name'.$i];
        $edad[$i] = $_DATA['edad'.$i];
        if(is_numeric($edad[$i])){
            $array[$name[$i]] = $edad[$i];
        } else {
            $array[$name[$i]] = "Edad incorrecta";
        }
    }
    $onlyNum = array_filter($array, 'is_numeric');
    $maxVal = max($onlyNum);
    $maxKey = array_search($maxVal, $array);
    $mensaje = array(
        "mensaje" => "La persona mayor es $maxKey con una edad de $maxVal.",
        "notas" => $array,
    );
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>