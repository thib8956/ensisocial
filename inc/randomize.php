<?php
function randomize($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy0123456789"; //ABCDEFGHIJKLMNOPQRSTUVWXYZ/@()#~{[$*§]} si jamaisveut des caracs spéciaux
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}
?>