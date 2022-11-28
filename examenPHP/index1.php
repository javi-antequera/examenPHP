<?php
// include_once "Cintavideo.php";
// include "autoload.php";
/*use app\CintaVideo;*/
// $soporte1 = new Soporte("Tenet", 22, 3); 
// echo "<strong>" . $soporte1->titulo . "</strong>"; 
// echo "<br>Precio: " . $soporte1->getPrecio() . " euros"; 
// echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros";
// $soporte1->muestraResumen();


$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107); 
echo "<strong>" . $miCinta->titulo . "</strong>"; 
echo "<br>Precio: " . $miCinta->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros";
$miCinta->muestraResumen();
