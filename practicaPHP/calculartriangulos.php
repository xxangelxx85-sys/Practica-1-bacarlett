<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Triángulo</title>
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
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #219653;
        }

        /* Estilos para los resultados */
        .results {
            margin-top: 25px;
            padding: 15px;
            background-color: #e8f8f0;
            border-left: 4px solid #27ae60;
            border-radius: 4px;
        }

        .results h3 {
            margin: 0 0 10px 0;
            color: #219653;
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
</head>
<body>

    <div class="card">
        <h2>Calculadora de Triángulo</h2>
        
        <!-- Formulario -->
        <form method="POST" action="">
            <label for="base">Ingresa la base:</label>
            <input type="number" step="any" name="base" id="base" placeholder="Ej. 10" required>

            <label for="altura">Ingresa la altura:</label>
            <input type="number" step="any" name="altura" id="altura" placeholder="Ej. 5" required>

            <button type="submit" name="calcular">Calcular</button>
        </form>

        <?php
        // Lógica de PHP
        if (isset($_POST['calcular'])) {
            $base = floatval($_POST['base']);
            $altura = floatval($_POST['altura']);

            if ($base > 0 && $altura > 0) {
                // Área = (base * altura) / 2
                $area = ($base * $altura) / 2;

                // Para el perímetro en un triángulo rectángulo, calculamos la hipotenusa: sqrt(base^2 + altura^2)
                $hipotenusa = sqrt(pow($base, 2) + pow($altura, 2));
                $perimetro = $base + $altura + $hipotenusa;

                echo "<div class='results'>";
                echo "<h3>Resultados:</h3>";
                echo "<p>Base: <strong>$base</strong></p>";
                echo "<p>Altura: <strong>$altura</strong></p>";
                echo "<p>Área: <strong>" . number_format($area, 2) . "</strong></p>";
                echo "<p>Perímetro (Rectángulo): <strong>" . number_format($perimetro, 2) . "</strong></p>";
                echo "</div>";
            } else {
                echo "<div class='error'>Por favor, ingresa números mayores a 0.</div>";
            }
        }
        ?>
    </div>

</body>
</html>