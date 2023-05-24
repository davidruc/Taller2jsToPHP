<?php

    // 6. Construir el algoritmo en PHP para un programa
    // para cualquier cantidad de estudiantes que lea el nombre,
    // el sexo y la nota definitiva y halle al estudiante con la mayor
    // nota y al estudiante con la menor nota y cuantos eran
    // hombres y cuantos mujeres.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
        
    function validar($arg){
        return $arg;
    }
    function algoritmo(){
    global $_DATA;
    $definitivas = [];
    $countMen = 0;
    $countWoman = 0;
    foreach ($_DATA as $elemento) {
        $definitiva = floatval($elemento['definitiva']);
        $definitivas[] = $definitiva;
        $gender = $elemento['sexo'];
        if($gender == "hombre"){
            $countMen++;
        } else {
            $countWoman++;
        }
    }
    $maxDefinitiva = max($definitivas);
    $minDefinitiva = min($definitivas);
    $indice = array_search($maxDefinitiva, array_column($_DATA, 'definitiva'));
    $nameMaxDef = $_DATA[$indice]['nombre'];
    $indice2 = array_search($minDefinitiva, array_column($_DATA, 'definitiva'));
    $nameMinDef = $_DATA[$indice2]['nombre'];
    return array(
        "Nombre de quien saco la nota maxima" => $nameMaxDef,
        "Nombre de quien saco la nota minima" => $nameMinDef,
        "Numero de hombres" => $countMen,
        "Numero de mujeres" => $countWoman,
    );
    }
    try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
    }catch (\Throwable $th) {
        $res = "ERROR";
    };
    $mensaje = (array) [
        "Datos" => $_DATA,
        "Respuesta" => validar($res)
    ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>