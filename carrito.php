<?php
session_start();

$productos = [
    1 => ["nombre" => "Lavado exterior", "precio" => 80],
    2 => ["nombre" => "Lavado interior", "precio" => 120],
    3 => ["nombre" => "Lavado completo", "precio" => 180],
];

if (isset($_GET["add"])) {
    $id = $_GET["add"];

    if (!isset($_SESSION["carrito"][$id])) {
        $_SESSION["carrito"][$id] = 1;
    } else {
        $_SESSION["carrito"][$id]++;
    }
}
if (isset($_GET["vaciar"])) {
    session_destroy();
    header("Location: carrito.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>Carrito de compras</h1>

    <nav>
        <a href="inicio.html">Inicio</a>
        <a href="servicios.php">Servicios</a>
        <a href="carrito.php">Carrito</a>
        <a href="contacto.html">Contacto</a>
    </nav>
</header>

<section class="carrito">

    <h2>Productos agregados</h2>

    <?php
    if (empty($_SESSION["carrito"])) {
        echo "<p>Tu carrito está vacío.</p>";
    } else {
        $total = 0;

        foreach ($_SESSION["carrito"] as $id => $cant) {
            $nombre = $productos[$id]["nombre"];
            $precio = $productos[$id]["precio"];
            $subtotal = $precio * $cant;
            $total += $subtotal;

            echo "<p>$nombre (x$cant) — $$subtotal MXN</p>";
        }

        echo "<h3>Total: $$total MXN</h3>";
        echo '<a class="btn" href="carrito.php?vaciar=1">Vaciar carrito</a>';
    }
    ?>

</section>

<footer>
   <p>© 2025 Car Wash El Brillante</p> <p>Horario:Lunes a Domingo, 8:00AM-7:00PM</p>
</footer>
</body>
</html>