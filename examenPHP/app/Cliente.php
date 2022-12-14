<?php
include_once "autoload.php";

use util\CupoSuperadoException;
use util\SoporteYaAlquiladoException;
use util\SoporteNoEncontradoException;

class Cliente{
    public $nombre;
    private $numero;
    private $soportesAlquilados=array();
    private $numSoportesAlquilados;
    private $maxAlquilerConcurrente;

    public function __construct($nombre,$numero,$maxAlquilerConcurrente=3){
        $this->nombre=$nombre;
        $this->numero=$numero;
        $this->maxAlquilerConcurrente=$maxAlquilerConcurrente;
    }
    public function getNumero(){
        return $this->numero;
     }
     public function setNumero($numero){
        $this->numero = $numero;
     }
     public function getNumSoportesAlquilados(){
        return $this->numSoportesAlquilados;
     }  
     public function tieneAlquilado(Soporte $s){
        if(in_array($s,$this->soportesAlquilados)){
            return true;
        }else{
            return false;
        }
     }
     public function alquilar(Soporte $s){
        if($this->tieneAlquilado($s)){
            throw new SoporteYaAlquiladoException("<h3>Error: Este soporte ya esta alquilado</h3>");
            //echo "Este soporte ya está alquilado <br>";
        }else if($this->numSoportesAlquilados>=$this->maxAlquilerConcurrente){
            throw new CupoSuperadoException ("<h3>Error: Cupo superado</h3>") ;
            //echo "Se ha superado el cupo de alquileres <br>";
        }else{
            $this->numSoportesAlquilados++;
            array_push($this->soportesAlquilados,$s); 
            $s->alquilado=true;
            echo "Alquiler realizado correctamente <br>";
        }
        return $this;
     }
     public function devolver(int $numSoporte){
        $alquilado=false;
        foreach($this->soportesAlquilados as $a){
            if($a->numero==$numSoporte){    
                $alquilado=true;
                $a->alquilado=true;
                unset($this->soportesAlquilados,$a);
            } 
        }
        if($alquilado){
            echo "Devolución realizada correctamente <br>";
            $this->numSoportesAlquilados--;
        }else{
            throw new SoporteNoEncontradoException("<h3>Error: No se encuentra este soporte</h3>");
            //echo "Este soporte no se encuentra alquilado <br>";
        }
    }
    public function listaAlquileres(){
        echo "<br>Usted tiene : " . /*count($this->soportesAlquilados)*/$this->numSoportesAlquilados . " alquileres: <br>";
        $cont=1;
        foreach($this->soportesAlquilados as $a){  
            echo ("Alquiler $cont: ".$a->titulo);
            echo"<br>";
            $cont++;
        }

    }
     public function muestraResumen(){
        echo "<br>Nombre : <strong>" . $this->nombre . "</strong>"; 
        echo "<br>Cantidad de alquileres : " . count($this->soportesAlquilados) . " "; 
     }
}
?>