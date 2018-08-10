<?php
require_once("security.php");
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ong_deguesime";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
