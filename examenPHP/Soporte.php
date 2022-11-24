<?php
class Soporte{
    public $titulo;
    protected $numero;
    private $precio;
     const IVA=21/100;
    public function __construct($titulo,$numero,$precio){
        $this->titulo=$titulo;
        $this->numero=$numero;
        $this->precio=$precio;
    }
    public function getPrecio(){
        return $this->precio;
     }
     public function getPrecioConIva(){
        return $this->precio + $this->precio* $this::IVA;
     }
     public function getNumero(){
        return $this->numero;
     }
     public function muestraResumen(){
        echo "<br>Titulo: <strong>" . $this->titulo . "</strong>"; 
        echo "<br>Precio: " . $this->getPrecio() . " euros"; 
        echo "<br>Precio IVA incluido: " . $this->getPrecioConIVA() . " euros";
     }
}
 ?>