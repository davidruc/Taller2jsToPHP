<?php

    // 9. N atletas han pasado a finales en salto triple en los juegos
    // olímpicos femenino de 2022. Diseñe un programa que pida por
    // teclado los nombres de cada atleta finalista y a su vez, sus
    // marcas del salto en metros. Informar el nombre de la atleta
    // campeona que se quede con la medalla de oro y si rompió
    // récord, reportar el pago que será de 500 millones. El récord
    // esta en 15,50 metros.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
        
    function validar($arg){
        return $arg;
    }
    function algoritmo(){
    global $_DATA;
    $record = 15.50;
    $marcas = [];
    foreach ($_DATA as $elemento) {
        $nombre = $elemento['nombre'];
        $marca = ($elemento['marca']);
        $marcas[] = $marca;
        if(is_numeric($marca)){
            if($marca > $record){
                $mensaje = "$nombre haz roto el anterior record mundial que era $record [Metros]. Ten 500 millones (Se ha establecido un nuevo record)";
                $record = $marca;
            } else {
                $mensaje = "No rompiste el record (es de $record)";
            }
            $oro = max($marcas);
            $indice = array_search($oro, array_column($_DATA, 'marca'));
            $nombreGanadora = $_DATA[$indice]['nombre'];
        } else{
            $mensaje = "Si participaste??";
            $marca = "Error";
            
        }
        
        
    }
    return array(
        "mensaje" => $mensaje,
        "Marca de la atleta ($nombre)" => $marca." [Metros]",
        "Marca del la mejor atleta ($nombreGanadora)" => $oro." [Metros]",
    );;
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
        "Calculos" => validar($res)
    ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>