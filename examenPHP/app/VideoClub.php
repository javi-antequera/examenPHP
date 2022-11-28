<?php 
use util\ClienteNoEncontradoException;
use util\CupoSuperadoException;
use util\SoporteNoEncontradoException;
use util\SoporteYaAlquiladoException;
include_once "Juego.php";
include_once "Disco.php";
include_once "CintaVideo.php";
include_once "Cliente.php";
class Videoclub{
    private $nombre;
    private $productos=array();
    private $numProductos;
    private $socios=array();
    private $numSocios;
    private $numProductosAlquilados;
    private $numTotalAlquileres;
    public function __construct($nombre)
    {
        $this->$nombre=$nombre;
    }
    public function getNumProductosAlquilados()
    {
        return $this->numProductosAlquilados;
    }
    public function setNumProductosAlquilados($numProductosAlquilados){
        $this->numProductosAlquilados = $numProductosAlquilados;
     }

    public function getNumTotalAlquileres()
    {
        return $this->numTotalAlquileres;
    }
    public function setNumTotalAlquileres($numTotalAlquileres){
        $this->numTotalAlquileres = $numTotalAlquileres;
     }
    private function incluirProducto(Soporte $producto){
        array_push($this->productos,$producto);
        $this->numProductos=$this->numProductos+1;
        return $this;
    }
    public function incluirCintaVideo($titulo,$numero,$precio,$duracion){
        $cinta=new CintaVideo($titulo,$numero,$precio,$duracion);
        $this->incluirProducto($cinta);
        $cinta->alquilado=true;
    }
    public function incluirDvd($titulo,$numero,$precio,$idiomas,$pantalla){
        $dvd=new Disco($titulo,$numero,$precio,$idiomas,$pantalla);
        $this->incluirProducto($dvd);
        $dvd->alquilado=true;
    }
    public function incluirJuego($titulo,$numero,$precio,$consola,$minJ,$maxJ){
        $juego=new Juego($titulo,$numero,$precio,$consola,$minJ,$maxJ);
        $this->incluirProducto($juego);
        $juego->alquilado=true;
    }
    public function incluirSocio($nombre,$numero,$maxAlquileresConcurrentes=3){
        $cliente=new Cliente($nombre,$numero,$maxAlquileresConcurrentes);
        array_push($this->socios,$cliente);
        $this->numSocios++;
    }
    public function listarProductos(){
        echo "Número de productos: $this->numProductos <br>";
        $listadoProd =  [];
        foreach($this->productos as $p){
            array_push($listadoProd,$p->titulo);
        }
        foreach($listadoProd as $p){
            echo "<li> $p </li>";
        }
    }
    public function listarSocios(){
        echo "Número de Socios: $this->numSocios <br>";
        $listadoSoci =  [];
        foreach($this->socios as $s){
            array_push($listadoSoci,$s->nombre);
        }
        foreach($listadoSoci as $s){
            echo "<li> $s </li>";
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
                //throw new SoporteNoEncontradoException("<h3>Error: no existe ese soporte</h3>");
            }
            if(!$socio){
                //throw new ClienteNoEncontradoException("<h3 ->Error: socio no registrado</h3>");
            }
            return $this;
        }
        public function alquilarSocioProductos($numSocio,$numerosProductos)
        {
            $alquilado = false;
                foreach ($this->productos as $p) {
                    foreach ($numerosProductos as $numProducto) {
                        if ($p->getNumero() == $numProducto) {
                            if ($p->alquilado==true) {
                                $alquilado = true;
                            }
                        }
                    }
                }
                if (!$alquilado) {
                    foreach ($numerosProductos as $numProducto) {
                        $this->alquilarSocioProducto($numSocio, $numProducto);
                    }
                } else {
                    throw new SoporteYaAlquiladoException("<h3>Error: alguno de los soportes ya está alquilado  </h3>");
                }
            return $this;
        }
        public function devolverSocioProducto($numSocio,$numeroProducto){
            $socio= false;
            $producto= false;
                foreach ($this->socios as $soci) {
                    if ($soci->getNumero() == $numSocio) {
                        $socio= true;
                        foreach ($this->productos as $sop) {
                            if ($sop->getNumero() == $numeroProducto) {
                                $producto = true;
                                $soci->devolver($sop->getNumero());
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
            public function devolverSocioProductos($numSocio,$numerosProductos)
            {
                $estaAlquilado=true;
                foreach ($this->socios as $soci) {
                    if ($soci->getNumero() == $numSocio) {
                        foreach ($numerosProductos as $numProducto) {
                            foreach ($this->productos as $producto) {
                                if ($producto->getNumero() == $numProducto) {
                                    if (!$soci->tieneAlquilado($producto)) {//Si no lo tiene alquilado
                                        $estaAlquilado = false;
                                    }
                                }
                            }
                        }
                    }
                }
                if ($estaAlquilado) {
                    foreach ($numerosProductos as $numeroP) {
                        $this->devolverSocioProducto($numSocio,$numeroP);
                    }
                } 
            }
}
?>