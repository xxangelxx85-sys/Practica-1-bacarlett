<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Círculo</title>
</head>
<body>
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
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Menú de navegación */
        .nav-menu {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            background: #ffffff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-menu a {
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #555;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover {
            background-color: #f0f2f5;
            color: #333;
        }

        .nav-menu a.active {
            background-color: #3498db;
            color: white;
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
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Estilos para los resultados */
        .results {
            margin-top: 25px;
            padding: 15px;
            background-color: #e8f4fd;
            border-left: 4px solid #3498db;
            border-radius: 4px;
        }

        .results h3 {
            margin: 0 0 10px 0;
            color: #2980b9;
            font-size: 1.1rem;
        }

        .results p {
            margin: 6px 0;
            font-size: 0.95rem;
        }

        .error {
            margin-top: 20px;
            padding: 12px;
            background-color: #fde8e8;
            border-left: 4px solid #e74c3c;
            color: #c0392b;
            border-radius: 4px;
            font-size: 0.95rem;
        }
    </style>

    <h2>Calculadora de Área y Perímetro de un Círculo</h2>
    
    <!-- Formulario para pedir el radio -->
    <form method="POST" action="">
        <label for="radio">Ingresa el radio del círculo:</label>
        <input type="number" step="any" name="radio" id="radio" required>
        <button type="submit" name="calcular">Calcular</button>
    </form>

    <?php
    // Verificamos si se ha enviado el formulario
    if (isset($_POST['calcular'])) {
        // Obtenemos el valor del radio y lo convertimos a número decimal
        $radio = floatval($_POST['radio']);

        if ($radio > 0) {
            // Fórmulas matemáticas
            $area = M_PI * pow($radio, 2); // Área = Pi * radio al cuadrado
            $perimetro = 2 * M_PI * $radio; // Perímetro = 2 * Pi * radio

            // Mostramos los resultados formateados a 2 decimales
            echo "<h3>Resultados:</h3>";
            echo "<p>Radio ingresado: <strong>$radio</strong></p>";
            echo "<p>Área: <strong>" . number_format($area, 2) . "</strong></p>";
            echo "<p>Perímetro: <strong>" . number_format($perimetro, 2) . "</strong></p>";
        } else {
            echo "<p style='color: red;'>Por favor, ingresa un número mayor a 0.</p>";
        }
    }
    ?>

</body>
</html>