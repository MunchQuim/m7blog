<?php
session_start(); // Empezar la sesión para almacenar el estado de la calculadora
$pantalla = isset($_POST['pantalla']) ? $_POST['pantalla'] : '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $btn = $_POST['btn'];

    if ($btn == "=") {
        // Evaluar la operación en pantalla
        try {
            $resultado = eval("return $pantalla;");
            $pantalla = $resultado;
        } catch (Exception $e) {
            $pantalla = "Error";
        }
    } elseif ($btn == "C") {
        // Limpiar pantalla
        $pantalla = '';
    } else {
        // Concatenar el valor del botón a la pantalla
        $pantalla .= $btn;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="calculadora.css">
    <script src="backColorScript.js"></script>
</head>
<body>
    <form method="POST" action="practica2_4.php" id="calculadora-container">
        <div id="resultado">
            <input id="respuesta" type="text" name="pantalla" value="<?php echo htmlspecialchars($pantalla); ?>" readonly>
        </div>
        <div id="botones-container">
            <div id="numeros">                
                <button id="n1" type="submit" name="btn" value="1">1</button>
                <button id="n2" type="submit" name="btn" value="2">2</button>
                <button id="n3" type="submit" name="btn" value="3">3</button>
                <button id="n4" type="submit" name="btn" value="4">4</button>
                <button id="n5" type="submit" name="btn" value="5">5</button>
                <button id="n6" type="submit" name="btn" value="6">6</button>
                <button id="n7" type="submit" name="btn" value="7">7</button>
                <button id="n8" type="submit" name="btn" value="8">8</button>
                <button id="n9" type="submit" name="btn" value="9">9</button>
                <button id="n0" type="submit" name="btn" value="0">0</button>
                <button id="n" type="submit" name="btn" value=".">.</button>
            </div>
            <div id="operaciones">
                <button id="nMas" type="submit" name="btn" value="+">+</button>
                <button id="nMenos" type="submit" name="btn" value="-">-</button>
                <button id="nDiv" type="submit" name="btn" value="/">/</button>
                <button id="nMult" type="submit" name="btn" value="*">*</button>
                <button id="nIgual" type="submit" name="btn" value="=">=</button>
                <button id="nC" type="submit" name="btn" value="C">C</button>

<!--                 <div id="nMas">+</div>
                <div id="nMenos">-</div>
                <div id="nDiv">/</div>
                <div id="nMult">*</div>
                <div id="nIgual">=</div> -->

            </div>
        </div>

    </div>

</body>
</html>