<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Números Primos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; }
        h2 { color: #333; text-align: center; }
        input, button { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { background: #17a2b8; color: white; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #138496; }
        .result { margin-top: 15px; background: #e9ecef; padding: 10px; border-radius: 5px; word-break: break-all; }
    </style>
</head>
<body>
<div class="card">
    <h2>Números Primos</h2>
    <form method="POST">
        <input type="number" name="limite" placeholder="Número límite" min="2" required>
        <button type="submit">Mostrar Primos</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $limite = intval($_POST['limite']);
        $primos = [];

        for ($num = 2; $num <= $limite; $num++) {
            $es_primo = true;
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i == 0) {
                    $es_primo = false;
                    break;
                }
            }
            if ($es_primo) {
                $primos[] = $num;
            }
        }

        echo "<div class='result'>";
        echo "<p><strong>Primos hasta $limite:</strong></p>";
        echo implode(', ', $primos);
        echo "</div>";
    }
    ?>
</div>
</body>
</html>