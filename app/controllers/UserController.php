<?php 

    // Incluir el modelo y la conexión a la BD
    include_once "app/models/UserModel.php";
    include_once "config/db_connection.php";

    // Clase del controlador
    class UserController{

        private $model;

        // Constructor de la clase
        public function __construct($connection){

            $this -> model = new UserModel($connection);

        }

        // Método para obtener la información del formulario
        public function insertarUsuario(){

            // Válidar que el botón sea diferente de nulo
            if(isset($_POST['enviar'])){
                
                $nombre = trim($_POST['nombre']);
                $edad = (int) $_POST['edad'];
                $fecha = $_POST['fecha'];
                $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

                // Llamar al método del modelo
                $insert = $this -> model -> insertarUsuario($nombre, $edad, $fecha, $pass);

                // Verificar el resultado
                if($insert){
                    echo "<br>Registro exitoso";
                }else{
                    echo "<br>Error al registrar";
                }

            }

            // Incluir la vista
            include_once "app/views/form_insert.php";

        }

        // Método para consultar usuarios
        public function consultarUsuarios(){
            $usuarios = $this -> model -> consultarUsuarios();

            include "app/views/consult.php";   

        }

        // Método para consultar por ID y actualizar el usuario. 
        public function actualizarUsuario(){

            if(isset($_GET['id']) && is_numeric($_GET['id'])){

                $id_browser = (int) $_GET['id'];

                $row = $this -> model -> consultarPorID($id_browser);

                include_once "app/views/edit.php";

                return;

            }

        }

        // Método para realizar el respaldo
        public function realizarRespaldoBD(){
            
            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "prueba";

            $backup = $this -> model -> backup_tables($server, $user, $password, $db);

            echo $backup;

            $fecha = date("Y-m-d");

            // Función que permite crear y nombrar el archivo
            header("Content-disposition: attachment; filename=db-backup-".$fecha.".sql");
            // Permiter que el archivo se descargue y no se ejecute
            header("Content-type: MIME");
            // Leer el archivo del script y mandarlo con descarga al navegador
            readfile("config/backups/db-backup-".$fecha.".sql");

        }

        // Método para la restauración
        public function restaurarBD(){
            
            $fecha = date("Y-m-d");

            $ruta = "config/backups/db-backup-" . $fecha . ".sql";

            $restore = $this -> model -> restaurarBD($ruta);

            include_once "app/views/form_insert.php";

        }


    }