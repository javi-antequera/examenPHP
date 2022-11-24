<?php
class Soporte{
    public $titulo;
    protected $numero;
    private $precio;
    private const IVA=21/100;
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
        
     }
}
 ?>