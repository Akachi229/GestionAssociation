<?php

//delete.php

if(isset($_POST["id"]))
{
    $connect = new PDO('mysql:host=localhost;dbname=ong_deguesime', 'root', '');
    $query = "
 DELETE from events WHERE id=:id
 ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':id' => $_POST['id']
        )
    );
}

?>