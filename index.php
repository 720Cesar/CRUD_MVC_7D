<?php

    // Llamar a al controlador y a la conexión
    include_once "app/controllers/UserController.php";
    include_once "app/controllers/ProductController.php";
    include_once "app/controllers/ReportController.php";
    include_once "config/db_connection.php";

    // Se evalua si existe el controlador y su método
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
    $action = isset($_GET['action']) ? $_GET['action'] : 'insert';

    switch($controller){
        case 'user':
            $controllerInstance = new UserController($connection);
            break;
        case 'product':
            $controllerInstance = new ProductController($connection);
            break;
        case 'report':
            $controllerInstance = new ReportController($connection);
            break;
        default:
            echo "No se encontró el controlador";
            exit();
    }

    switch($action){

        case 'insert':
            $controllerInstance -> insertarUsuario();
            break;
        case 'consult':
            $controllerInstance -> consultarUsuarios();
            break;
        case 'update':
            $controllerInstance -> actualizarUsuario();
            break;
        case 'backup':
            $controllerInstance -> realizarRespaldoBD();
            break;
        case 'restore':
            $controllerInstance -> restaurarBD();
            break;
        case 'insertProduct':
            $controllerInstance -> insertarProducto();
            break;
        case 'pdf_report':
            $controllerInstance -> generarPDF();
            break;
        case 'pdf_graph':
            $controllerInstance -> generarGrafica();
            break;
        case 'pdf_pie':
            $controllerInstance -> generarPastel();
            break;
        default:
            echo "No se encontró el método";
            break;

    }
