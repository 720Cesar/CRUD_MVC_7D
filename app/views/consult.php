<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTAS</title>
</head>
<body>
    <H1>LISTAS</H1>
    <hr>

    <table border="3">

    <thead>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>EDAD</th>
        <th>FECHA</th>
        <th>ACCIONES</th>
    </thead>
    <tbody>
        <?php
            while($row = $usuarios -> fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['id_list']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['edad']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td>
                    <a href="index.php?action=update&id=<?php echo $row['id_list']; ?>">
                        <button>Editar</button>
                    </a>
                    <a href="">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>

        <?php
            }
        ?>
    </tbody>

    </table>

    <br>
    <a href="index.php?action=insert">
        <button>Ir a registro</button>
    </a>

</body>
</html>