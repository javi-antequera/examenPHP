<?php
include "Soporte.php";
class Juego extends Soporte{
    public $consola;
    private $minNumJugadores;
    private $maxNumJugadores;
    public function __construct($titulo,$numero,$precio,$minNumJugadores,$maxNumJugadores){
        parent::__construct($titulo,$numero,$precio);
        $this->minNumJugadores=$minNumJugadores;
        $this->maxNumJugadores=$maxNumJugadores;
    }
    public function muestraJugadoresPosibles(){
        if($this->minNumJugadores==1 && $this->maxNumJugadores==1){
            echo "Para un jugador";
        }else if($this->minNumJugadores==$this->maxNumJugadores){
            echo "Para $this->minNumJugadores jugadores";
        }else{
            echo "De $this->minNumJugadores a $this->maxNumJugadores jugadores";
        }
    }
    public function muestraResumen(){
        parent:: muestraResumen();
        echo "<br>";
        echo $this->muestraJugadoresPosibles(); 
    }
}
?>