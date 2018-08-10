<?php
require_once("security.php");
?>

<?php 
	
require_once("config/connexion.php");

$id=$_GET['id'];
$up=$dbh->prepare("SELECT * FROM membres,communes,postes WHERE membres.communes_id=communes.idcommunes AND postes.idpostes=membres.postes_id AND id = ?");
$param=array($id);

$up->execute($param);
$af=$up->fetch();
 ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Paper Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.php" class="simple-text">
                    <img src="images/logo.png" style="width: 50px;height: 50px;">
                    ASSOCIATION DOGUESIME
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>tableau de Bord</p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="ti-user"></i>
                        <p>Saisie membres</p>
                    </a>
                </li>
                <li>
                    <a href="table.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="saisiedon.php">
                        <i class="ti-user"></i>
                        <p>Saisie Don</p>
                    </a>
                </li>
                <li>
                    <a href="listesdon.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Listes des dons</p>
                    </a>
                </li>
                <li>
                    <a href="saisiepostes.php">
                        <i class="ti-user"></i>
                        <p>Saisie Postes</p>
                    </a>
                </li>
                <li>
                    <a href="listespostes.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Listes des postes</p>
                    </a>
                </li>
                 <li>
                    <a href="utilisateurs.php">
                        <i class="ti-user"></i>
                        <p>Listes des utilisateurs</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php">Panneau D'Aministration</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="LogOut.php">
                                <i class="ti-back-left"></i>
                                <p>Déconnexion</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                  
                    <div class="col-lg-10 col-md-7">
                        <div class="card">
                            <div class="header" style="text-align: center;">
                                <h2 style="font-weight: bold;" class="title">Ajouter un Adhérent</h2>
                            </div>

                                                                        <?php
                                                if(isset($errorMsg)){       
                                            ?>
                                                <div class="alert alert-danger">
                                                    <span class="glyphicon glyphicon-info">
                                                        <strong><?php echo $errorMsg; ?></strong>
                                                    </span>
                                                </div>
                                            <?php
                                                }
                                            ?>

                                            <?php
                                                if(isset($successMsg)){     
                                            ?>
                                                <div class="alert alert-success">
                                                    <span class="glyphicon glyphicon-info">
                                                        <strong><?php echo $successMsg; ?> - redirecting</strong>
                                                    </span>
                                                </div>
                                            <?php
                                                }
                                            ?>
                            <div class="content">

                                <form method="post" action="updatemembre.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom</label>
                                                <input type="text" class="form-control border-input" placeholder="Company" name="nommembres" value="<?php echo ($af['nommembres']) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Prénom</label>
                                                <input type="text" class="form-control border-input" placeholder="Username" name="prenommembres" value="<?php echo ($af['prenommembres']) ?>">
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Téléphone</label>
                                                <input type="number" class="form-control border-input" placeholder="Téléphone" name="telmembres" value="<?php echo ($af['telmembres']) ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Profession</label>
                                                <input type="text" class="form-control border-input" placeholder="Profession" name="professionmembres" value="<?php echo ($af['professionmembres']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date de naissance</label>
                                                <input type="date" class="form-control border-input" placeholder="Date de naissance" name="datenaissance" value="<?php echo ($af['datenaissance']) ?>">
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-6" >
                                            <div class="form-group">
                                                <label>Date d'adhésion</label>
                                                <input type="date" class="form-control border-input" name="date" value="<?php echo ($af['date']) ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Situation Matrimoniale</label>
                                                <input type="text" class="form-control border-input" placeholder="Situation Matrimoniale" name="situationmatrimoniale" value="<?php echo ($af['situationmatrimoniale']) ?>">
                                            </div>
                                        </div>
                                       
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Addresse Email </label>
                                                <input type="email" class="form-control border-input" placeholder="Adresse Email" name="emailmembres" value="<?php echo ($af['emailmembres']) ?>">
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sexe</label>
                                                <select name="sexe" class="form-control border-input">
                                                    <option>Homme</option>
                                                    <option>Femme</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4" style="margin-left: 30px;">
                                            <div class="form-group">
                                                <label>Poste occupé</label>
                                                <select class="form-control border-input" name="postes_id">
                                                                                     <?php

                                                                if($dbh){
                                                                    $don=$dbh->query('select idpostes,libpostes from postes order by libpostes asc');
                                                                    while($k=$don->fetchObject()){
                                                                        echo "<option value=\"$k->idpostes\">$k->libpostes </option>";

                                                                    }
                                                                }
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Coordination/Communes</label>
                                                <select class="form-control border-input" name="communes_id" id="nomcommunes">
                                                                                                <?php

                                                                if($dbh){
                                                                    $don=$dbh->query('select idcommunes,nomcommunes from Communes order by nomcommunes asc');
                                                                    while($k=$don->fetchObject()){
                                                                        echo "<option value=\"$k->idcommunes\">$k->nomcommunes </option>";

                                                                    }
                                                                }
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Zone de résidence</label>
                                                <input type="text" class="form-control border-input" placeholder="Zone de résidence" name="zoneresidence" value="<?php echo ($af['zoneresidence']) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="col-md-2">Photo</label>
                                            <div class="col-md-10">
                                                <input type="file" name="myfile" > <br>
                                                <img src="uploads/<?php echo $af['photo'] ?>" width="100" height="100" alt="image" style="border-radius:50px;">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control border-input" name="id" value="<?php echo $id; ?>">
                                            </div>
                                        </div>
                                            <br>
                                    <div class="text-center">
                                        <button type="submit" name="btnSave"  class="btn btn-info btn-fill btn-wd">Modifier</button>
                                        <button type="reset" class="btn btn-info btn-fill btn-wd">Annuler</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="dashboard.php">
                                ASSOCIATION DOGUESIME
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Revenir sur le site
                            </a>
                        </li>
                       
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, Réalisé<i class="fa fa-heart heart"></i> par <a href="http://www.creative-tim.com">Quatri-Dev</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>
     <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'ti-desktop',
                message: "Bienvenu dans le <b>Panneau d'administration</b> - Réalisé par Quatri-Dev"

            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>

</html>
