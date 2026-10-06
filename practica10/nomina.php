<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo de Nómina</title>
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: Segoe UI, sans-serif; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #1e1e1e; padding: 20px; border-radius: 8px; border: 1px solid #2e2e2e; }
        h2 { color: #00bcd4; text-align: center; margin-bottom: 20px; }
        form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
        .row { display: flex; gap: 10px; }
        input, button { padding: 10px; background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: 5px; flex: 1; }
        button { background: #00bcd4; color: #121212; font-weight: bold; cursor: pointer; border: none; }
        button:hover { background: #00acc1; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: center; }
        th { background: #2a2a2a; color: #00bcd4; }
        .total-box { margin-top: 15px; font-size: 1.2rem; font-weight: bold; text-align: right; color: #00bcd4; }
        a { color: #888; text-decoration: none; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <a href="menu.html">&larr; Volver al Menú</a>
    <h2>Cálculo de Nómina</h2>

    <form method="POST">
        <label>Número máximo de empleados a ingresar:</label>
        <input type="number" name="max_emp" min="1" required value="<?php echo $_POST['max_emp'] ?? ''; ?>">
        <button type="submit" name="definir_limite">Establecer Límite</button>
    </form>

    <?php if (isset($_POST['definir_limite']) || isset($_POST['procesar_nomina'])): 
        $max = isset($_POST['max_emp']) ? (int)$_POST['max_emp'] : 1;
    ?>
        <form method="POST">
            <input type="hidden" name="max_emp" value="<?php echo $max; ?>">
            <?php for ($i = 0; $i < $max; $i++): ?>
                <div class="row">
                    <input type="text" name="nombre[]" placeholder="Nombre del Empleado <?php echo $i+1; ?>" required>
                    <input type="number" name="dias[]" placeholder="Días Trabajados" min="0" required>
                    <input type="number" step="0.01" name="sueldo[]" placeholder="Sueldo Diario ($)" min="0" required>
                </div>
            <?php endfor; ?>
            <button type="submit" name="procesar_nomina">Calcular Nómina</button>
        </form>
    <?php endif; ?>

    <?php
    if (isset($_POST['procesar_nomina'])) {
        $nombres = $_POST['nombre'];
        $dias = $_POST['dias'];
        $sueldos = $_POST['sueldo'];
        $total_general = 0;

        echo "<table>
                <tr>
                    <th>Nombre</th>
                    <th>Días Trab.</th>
                    <th>Sueldo Diario</th>
                    <th>Salario Base</th>
                    <th>Puntualidad (+10%)</th>
                    <th>ISR (30%)</th>
                    <th>Total Recibido</th>
                </tr>";

        for ($i = 0; $i < count($nombres); $i++) {
            $salario_base = $dias[$i] * $sueldos[$i];
            $puntualidad = $salario_base * 0.10; // Bono de puntualidad (10%)
            $isr = $salario_base * 0.30; // Deducción ISR (30%)
            $total_empleado = $salario_base + $puntualidad - $isr;
            $total_general += $total_empleado;

            echo "<tr>
                    <td>".htmlspecialchars($nombres[$i])."</td>
                    <td>{$dias[$i]}</td>
                    <td>$".number_format($sueldos[$i], 2)."</td>
                    <td>$".number_format($salario_base, 2)."</td>
                    <td>$".number_format($puntualidad, 2)."</td>
                    <td>-$".number_format($isr, 2)."</td>
                    <td><strong>$".number_format($total_empleado, 2)."</strong></td>
                  </tr>";
        }
        echo "</table>";
        echo "<div class='total-box'>Total General de Nómina: $".number_format($total_general, 2)."</div>";
    }
    ?>
</div>

</body>
</html>