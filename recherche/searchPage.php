<?php
session_start();
$title="Recherche";
include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/header.php');

if(isset($_POST['search'])){
    if (!empty($_POST['searchBar'])) {
        $wordList = explode(" ", $_POST['searchBar'], PHP_INT_MAX);
        for ($i = 0; $i < count($wordList); $i++) {
            $term=$wordList[$i];
            $requete = $db->prepare('SELECT * FROM users WHERE firstname LIKE :term OR lastname LIKE :termm'); // j'effectue ma requête SQL grâce au mot-clé LIKE
            $requete->execute(array('term' => '%'.$term.'%',
                                 'termm' => '%'.$term.'%'));

            $array = array(); // on créé le tableau


            while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
            {
                array_push($array, $donnee['firstname'].' '.$donnee['lastname']); // et on ajoute celles-ci à notre tableau
            }
        }

        for ($i = 0; $i < count($array); $i++) {
            echo '<p><a href="/ensisocial/recherche/searchProfil.php" onclick="createCookie("searchID", "prout", 0)" >'.$array[$i].'</a></p>';
            echo "<br/>";
        }
    }
    else {
        header("Location: /ensisocial/page_membre.php");
    }
}

include_once($_SERVER['DOCUMENT_ROOT'].'/ensisocial/inc/footer.php');
?>
