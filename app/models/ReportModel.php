<?php

    class ReportModel{

        private $connection;

        public function __construct($connection){
            $this -> connection = $connection;
        }

        // Método para consultar los usuarios
        public function consultarUsuarios(){

            $sql_statement = "SELECT * FROM lista";
            
            $result = $this -> connection -> query($sql_statement);

            return $result;

        }

        // Método para consultar los productos
        public function consultarProductos(){
            $sql_statement = "SELECT * FROM producto";

            $result = $this -> connection -> query($sql_statement);

            $data = [];

            while($row = $result -> fetch_assoc()){
                $data[] = [$row['nombre'], (float) $row['precio']];
            }

            return $data;
        }

        public function consultarMarcas(){

            $sql_statement = "SELECT marca, COUNT(*) AS total FROM producto GROUP BY marca";
            $result = $this -> connection -> query($sql_statement);

            $data = [];

            while($row = $result -> fetch_assoc()){
                $data[] = [$row['marca'], (int) $row['total']];
            }

            return $data;

        }

    }