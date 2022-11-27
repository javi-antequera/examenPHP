<?php
/*
   -CLASES ABSTRACTAS-
   Las clases abstractas son clases que sólo pueden ser heredadas, y definen métodos para las clases que las extienden
   Esto traslada un funcionamiento obligatorio a sus clases hijas
   Mejora la calidad del código y ayudan a reducir la cantidad de código duplicado.
   -------------------
   -¿Hace falta que también los hijos implementen la interfaz?-
   No hace falta, ya que al heredar de esta también implementan la interfaz, teniendo acceso a 
   la o las funciones de la interfaz
*/ 
abstract class Soporte implements Resumible{
    public $titulo;
    public $numero;
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
        echo "<br>Nº de soporte: " . $this->getNumero() . ""; 
        echo "<br>Precio: " . $this->getPrecio() . " euros"; 
        echo "<br>Precio IVA incluido: " . $this->getPrecioConIVA() . " euros";
     }

}
 ?>