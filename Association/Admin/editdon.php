<?php
require_once("security.php");
?>
<?php

require_once("config/connexion.php");

$iddon=$_GET['iddon'];
$up=$dbh->prepare("SELECT * FROM don,communes WHERE communes.idcommunes=don.com_id ");
$param=array($iddon);
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

    
    <title>Association Doguessimi</title>

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
                <li >
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

                <li class="active">
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
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Panneau d'administration</a>
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
                                <h2 class="title" style="font-weight: bold;">Modification d'un Don</h2>
                            </div>
                            <p style="color: green;">
                                <?php if(isset($msg)){echo $msg;}?>
                            </p>

                            <div class="content" >

                                <form method="post" action="updatedon.php" enctype="multipart/form-data">
                                    <div class="row" style="margin-left: 50px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type de Don</label>
                                                <input type="text" value="<?php echo ($af['nomdon']) ?>" required="" class="form-control border-input" placeholder="Entrer le type de don" name="nomdon">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" style="margin-left: 50px;">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description du Don</label>
                                                <input type="text" required="" value="<?php echo ($af['descdon']) ?>" class="form-control border-input" placeholder="Description du Don" name="descdon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left: 50px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date de donnation</label>
                                                <input type="date" required="" value="<?php echo ($af['datedon']) ?>" class="form-control border-input" name="datedon">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-left: 50px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Coordination/Communes</label>
                                                <select required="" class="form-control border-input" name="com_id" id="com_id">
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control border-input" name="iddon" value="<?php echo $iddon; ?>">
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="text-center">
                                            <button  type="submit" name="submit"  class="btn btn-info btn-fill btn-wd">
                                                Modifier
                                            </button>
                                            <button  type="reset" class="btn btn-info btn-fill btn-wd">
                                                Annuler
                                            </button>
                                        </div>
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
                                ONG_DOGUESIME
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
