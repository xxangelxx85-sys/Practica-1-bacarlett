<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Operaciones Matemáticas</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 320px; }
        h2 { color: #333; text-align: center; }
        input, select, button { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { background: #007bff; color: white; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #0056b3; }
        .result { margin-top: 15px; padding: 10px; background: #e9ecef; border-radius: 5px; text-align: center; font-weight: bold; }
    </style>
</head>
<body>
<div class="card">
    <h2>Calculadora</h2>
    <form method="POST">
        <input type="number" step="any" name="num1" placeholder="Número 1" required>
        <input type="number" step="any" name="num2" placeholder="Número 2" required>
        <select name="operacion">
            <option value="suma">Suma (+)</option>
            <option value="resta">Resta (-)</option>
            <option value="multiplicacion">Multiplicación (*)</option>
            <option value="division">División (/)</option>
            <option value="potencia">Potencia (^)</option>
        </select>
        <button type="submit">Calcular</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $n1 = $_POST['num1'];
        $n2 = $_POST['num2'];
        $op = $_POST['operacion'];
        $res = 0;
        switch($op) {
            case 'suma': $res = $n1 + $n2; break;
            case 'resta': $res = $n1 - $n2; break;
            case 'multiplicacion': $res = $n1 * $n2; break;
            case 'division': $res = ($n2 != 0) ? $n1 / $n2 : "Error: División entre cero"; break;
            case 'potencia': $res = pow($n1, $n2); break;
        }
        echo "<div class='result'>Resultado: $res</div>";
    }
    ?>
</div>
</body>
</html>