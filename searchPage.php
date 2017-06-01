<?php
$title="Recherche";
include('header.php');

if(isset($_POST['search'])){
    if (!empty($_POST['searchBar'])) {
        $wordList = explode(" ", $_POST['searchBar'], PHP_INT_MAX);
        for ($i = 0; $i < count($wordList); $i++) {
            /*$req = $db->query('Select * FROM users WHERE firstname LIKE "%'.$wordList[$i].'%"');
            $rep = $req->fetch();
            if(!empty($rep)) {
                 echo "<p>".$rep['firstname']." ".$rep['lastname']."</p>";
            }
            else {
                $req = $db->query('Select * FROM users WHERE lastname LIKE "%'.$wordList[$i].'%"');
                $rep = $req->fetch();
                if(!empty($rep)) {
                    echo "<p>".$rep['firstname']." ".$rep['lastname']."</p>";
                }
            }*/
            
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
            echo $array[$i];
            echo "<br/>";
        }
    }
    else {
        header("Location: page_membre.php");
    }
}

?>