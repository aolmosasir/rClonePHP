<?php

function recuperarBackups($file){
    $comandoRec = 'sudo rclone copy servidor:/home/alejandro/backups/'.$file.' /var/www/html/testing';
    $recuperar = exec($comandoRec, $salida, $return);
    if ($return != 0) {
        return false;
    }else {
        return true;
    }

}

function eliminarBackup($file){
    $comandoElim = 'sudo rclone purge servidor:/home/alejandro/backups/'.$file;
    $eliminar = exec($comandoElim, $salida, $return);
    if ($return != 0) {
        return false;
    }else {
        return true;
    }
}

if ($_GET['method'] == "recuperar") {
    $recuperar = recuperarBackups($_GET['file']);
    if ($recuperar == true) {
        echo'<script type="text/javascript">
        alert("Backup cargado con exito");
        window.location="testingbackup.php";
        </script>';
    }else {
        echo'<script type="text/javascript">
        alert("El backup no ha podido ser cargado");
        window.location="testingbackup.php";
        </script>';
    }
}else if ($_GET['method'] == "eliminar") {
    $eliminar = eliminarBackup($_GET['file']);
    if ($eliminar == true) {
        echo'<script type="text/javascript">
        alert("Backup eliminado con exito");
        window.location="testingbackup.php";
        </script>';
    }else {
        echo'<script type="text/javascript">
        alert("El backup no ha podido ser eliminado");
        window.location="testingbackup.php";
        </script>';
    }

}else {

    $fecha = date('d-m-Y-h:i:s');
    $user = "alejandro";
    
    $comando = 'sudo rclone copy /var/www/html/ servidor:/home/alejandro/backups/'.$user.'-'.$fecha;
    
    $backup = exec($comando, $salida, $return);
    
    if ($return != 0) {
        echo'<script type="text/javascript">
        alert("El backup no se ha podido completar");
        window.location="testingbackup.php";
        </script>';
    }else {
        echo'<script type="text/javascript">
        alert("El backup se ha realizado correctamente");
        window.location="testingbackup.php";
        </script>';
    }
}


?>