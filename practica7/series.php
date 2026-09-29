<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Series Numéricas</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 400px; }
        h2 { color: #333; text-align: center; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { background: #28a745; color: white; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #218838; }
        .result { margin-top: 15px; background: #e9ecef; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
<div class="card">
    <h2>Generador de Series</h2>
    <form method="POST">
        <input type="number" name="limite" placeholder="Límite de dígitos" min="1" required>
        <button type="submit">Generar</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $limite = intval($_POST['limite']);
        $pares = [];
        $impares = [];
        $fibonacci = [];

        for ($i = 1; $i <= $limite; $i++) {
            if ($i % 2 == 0) $pares[] = $i;
            else $impares[] = $i;
        }

        for ($i = 0; $i < $limite; $i++) {
            if ($i == 0) $fibonacci[] = 0;
            elseif ($i == 1) $fibonacci[] = 1;
            else $fibonacci[] = $fibonacci[$i-1] + $fibonacci[$i-2];
        }

        echo "<div class='result'>";
        echo "<p><strong>Pares:</strong> " . implode(', ', $pares) . "</p>";
        echo "<p><strong>Impares:</strong> " . implode(', ', $impares) . "</p>";
        echo "<p><strong>Fibonacci:</strong> " . implode(', ', $fibonacci) . "</p>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>