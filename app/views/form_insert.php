<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
    <h1>REGISTRAR USUARIO</h1>
    <hr>

    <form action="" method="POST">

        <b><label for="nombre">Nombre:</label></b>
        <input type="text" name="nombre">
        <br><br>

        <b><label for="edad">Edad:</label></b>
        <input type="number" name="edad" min="1" max="120">
        <br><br>

        <b><label for="fecha">Fecha:</label></b>
        <input type="date" name="fecha" min="1940-12-31" max="2025-10-31">
        <br><br>

        <b><label for="pass">Contraseña:</label></b>
        <input type="password" name="pass">
        <br><br>

        <input type="submit" name="enviar" value="Enviar">

    </form>

    <br>
    <a href="index.php?action=consult">
        <button>Ir a listas</button>
    </a>

    <a href="index.php?controller=product&action=insertProduct">
        <button>Ir a productos</button>
    </a>

    <a href="index.php?controller=user&action=backup">
        <button>RESPALDO</button>
    </a>

    <a href="index.php?controller=user&action=restore">
        <button>RESTAURAR</button>
    </a>

    <a href="index.php?controller=report&action=pdf_report">
        <button>GENERAR PDF</button>
    </a>

    <a href="index.php?controller=report&action=pdf_graph">
        <button>GENERAR GRÁFICA</button>
    </a>
    <a href="index.php?controller=report&action=pdf_pie">
        <button>GENERAR PASTEL</button>
    </a>

    <?php if(isset($restore)){ ?>
        <br><br>
        <?php echo $restore; ?> 

        <script>
            setTimeout(function() {
                window.location.href = "index.php?controller=user&action=insert";
            }, 3000);
        </script>

    <?php } ?>

</body>
</html>