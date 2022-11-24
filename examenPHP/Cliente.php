<?php 
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
            echo "Este soporte ya está alquilado";
        }else if($this->numSoportesAlquilados>=$this->maxAlquilerConcurrente){
            echo "Se ha superado el cupo de alquileres";
        }else{
            $this->numSoportesAlquilados=$this->getNumSoportesAlquilados()+1;
            array_push($soportesAlquilados,$s); 
            echo "Alquiler realizado correctamente";
        }
     }
     public function devolver(int $numSoporte){
        $alquilado=false;
        foreach($this->soportesAlquilados as $a){
            if($a->numero==$numSoporte){    
                $alquilado=true;
            } 
        }
        if($alquilado){
            echo "Devolución realizada correctamente";
            $this->numSoportesAlquilados=$this->getNumSoportesAlquilados()-1;
        }else{
            echo "Este soporte no se encuentra alquilado";
        }
    }
    public function listaAlquileres(){
        echo "<br>Usted tiene : " . count($this->soportesAlquilados) . " alquileres: <br>";
        foreach($this->soportesAlquilados as $a){
            echo $a;
        }
    }
     public function muestraResumen(){
        echo "<br>Nombre : <strong>" . $this->nombre . "</strong>"; 
        echo "<br>Cantidad de alquileres : " . count($this->soportesAlquilados) . " "; 
     }
}
?>