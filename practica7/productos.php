<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Productos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 550px; }
        h2 { color: #333; text-align: center; }
        input, button { width: 100%; padding: 8px; margin: 6px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #dc3545; color: white; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #c82333; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; font-size: 14px; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>
<div class="card">
    <h2>Factura de Productos</h2>
    <?php if (!isset($_POST['num_productos']) && !isset($_POST['procesar_factura'])): ?>
        <form method="POST">
            <label>Número de productos:</label>
            <input type="number" name="num_productos" min="1" required>
            <button type="submit">Continuar</button>
        </form>
    <?php elseif (isset($_POST['num_productos']) && !isset($_POST['procesar_factura'])): 
        $num = intval($_POST['num_productos']);
    ?>
        <form method="POST">
            <input type="hidden" name="num_productos" value="<?php echo $num; ?>">
            <input type="hidden" name="procesar_factura" value="1">
            <?php for ($i = 1; $i <= $num; $i++): ?>
                <fieldset style="margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; padding: 10px;">
                    <legend>Producto <?php echo $i; ?></legend>
                    <input type="text" name="producto[]" placeholder="Nombre del producto" required>
                    <input type="number" step="any" name="costo[]" placeholder="Costo unitario" min="0" required>
                    <input type="number" name="cantidad[]" placeholder="Cantidad" min="1" required>
                </fieldset>
            <?php endfor; ?>
            <button type="submit">Generar Factura</button>
        </form>
    <?php elseif (isset($_POST['procesar_factura'])): 
        $productos = $_POST['producto'];
        $costos = $_POST['costo'];
        $cantidades = $_POST['cantidad'];
        $subtotal_general = 0;
    ?>
        <table>
            <tr>
                <th>Producto</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Importe</th>
            </tr>
            <?php for ($i = 0; $i < count($productos); $i++): 
                $importe = $costos[$i] * $cantidades[$i];
                $subtotal_general += $importe;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($productos[$i]); ?></td>
                <td>$<?php echo number_format($costos[$i], 2); ?></td>
                <td><?php echo $cantidades[$i]; ?></td>
                <td>$<?php echo number_format($importe, 2); ?></td>
            </tr>
            <?php endfor; ?>
        </table>
        <div style="margin-top: 15px; text-align: right; font-size: 15px;">
            <p>Subtotal: <strong>$<?php echo number_format($subtotal_general, 2); ?></strong></p>
            <p>IVA (16%): <strong>$<?php echo number_format($subtotal_general * 0.16, 2); ?></strong></p>
            <p style="font-size: 18px; color: #28a745;">Total: <strong>$<?php echo number_format($subtotal_general * 1.16, 2); ?></strong></p>
        </div>
        <a href="" style="display:block; text-align:center; margin-top:10px;">Reiniciar</a>
    <?php endif; ?>
</div>
</body>
</html>