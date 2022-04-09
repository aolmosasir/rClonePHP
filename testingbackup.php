<?php

$getBackupsCommand = 'sudo rclone lsf servidor:/home/alejandro/backups/';
$backups = exec($getBackupsCommand, $salidas, $return);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Backups Testing Rclone</title>
</head>
<body>
    <div class="container">
        <form action="phpbackup.php" method="post">
            <input type="submit" class="btn btn-success m-3" value="Hacer backup">       
        </form>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Nombre del backup</th>
                    <th scope="col">Recuperar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($salidas) == 0): ?>
                    <tr><td colspan="3" style="text-align:center;">No hay ningun backup</td></tr>
            <?php else: ?>
                <?php foreach($salidas as $backupName): ?>
                    <tr>
                        <td><?php  echo $backupName; ?></th>
                        <td><a type="button" class="btn btn-primary" href="http://tester.alejandroasir.me/phpbackup.php?method=recuperar&file=<?php echo $backupName?>"> Recuperar backup </a></td>
                        <td><a type="button" class="btn btn-danger" href="http://tester.alejandroasir.me/phpbackup.php?method=eliminar&file=<?php echo $backupName?>"> Eliminar backup </a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

