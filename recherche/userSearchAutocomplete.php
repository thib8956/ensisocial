<?php
//ne pas mettre le header ni le footer ici, cette page ne s'affiche pas, c'est juste un script php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}

$term = $_GET['term'];
$termm = $_GET['term'];

$requete = $db->prepare('SELECT * FROM users WHERE firstname LIKE :term OR lastname LIKE :termm'); // j'effectue ma requête SQL grâce au mot-clé LIKE

$requete->execute(array('term' => $term.'%',
    'termm' => $termm.'%'));

$array = array(); // on créé le tableau

while ($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $donnee['firstname'].' '.$donnee['lastname']); // et on ajoute celles-ci à notre tableau
}
echo json_encode($array); // il n'y a plus qu'à convertir en JSON

    while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données

    {
        array_push($array, $donnee['firstname'].' '.$donnee['lastname']); // et on ajoute celles-ci à notre tableau

    }
    echo json_encode($array); // il n'y a plus qu'à convertir en JSON
?>
