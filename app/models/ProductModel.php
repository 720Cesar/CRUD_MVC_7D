<?php

    class ProductModel{

        private $connection;

        public function __construct($connection){
            $this -> connection = $connection;
        }

        // Método para insertar productos
        public function insertarProducto($nombre, $precio, $marca){

            $sql_statement = "INSERT INTO producto (nombre, precio, marca) VALUES (?, ?, ?)";

            $statement = $this -> connection -> prepare($sql_statement);
            $statement -> bind_param("sds", $nombre, $precio, $marca);

            return $statement -> execute();

        }


    }