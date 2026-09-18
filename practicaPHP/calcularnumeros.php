<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador de Números</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        /* Contenedor principal de la tarjeta */
        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        h2 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilos del formulario */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        input[type="number"]:focus {
            border-color: #9b59b6;
            outline: none;
            box-shadow: 0 0 5px rgba(155, 89, 182, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #9b59b6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #8e44ad;
        }

        /* Estilos para los resultados */
        .results {
            margin-top: 25px;
            padding: 15px;
            background-color: #f4ecf7;
            border-left: 4px solid #9b59b6;
            border-radius: 4px;
        }

        .results h3 {
            margin: 0 0 10px 0;
            color: #8e44ad;
            font-size: 1.1rem;
        }

        .results p {
            margin: 6px 0;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Comparador de Números</h2>
        
        <!-- Formulario -->
        <form method="POST" action="">
            <label for="num1">Ingresa el primer número:</label>
            <input type="number" step="any" name="num1" id="num1" placeholder="Ej. 15" required>

            <label for="num2">Ingresa el segundo número:</label>
            <input type="number" step="any" name="num2" id="num2" placeholder="Ej. 8" required>

            <button type="submit" name="comparar">Comparar</button>
        </form>

        <?php
        // Lógica de PHP
        if (isset($_POST['comparar'])) {
            $num1 = floatval($_POST['num1']);
            $num2 = floatval($_POST['num2']);

            echo "<div class='results'>";
            echo "<h3>Resultados:</h3>";
            echo "<p>Número 1: <strong>$num1</strong></p>";
            echo "<p>Número 2: <strong>$num2</strong></p>";
            echo "<hr style='border:0; border-top:1px solid #d7bde2; margin: 10px 0;'>";

            if ($num1 > $num2) {
                echo "<p>El mayor es: <strong>$num1</strong></p>";
                echo "<p>El menor es: <strong>$num2</strong></p>";
            } elseif ($num2 > $num1) {
                echo "<p>El mayor es: <strong>$num2</strong></p>";
                echo "<p>El menor es: <strong>$num1</strong></p>";
            } else {
                echo "<p>¡Ambos números son <strong>iguales</strong>!</p>";
            }

            echo "</div>";
        }
        ?>
    </div>

</body>
</html>