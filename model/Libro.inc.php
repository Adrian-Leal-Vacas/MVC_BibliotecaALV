<?php
    class Libro {
        // Atributos
        protected $id;
        protected $titulo;
        protected $autor;
        protected $descripcion;
        // Constructor
        function __construct($id, $titulo = "sin titulo", $autor = "sin autor", $descripcion = "Sin descripcion") {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->descripcion = $descripcion;
        }
        // Setters and Getters
        // id
        public function getId()
        {
                return $this->id;
        }
        public function setId($id)
        {
                $this->id = $id;
        }
        // titulo
        public function getTitulo()
        {
                return $this->titulo;
        }
        public function setTitulo($titulo)
        {
                $this->titulo = $titulo;
        }
        // autor
        public function getAutor()
        {
                return $this->autor;
        } 
        public function setAutor($autor)
        {
                $this->autor = $autor;
        }
        // descripcion 
        public function getDescripcion()
        {
                return $this->descripcion;
        }
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;
        }
    }
?>