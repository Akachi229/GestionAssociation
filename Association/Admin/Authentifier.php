

<?php
session_start();
$dbh=new PDO('mysql:host=localhost;dbname=ong_deguesime','root','');

    $motdepasse = md5($_POST['motdepasse']);
    $email = htmlspecialchars(trim($_POST['email']));

try{
    $req =$dbh->prepare("SELECT * FROM admin WHERE motdepasse =? and email =?") ;
    $param=array($motdepasse, $email);
    $req->execute($param);
    $msg="Enregistrement effectué avec succès";
    $typemsg = "msg-success";
} catch(PDOException $e){
    $msg="Echec de l'enregistrement : ".$e->getMessage();
    $typemsg = "msg-error";
}

if($user=$req->fetch()){
    $_SESSION['PROFILE']=$user;
    header("location:dashboard.php");
}else{
    $erreur="Mauvais email ou mot de passe!";
}

?>
