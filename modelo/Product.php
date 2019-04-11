<?php 
	Class Product
    {
        private $IdProducto;
        private $Nombre;
        private $Precio;
        private $Correo;
        
        public function __GET($k){
            return $this->$k;
        }
        public function __SET($k, $v){
            return $this->$k = $v; 
        }
    } 
 ?>