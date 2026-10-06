<?php
// Función para convertir números a su representación en letras
function numeroALetras($numero) {
    $enteros = floor($numero);
    $centavos = round(($numero - $enteros) * 100);
    
    $unidades = ['', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
    $decenas = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
    $especiales = [11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce', 15 => 'quince'];
    $centenas = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecentos'];

    if ($enteros == 0) return "Cero pesos con ".sprintf("%02d", $centavos)."/100 M.N.";
    if ($enteros == 100) return "Cien pesos con ".sprintf("%02d", $centavos)."/100 M.N.";

    $texto = "";

    // Cientos
    if ($enteros >= 100) {
        $texto .= $centenas[floor($enteros / 100)] . " ";
        $enteros %= 100;
    }

    // Decenas y unidades
    if ($enteros >= 11 && $enteros <= 15) {
        $texto .= $especiales[$enteros] . " ";
    } else {
        if ($enteros >= 10) {
            $texto .= $decenas[floor($enteros / 10)] . " ";
            $enteros %= 10;
            if ($enteros > 0) $texto .= "y ";
        }
        if ($enteros > 0) {
            $texto .= $unidades[$enteros] . " ";
        }
    }

    return ucfirst(trim($texto)) . " pesos con " . sprintf("%02d", $centavos) . "/100 M.N.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo Refaccionaria</title>
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
        .factura-box { background: #252525; border: 1px solid #00bcd4; padding: 15px; border-radius: 6px; margin-top: 20px; }
        .factura-box h3 { color: #00bcd4; margin-bottom: 10px; }
        a { color: #888; text-decoration: none; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <a href="menu.html"> &larr; Volver al Menú</a>
    <h2>Punto de Venta - Refaccionaria</h2>

    <form method="POST">
        <label>¿Cuántas refacciones registrará?</label>
        <input type="number" name="max_ref" min="1" required value="<?php echo $_POST['max_ref'] ?? ''; ?>">
        <button type="submit" name="definir_limite">Continuar</button>
    </form>

    <?php if (isset($_POST['definir_limite']) || isset($_POST['generar_factura'])): 
        $max = isset($_POST['max_ref']) ? (int)$_POST['max_ref'] : 1;
    ?>
        <form method="POST">
            <input type="hidden" name="max_ref" value="<?php echo $max; ?>">
            <?php for ($i = 0; $i < $max; $i++): ?>
                <div class="row">
                    <input type="text" name="refaccion[]" placeholder="Nombre Refacción <?php echo $i+1; ?>" required>
                    <input type="number" step="0.01" min="0" name="costo[]" placeholder="Costo ($)" required>
                    <input type="number" min="1" name="cantidad[]" placeholder="Cantidad" required>
                </div>
            <?php endfor; ?>
            <button type="submit" name="generar_factura">Generar Factura</button>
        </form>
    <?php endif; ?>

    <?php
    if (isset($_POST['generar_factura'])) {
        $refacciones = $_POST['refaccion'];
        $costos = $_POST['costo'];
        $cantidades = $_POST['cantidad'];

        $subtotal = 0;
        $num_factura = "FACT-" . rand(1000, 9999);

        echo "<div class='factura-box'>";
        echo "<h3>Factura No: {$num_factura}</h3>";
        
        echo "<table>
                <tr>
                    <th>Refacción</th>
                    <th>Costo U.</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>";

        for ($i = 0; $i < count($refacciones); $i++) {
            $importe = $costos[$i] * $cantidades[$i];
            $subtotal += $importe;

            echo "<tr>
                    <td>".htmlspecialchars($refacciones[$i])."</td>
                    <td>$".number_format($costos[$i], 2)."</td>
                    <td>{$cantidades[$i]}</td>
                    <td>$".number_format($importe, 2)."</td>
                  </tr>";
        }

        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;
        $total_letra = numeroALetras($total);

        echo "</table>";

        echo "<div style='margin-top: 15px; text-align: right;'>";
        echo "<p><strong>Subtotal (Importe Total):</strong> $".number_format($subtotal, 2)."</p>";
        echo "<p><strong>IVA (16%):</strong> $".number_format($iva, 2)."</p>";
        echo "<p style='font-size: 1.3rem; color: #00bcd4;'><strong>TOTAL: $".number_format($total, 2)."</strong></p>";
        echo "<p style='margin-top: 10px; font-style: italic;'><strong>Total en Letra:</strong> {$total_letra}</p>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>