<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <h1>EDITAR USUARIO: <?php echo $row['nombre']; ?></h1>
    <hr>

    <form action="" method="POST">

        <b><label for="nombre">Nombre:</label></b>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>">
        <br><br>

        <b><label for="edad">Edad:</label></b>
        <input type="number" name="edad" min="1" max="120" value="<?php echo $row['edad']; ?>">
        <br><br>

        <b><label for="fecha">Fecha:</label></b>
        <input type="date" name="fecha" min="1940-12-31" max="2025-10-31" value="<?php echo $row['fecha']; ?>">
        <br><br>

        <button name="editar">Enviar</button>

    </form

</body>
</html>