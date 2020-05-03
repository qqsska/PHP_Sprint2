<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Projektu Valdymas</title>
</head>
<body>
<?php require_once 'process.php'; ?>

<?php if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?= $_SESSION['msg_type']?>">
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
</div>
<?php endif ?>
<div class="container">
    <?php
         $mysqli = new mysqli('localhost', 'root', 'mysql', 'crud') or die(mysqli_error($mysqli));
         $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?> 

    <div class= "row justify-content-center"> 
         <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Project</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <?php
                 while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['project']; ?></td>
                           <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>"
                                    class="btn btn-info">Taisyti</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>"
                                    class="btn btn-danger">Istrinti</a>
                            </td>
                </tr>
            <?php endwhile; ?>
         </table>
    </div>

    <div class= "row justify-content-center">
         <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Dalyvio Vardas</label>
                <input type="text" name="name" class="form-control"
                value="<?php echo $name; ?>" placeholder="Irasykite varda">
            </div>
            <div class="form-group">
                <label>Projektas</label>
                <input type="text" name="project" class="form-control" 
                value="<?php echo $project; ?>" placeholder="project">
            </div>
            <div class="form-group">
                <?php 
                if ($update == true):
                    ?>
                    <button type="submit" class="btn btn-info" name="update">Atnaujinti</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Irasyti</button>
                <?php endif; ?>
            </div>

         </form>
    </div>
    
</div>

</body>
</html>  
