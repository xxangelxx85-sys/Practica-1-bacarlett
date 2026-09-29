<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Promedio de Alumnos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 500px; }
        h2 { color: #333; text-align: center; }
        input, button { width: 100%; padding: 8px; margin: 6px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #ffc107; color: #333; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #e0a800; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; font-size: 14px; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>
<div class="card">
    <h2>Control de Alumnos</h2>
    <?php if (!isset($_POST['num_alumnos']) && !isset($_POST['procesar_calificaciones'])): ?>
        <form method="POST">
            <label>Número de alumnos:</label>
            <input type="number" name="num_alumnos" min="1" required>
            <button type="submit">Continuar</button>
        </form>
    <?php elseif (isset($_POST['num_alumnos']) && !isset($_POST['procesar_calificaciones'])): 
        $num = intval($_POST['num_alumnos']);
    ?>
        <form method="POST">
            <input type="hidden" name="num_alumnos" value="<?php echo $num; ?>">
            <input type="hidden" name="procesar_calificaciones" value="1">
            <?php for ($i = 1; $i <= $num; $i++): ?>
                <fieldset style="margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; padding: 10px;">
                    <legend>Alumno <?php echo $i; ?></legend>
                    <input type="text" name="nombre[]" placeholder="Nombre" required>
                    <input type="number" step="any" name="c1[]" placeholder="Calificación 1" min="0" max="100" required>
                    <input type="number" step="any" name="c2[]" placeholder="Calificación 2" min="0" max="100" required>
                    <input type="number" step="any" name="c3[]" placeholder="Calificación 3" min="0" max="100" required>
                </fieldset>
            <?php endfor; ?>
            <button type="submit">Calcular Promedios</button>
        </form>
    <?php elseif (isset($_POST['procesar_calificaciones'])): 
        $nombres = $_POST['nombre'];
        $c1 = $_POST['c1'];
        $c2 = $_POST['c2'];
        $c3 = $_POST['c3'];
        $total_general = 0;
        $total_alumnos = count($nombres);
    ?>
        <h3>Resultados</h3>
        <table>
            <tr>
                <th>Nombre</th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>Promedio</th>
            </tr>
            <?php for ($i = 0; $i < $total_alumnos; $i++): 
                $promedio_alumno = ($c1[$i] + $c2[$i] + $c3[$i]) / 3;
                $total_general += $promedio_alumno;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($nombres[$i]); ?></td>
                <td><?php echo $c1[$i]; ?></td>
                <td><?php echo $c2[$i]; ?></td>
                <td><?php echo $c3[$i]; ?></td>
                <td><strong><?php echo number_format($promedio_alumno, 2); ?></strong></td>
            </tr>
            <?php endfor; ?>
        </table>
        <p style="text-align: right; margin-top: 15px; font-size: 16px;">
            <strong>Promedio Global: <?php echo number_format($total_general / $total_alumnos, 2); ?></strong>
        </p>
        <a href="" style="display:block; text-align:center; margin-top:10px;">Reiniciar</a>
    <?php endif; ?>
</div>
</body>
</html>