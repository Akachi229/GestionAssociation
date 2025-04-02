<?php 
require_once("connexion.php") ;
	
	if (isset($_GET['pp']) and !empty($_GET['pp']) and ctype_digit($_GET['pp']) == 1) {
		$perPage= $_GET['pp'];
	}else{
		$perPage=5;
	}
	

	$req=$dbh->query("SELECT COUNT(*) as total FROM membres");
	$result=$req->fetch();
	$total=$result['total'];

		$nb=ceil($total/$perPage);
		if (isset($_GET['p']) and !empty($_GET['p']) and ctype_digit($_GET['p']) == 1) {
			if ($_GET['p'] > $nb) {
				$current = $nb;
			}else{
				$current=$_GET['p'];
			}
		}else{
			$current = 1;
		}

			$firstOfPage=($current-1)*$perPage;
			$reqMembres=$dbh->query("SELECT * FROM membres ORDER BY nommembres");

/*Pour compter le nombre d'utilisateur deja enregistrer dans la base*/

	$reqdon=$dbh->query("SELECT COUNT(*) as totaldon FROM don");
	$resultdon=$reqdon->fetch();
	$totaldon=$resultdon['totaldon'];
	/*========================================================*/
	/*Pour compter le nombre de communes*/
	$reqcommunes=$dbh->query("SELECT COUNT(*) as totalcommunes FROM communes");
	$resultcommunes=$reqcommunes->fetch();
	$totalcommunes=$resultcommunes['totalcommunes'];
	/*Fin de la requete Pour compter le nombre de communes*/

	/*Pour compter le nombre de communes*/
	$reqdep=$dbh->query("SELECT COUNT(*) as totaldep FROM departements");
	$resultdep=$reqdep->fetch();
	$totaldep=$resultdep['totaldep'];
	/*Fin de la requete Pour compter le nombre de communes*/
 $requser=$dbh->query("SELECT COUNT(*) as totaluser FROM utilisateurs");
        $resultuser=$requser->fetch();
        $totaluser=$resultuser['totaluser'];
	/*Pour compter le nombre de communes*/


if(isset($_POST['nomcommunes']) and !empty($_POST['nomcommunes'])){
	$nomcommunes = htmlspecialchars(trim($_POST['nomcommunes']));
	$dep_id = (int)htmlspecialchars(trim($_POST['dep_id']));
	
	$enre_niveau = "INSERT INTO communes (nomcommunes,dep_id) VALUES (:nomcommunes,:dep_id)";

	$param = array(
		'nomcommunes'=>$nomcommunes,
		'dep_id'=>$dep_id
	
		);

	try{
		$req = $dbh->prepare($enre_niveau);
		$req->execute($param);
		$msg="Enregistrement effectué avec succès";
		$typemsg = "msg-success";
	} catch(PDOException $e){
        $msg="Echec de l'enregistrement : ".$e->getMessage();
		$typemsg = "msg-error";
	}
}

	
 ?>