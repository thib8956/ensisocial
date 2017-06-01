<?php
$title="Recherche";
include('inc/header.php');

if(isset($_POST['search'])){
	if (!empty($_POST['searchBar'])) {
        $wordList = explode(" ", $_POST['searchBar'], PHP_INT_MAX);
        for ($i = 0; $i < count($wordList); $i++) {
            $req = $db->query('Select * FROM users WHERE firstname LIKE "%'.$wordList[$i].'%"');
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
            }
        }
    }
}

include(inc/footer.php);
?>
