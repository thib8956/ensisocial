<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}

$compt= (isset($_POST["num"])) ? $_POST["num"] : NULL ;
$action =(isset($_POST["action"])) ? $_POST["action"] : NULL ;
$iduser=(isset($_POST['iduser'])) ? $_POST['iduser'] : NULL ;


function thumb($id,$action,$conn,$iduser){
	$hasvote=$conn->query('SELECT * FROM vote');
	$vote=$hasvote->fetch();
	echo $vote["iduser"];
	if($vote['iduser']==$iduser && $vote['idnews']==$id){
		if($vote['vote']){
			$thumbdown=$conn->prepare('UPDATE `newsfeed` 
				SET `score` = `score`-1 WHERE `id` =:id ;');
			$thumbdown->execute(array('id'=>$id));
		}else{
			$thumbup=$conn->prepare('UPDATE `newsfeed` 
				SET `score` = `score`+1 WHERE `id` =:id ;');

			$thumbup->execute(array('id'=>$id));
		}
		$deletevote=$conn->prepare('DELETE FROM `vote` WHERE iduser=:iduser and idnews=:idnews');
		$deletevote->execute(array('iduser'=>$iduser,
									'idnews'=>$id));
	}else{
		if($action== 1){
			$thumbdown=$conn->prepare('UPDATE `newsfeed` 
				SET `score` = `score`-1 WHERE `id` =:id ;');
			$thumbdown->execute(array('id'=>$id));
			$votee=false;
			
		} else{
			$thumbup=$conn->prepare('UPDATE `newsfeed` 
				SET `score` = `score`+1 WHERE `id` =:id ;');

			$thumbup->execute(array('id'=>$id));
			$votee=true;
			
		}
		$voted=$conn->prepare('INSERT INTO `vote` (`iduser`, `idnews`, `pk_vote`, `vote`) VALUES (:iduser, :idnews, NULL, :vote)');
		$voted->execute(array('iduser'=>$iduser,
										'idnews'=>$id,
										'vote'=>$votee));
	}

}

thumb($compt,$action,$db,$iduser);
?>