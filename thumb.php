<?php
function thumb($imagefile, $w) {

    $ext = substr($imagefile, -3); //Obtener extensión de la imágen
    
    /* Chequear que las imágenes sean de alguno de los formatos soportados. Por medio de la función strtolower(), pasamos la extensión a minúsculas */
    
    if(strtolower($ext) == "gif") {
        if (!$src_img = imagecreatefromgif($imagefile)) {
            echo "Error abriendo $imagefile!"; exit;
        }
    } else if(strtolower($ext) == "jpg") {
        if (!$src_img = imagecreatefromjpeg($imagefile)) {
            echo "Error abriendo $imagefile!"; exit;
        }
    } else if(strtolower($ext) == "png") {
        if (!$src_img = imagecreatefrompng($imagefile)) {
            echo "Error abriendo $imagefile!"; exit;
        }
    } else {
        echo "Formato de imágen no soportada"; exit;
    }
    
    /*La función getimagesize devuelve un array con la siguiente estructura:
        array {
            [0] => "ancho en pixeles"
            [1] => "alto en pixeles"
            [2] => "tipo de imágen (1=GIF; 2=JPG; 3=PNG)"
            [3] => "width=xxx height=yyy" (para usar con el tag img de HTML)
        }
    */
    
    $hw = getimagesize($imagefile);
    /* $w es el ancho para la nueva imágen */
    $new_w = $w;
    /* A través del cociente entre el alto y el cociente entre la anchura original y la anchura nueva, mantenemos las proporciones de la imágen.*/
    $new_h = $hw["1"]/($hw["0"]/$w); 

    /* Intentamos crear una imágen 'true color'. Esta función es soportada a partir de GD 2.0, por lo que en caso de no funcionar, se usará la función imageCreate */
    $dst_img = @imagecreatetruecolor($new_w, $new_h);
    if(!$dst_img) {
      $dst_img = imageCreate($new_w, $new_h);
    }
    
    /* Se crea la imágen con los valores obtenidos y borramos las imágenes de la memoria. */
    imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
    imagejpeg($dst_img); 
    ImageDestroy($src_img); 
    ImageDestroy($dst_img); 
}

/* Se indica el tipo de archivo */
header("Content-type: image/jpeg");

/* Llamamos a la función para crear el thumbnail con los valores obtenidos por HTTP GET */
thumb($_GET[image], $_GET[w]);

?> 