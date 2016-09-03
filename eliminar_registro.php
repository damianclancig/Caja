<?php
include("coneccion.php");
$idcaja = $_GET[idcaja];
// Actualizo el campo recibido por GET con la informacion que tambien hemos recibido
mysqli_query($link,"DELETE FROM caja WHERE idcaja = ".$idcaja."");
mysqli_close($link);
?>