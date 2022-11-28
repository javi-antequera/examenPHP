<?php 
use util\ClienteNoEncontradoException;
use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;
class Videoclub{
    private $nombre;
    private $productos=array();
    private $numProductos;
    private $socios=array();
    private $numSocios;
    private function incluirProducto(Soporte $producto){
        array_push($this->productos,$producto);
        $this->numProductos=$this->numProductos+1;
        return $this;
    }
    public function incluirCintaVideo($titulo,$numero,$precio,$duracion){
        $cinta=new CintaVideo($titulo,$numero,$precio,$duracion);
        $this->incluirProducto($cinta);
    }
    public function incluirDvd($titulo,$numero,$precio,$idiomas,$pantalla){
        $dvd=new Disco($titulo,$numero,$precio,$idiomas,$pantalla);
        $this->incluirProducto($dvd);
    }
    public function incluirJuego($titulo,$numero,$precio,$consola,$minJ,$maxJ){
        $juego=new Juego($titulo,$numero,$precio,$consola,$minJ,$maxJ);
        $this->incluirProducto($juego);
    }
    public function incluirSocio($nombre,$numero,$maxAlquileresConcurrentes=3){
        $cliente=new Cliente($nombre,$numero,$maxAlquileresConcurrentes);
        array_push($this->socios,$cliente);
        $this->numSocios=$this->numSocios+1;
    }
    public function listarProductos(){
        echo "Número de productos: $this->numProductos <br>";
        foreach($this->productos as $p){
            echo "<li> $this->productos[$p] </li>";
        }
    }
    public function listarSocios(){
        echo "Número de socios: $this->numSocios <br>";
        foreach($this->socios as $s){
            echo "<li> $this->socios[$s] </li>";
        }
    }
    public function alquilarSocioProducto($numeroCliente,$numeroSoporte){
        $socio= false;
        $producto= false;
            foreach ($this->socios as $soci) {
                if ($soci->getNumero() == $numeroCliente) {
                    $socio= true;
                    foreach ($this->productos as $sop) {
                        if ($sop->getNumero() == $numeroSoporte) {
                            $producto = true;
                            $soci->alquilar($sop);
                            }
                        }
                }
            }
            if(!$producto){
                throw new SoporteNoEncontradoException("<h3>Error: no existe ese soporte</h3>");
            }
            if(!$socio){
                throw new ClienteNoEncontradoException("<h3 ->Error: socio no registrado</h3>");
            }
            return $this;
        }
}
?>