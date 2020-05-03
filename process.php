<?php

session_start();
// prisijungti pre database
$mysqli = new mysqli('localhost', 'root', 'mysql', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$name = '';
$project = '';
$update = false;

// jei paspaustas mygtukas "Irsyti"
if (isset($_POST['save'])){
    $name = $_POST['name'];
    $project = $_POST['project'];
    
    $mysqli->query("INSERT INTO data (name, project) VALUES ('$name', '$project')") or die($mysqli->error);

    $_SESSION['message'] = "Duomenys sekmingai issaugoti";
    $_SESSION['msg_type'] = "success";

    header("location: index.php"); // sukuriamas sekmingo duomenu iraso panesimas puslapio virsuje 

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Duomenys istrinti";
    $_SESSION['msg_type'] = "demesio";//pranesimas headeryje apie istrintus duomenis
    
    header("location: index.php");
  }

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if (count($result)==1){ //PRADEJORODYTI ERRORA veikia, bet kazkuriuo momentu rodo klaida sioje eiluteje. Anksciau klaidos nerode
        $row = $result->fetch_array();
        $name = $row['name'];
        $project = $row['project'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $project = $_POST['project'];

    $mysqli->query("UPDATE data SET name='$name', project='$project'WHERE id=$id")  or die($mysqli->error);

    $_SESSION['message'] = "Duomenys sekmingai atnaujinti"; 
    $_SESSION['msg_type'] = "success";

    header("location: index.php"); // sukuriamas sekmingo duomenu iraso panesimas puslapio virsuje 
  
}

?>