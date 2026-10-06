<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo de Alumnos</title>
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
        .aprobado { color: #4caf50; font-weight: bold; }
        .reprobado { color: #f44336; font-weight: bold; }
        .total-box { margin-top: 15px; font-size: 1.2rem; font-weight: bold; text-align: right; color: #00bcd4; }
        a { color: #888; text-decoration: none; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <a href="menu.html">&larr; Volver al Menú</a>
    <h2>Control de Alumnos y Calificaciones</h2>

    <form method="POST">
        <label>Número máximo de alumnos a registrar:</label>
        <input type="number" name="max_alu" min="1" required value="<?php echo $_POST['max_alu'] ?? ''; ?>">
        <button type="submit" name="definir_limite">Establecer Límite</button>
    </form>

    <?php if (isset($_POST['definir_limite']) || isset($_POST['procesar_alumnos'])): 
        $max = isset($_POST['max_alu']) ? (int)$_POST['max_alu'] : 1;
    ?>
        <form method="POST">
            <input type="hidden" name="max_alu" value="<?php echo $max; ?>">
            <?php for ($i = 0; $i < $max; $i++): ?>
                <div class="row">
                    <input type="text" name="nombre[]" placeholder="Nombre Alumno <?php echo $i+1; ?>" required>
                    <input type="number" step="0.1" min="0" max="10" name="p1[]" placeholder="Parcial 1 (0-10)" required>
                    <input type="number" step="0.1" min="0" max="10" name="p2[]" placeholder="Parcial 2 (0-10)" required>
                </div>
            <?php endfor; ?>
            <button type="submit" name="procesar_alumnos">Calcular Promedios</button>
        </form>
    <?php endif; ?>

    <?php
    if (isset($_POST['procesar_alumnos'])) {
        $nombres = $_POST['nombre'];
        $p1 = $_POST['p1'];
        $p2 = $_POST['p2'];
        $suma_promedios = 0;
        $total_alumnos = count($nombres);

        echo "<table>
                <tr>
                    <th>Nombre</th>
                    <th>Parcial 1</th>
                    <th>Parcial 2</th>
                    <th>Promedio</th>
                    <th>Estatus / Solución</th>
                </tr>";

        for ($i = 0; $i < $total_alumnos; $i++) {
            $promedio = ($p1[$i] + $p2[$i]) / 2;
            $suma_promedios += $promedio;
            $solucion = ($promedio >= 6.0) ? "<span class='aprobado'>Aprobado</span>" : "<span class='reprobado'>Reprobado</span>";

            echo "<tr>
                    <td>".htmlspecialchars($nombres[$i])."</td>
                    <td>{$p1[$i]}</td>
                    <td>{$p2[$i]}</td>
                    <td>".number_format($promedio, 2)."</td>
                    <td>{$solucion}</td>
                  </tr>";
        }
        echo "</table>";
        
        $promedio_general = $suma_promedios / $total_alumnos;
        echo "<div class='total-box'>Promedio General del Grupo: ".number_format($promedio_general, 2)."</div>";
    }
    ?>
</div>

</body>
</html>