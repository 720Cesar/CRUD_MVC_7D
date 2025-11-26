<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <h1>INSERTAR PRODUCTO</h1>
    <hr>

    <form action="" method="POST">

        <input type="text" name="nombre" placeholder="Nombre">
        <input type="number" step="0.01" name="precio" placeholder="Precio ($0.00)">
        <input type="text" name="marca" placeholder="Marca">
        <br><br>

        <input type="submit" name="enviar" value="Enviar">

    </form>

    <br><br>
    <a href="index.php?controller=user&action=consult">
        <button>Ver usuarios</button>
    </a>

</body>
</html>