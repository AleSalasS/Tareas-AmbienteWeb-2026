
<?php



$transacciones = [];




function registrarTransaccion($id, $descripcion, $monto)
{
    global $transacciones;

    $transaccion = [
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    ];

    array_push($transacciones, $transaccion);
}




function generarEstadoDeCuenta()
{
    global $transacciones;

    $totalContado = 0;

    
    foreach ($transacciones as $transaccion) {
        $totalContado += $transaccion["monto"];
    }

    
    $interes = $totalContado * 0.026;

    
    $totalConInteres = $totalContado + $interes;

    
    $cashback = $totalContado * 0.001;

    
    $montoFinal = $totalConInteres - $cashback;


    

    $estadoCuenta = "============================================\n";
    $estadoCuenta .= "           ESTADO DE CUENTA                 \n";
    $estadoCuenta .= "============================================\n\n";

    $estadoCuenta .= "DETALLE DE TRANSACCIONES\n";
    $estadoCuenta .= "--------------------------------------------\n";

    foreach ($transacciones as $transaccion) {

        $estadoCuenta .= "ID: " . $transaccion["id"] . "\n";
        $estadoCuenta .= "Descripcion: " . $transaccion["descripcion"] . "\n";
        $estadoCuenta .= "Monto: ₡" . number_format($transaccion["monto"], 2) . "\n";
        $estadoCuenta .= "--------------------------------------------\n";
    }

    $estadoCuenta .= "\nRESUMEN DE CUENTA\n";
    $estadoCuenta .= "--------------------------------------------\n";

    $estadoCuenta .= "Total de contado: ₡" . number_format($totalContado, 2) . "\n";
    $estadoCuenta .= "Interes (2.6%): ₡" . number_format($interes, 2) . "\n";
    $estadoCuenta .= "Total con intereses: ₡" . number_format($totalConInteres, 2) . "\n";
    $estadoCuenta .= "Cashback (0.1%): -₡" . number_format($cashback, 2) . "\n";

    $estadoCuenta .= "--------------------------------------------\n";
    $estadoCuenta .= "MONTO FINAL A PAGAR: ₡" . number_format($montoFinal, 2) . "\n";
    $estadoCuenta .= "============================================\n";


    

    $archivo = __DIR__ . "/estado_cuenta.txt";

    file_put_contents($archivo, $estadoCuenta);


    // Devolver el estado de cuenta
    return $estadoCuenta;
}




registrarTransaccion(1, "Compra de supermercado", 25000);
registrarTransaccion(2, "Compra de videojuegos", 35000);
registrarTransaccion(3, "Compra de ropa", 18000);
registrarTransaccion(4, "Compra de accesorios", 12000);
registrarTransaccion(5, "Compra de alimentos", 15000);




$resultado = generarEstadoDeCuenta();




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estado de Cuenta - Tarjeta de Crédito</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            max-width: 750px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
        }

        h1 {
            text-align: center;
            color: #263b55;
        }

        h2 {
            color: #263b55;
            margin-top: 30px;
        }

        pre {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            white-space: pre-wrap;
            font-family: Consolas, monospace;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .mensaje {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="contenedor">

        <h1>Estado de Cuenta</h1>

        <h2>Tarjeta de Crédito</h2>

        <pre><?php echo htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8'); ?></pre>

        <div class="mensaje">
            Estado de cuenta generado correctamente.
            El archivo estado_cuenta.txt está disponible en la carpeta del proyecto.
        </div>

    </div>

</body>
</html>
