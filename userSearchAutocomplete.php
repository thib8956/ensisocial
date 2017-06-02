<?php
include_once('inc/header.php');

$term = $_GET['term'];
$termm = $_GET['term'];

    $requete = $db->prepare('SELECT * FROM users WHERE firstname LIKE :term OR lastname LIKE :termm'); // j'effectue ma requête SQL grâce au mot-clé LIKE

    $requete->execute(array('term' => '%'.$term.'%',
        'termm' => '%'.$termm.'%'));

    $array = array(); // on créé le tableau


    while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données

    {
        array_push($array, $donnee['firstname'].' '.$donnee['lastname']); // et on ajoute celles-ci à notre tableau

    }
    echo json_encode($array); // il n'y a plus qu'à convertir en JSON

    include_once('inc/footer.php');
    ?>
