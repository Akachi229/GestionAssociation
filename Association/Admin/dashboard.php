<?php
require_once("security.php");
?>
<?php

require_once("config/connexion.php");
$mc="";
$size=5;
/*gérer la pargination*/

if (isset($_GET['page']) and $_GET['page']>=0 ) {
    $page=$_GET['page'];
}
else{
    $page=0;
}
$offset=$size*$page;


/*Pour faire la recherche par nom*/
if (isset($_GET['motcle'])!="") {
   $mc=$_GET['motcle'];
   $req="SELECT DISTINCT * 
         FROM membres,communes,postes 
          WHERE membres.communes_id=communes.idcommunes AND postes.idpostes=membres.postes_id
          AND nommembres LIKE '%$mc%'  
         ORDER BY nommembres ASC ";
}else {
    $req="SELECT DISTINCT * 
          FROM membres,communes,postes 
          WHERE membres.communes_id=communes.idcommunes AND postes.idpostes=membres.postes_id
         ORDER BY nommembres ASC LIMIT $size OFFSET $offset
          ";

}

$ps=$dbh->prepare($req);
$ps->execute();


if(isset($_GET['motcle']))

            $ps2=$dbh->prepare("SELECT COUNT(*) AS Nb_mbr  FROM membres WHERE nommembres LIKE '%$mc%'  ");
            else 
                $ps2=$dbh->prepare("SELECT COUNT(*) AS Nb_mbr  FROM membres ");

$ps2->execute();
$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
$NBM=$ligne['Nb_mbr'];
if (($NBM % $size)==0) $Nb_Page=floor($NBM/$size);
else $Nb_Page=floor($NBM/$size)+1;

/*pour afficher le nombre de membres*/
    $reqdon=$dbh->query("SELECT COUNT(*) as total FROM membres");
    $resultdon=$reqdon->fetch();
    $total=$resultdon['total'];

    $reqdon=$dbh->query("SELECT COUNT(*) as totaldon FROM don");
    $resultdon=$reqdon->fetch();
    $totaldon=$resultdon['totaldon'];
    /*========================================================*/
    /*Pour compter le nombre de communes*/
    $reqcommunes=$dbh->query("SELECT COUNT(*) as totalcommunes FROM communes");
    $resultcommunes=$reqcommunes->fetch();
    $totalcommunes=$resultcommunes['totalcommunes'];
    /*Fin de la requete Pour compter le nombre de communes*/

        /*Pour compter le nombre d'utilisateur*/
        $requser=$dbh->query("SELECT COUNT(*) as totaluser FROM utilisateurs");
        $resultuser=$requser->fetch();
        $totaluser=$resultuser['totaluser'];
        /*Fin de la requete Pour compter le nombre d'utilisateur*/

   
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
                    ASSOCIATION DOGUESIMI
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
                    <a href="saisiedon.php">
                        <i class="ti-calendar"></i>
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
                    

                      <div class="row">
                    <div class="col-md-12 col-xs-7">
                                        <div class="content table-responsive table-full-width">
                                            <form method="get" action="dashboard.php">

                                                <div class="form-group">
                                                    <a class="navbar-brand" href="#">Panneau D'Aministration</a><br>
                                                    <input placeholder="Rechercher par nom" type="text" name="motcle" style="border-radius: 5px;" value="<?php echo ($mc) ?>">
                                                    <button type="submit">Rechercher</button>
                                                </div>
                                                
                                            </form>

                                        </div>
                                    </div>
                                </div>
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
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p style="font-size: 18px;">Membres</p>
                                            <?php echo $total; ?>
                                            
                                      </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Total des membres
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-gift"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p style="font-size: 18px;">Dons</p>
                                            <?php echo $totaldon; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i> Total de don
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-link"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p style="font-size: 18px;">Coordinations</p>
                                            <?php echo $totalcommunes; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> Coordination par commune
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-eye"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p style="font-size: 18px;">Adhérents</p>
                                            <?php echo $totaluser;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Total des Adhérents
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                                
      
        </div>
        <div class="content">
            <div class="container-fluid">
              
                    <div class="col-md-12">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th style="font-weight: bold;">N°</th>
                                        <th style="font-weight: bold;">Nom</th>
                                        <th style="font-weight: bold;">Prénom</th>
                                        <th style="font-weight: bold;">Téléphone</th>
                                        <th style="font-weight: bold;width: 20%;">Poste Occupé</th>
                                        <th style="font-weight: bold;width: 30%;">Date d'Adhésion</th>
                                        <th style="font-weight: bold;">Coordination</th>
                                        <th style="font-weight: bold;">Photo</th>
                                        <th style="font-weight: bold; width: 10%;">Action</th>
                                    </thead>

                                    <tbody>
                                         <?php 
                                         $i=0;
                                while ($af=$ps->fetch()) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $af['nommembres'] ?></td>
                                    <td><?php echo $af['prenommembres'] ?></td>
                                    <td><?php echo $af['telmembres'] ?></td>
                                    <td><?php echo ($af['libpostes']) ?></td>
                                    <td><?php echo $af['date'] ?></td>
                                    <td><?php echo $af['nomcommunes'] ?></td>
                                    <td><img src="uploads/<?php echo $af['photo'] ?>" width="100" height="100" alt="image" style="border-radius:50px;"></td>
                                   <td>
                                        <a  href="edit.php?id=<?php echo ($af['id']) ?>">
                                            <button type="submit" class="btn btn-info btn-fill btn-wd">Editer</button>
                                        </a>

                                       <br><br>

                                      <a onclick="return confirm('Êtes-vous sure de vouloir supprimer?')" href="Supprimemembre.php?id=<?php echo ($af['id']) ?>"><button type="submit" class="btn btn-info btn-danger btn-wd">Supprimer</button></a>
                                   </td>
                               
                              </tr>

                                 <?php    
                                }

                                 ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                                <ul class="pagination">
                                    <?php 
                                        for ($i=0; $i <$Nb_Page ; $i++) { ?>

                                          <li class="<?php echo(($i==$page)?"active" :"");?>">
                                              <a href="dashboard.php?page=<?php echo ($i); ?>">Page <?php echo $i; ?></a>
                                          </li>

                                        <?php 
                                           
                                        }
                                     ?>
                                  
                                </ul>
                            <div>
                                
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
                                ONG_DOGUESIMI
                            </a>
                        </li>
                        <li>
                            <a href="../../Association_Doguesime/index.php">
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
