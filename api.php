<?php

    // 7. Programa que pida el ingreso del nombre y precio de un artículo y la
    // cantidad que lleva el cliente. Mostrar lo que debe pagar el comprador
    // en su factura.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
        
    function validar($arg){
        return $arg;
    }
    function algoritmo(){
    global $_DATA;
    $allArticulos = array();
    $total = 0;
    foreach ($_DATA as $elemento) {
        $precio = $elemento['precio'];
        $cantidad = $elemento['cantidad'];
        $articulo = $elemento['articulo'];
        if(is_numeric($precio) && is_numeric($cantidad)){
            $total = $total + $precio*$cantidad;
            $suma = $precio*$cantidad;
        } else {
            $total = $total;
            $suma = "Error, no es un dato valido";
        }

        $datos = array(
            "articulo" => $articulo,
            "Precio" => $precio,
            "Cantidad" => $cantidad,
            "Total producto" => $suma,
            "Total Factura" => $total
        );
        array_push($allArticulos, $datos);
    }
    return $allArticulos;
    }
    try {
    $res = match($METHOD){
        "POST" => algoritmo(...$_DATA)
    };
    }catch (\Throwable $th) {
        $res = "ERROR";
    };
    $mensaje = (array) [
        "Lista de mercado" => validar($res)
    ];
    echo json_encode($mensaje, JSON_PRETTY_PRINT);
?>