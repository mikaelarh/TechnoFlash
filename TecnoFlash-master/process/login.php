<?php
    session_start();
    include '../library/consulSQL.php';
    sleep(2);
    $nombre=$_POST['nombre-login'];
    $clave=md5($_POST['clave-login']);
    $radio=$_POST['optionsRadios'];
    if(!$nombre==""&&!$clave==""){
        
        
        if($radio=="option2"){
            $sql="select * from administrador where Nombre='$nombre' and Clave='$clave'";
            echo $sql;
            $verAdmin=ejecutarSQL::consultar($sql);
            $AdminC=mysqli_num_rows($verAdmin);
            if($AdminC>0){
                $_SESSION['nombreAdmin']=$nombre;
                $_SESSION['claveAdmin']=$clave;
                echo '<script> location.href="index.php"; </script>';
            }else{
              echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido'; 
            }
        }
        if($radio=="option1"){
            $verUser=ejecutarSQL::consultar("select * from cliente where Usuario='$nombre' and Clave='$clave'");
            $UserC=mysqli_num_rows($verUser);
            $vars=mysqli_fetch_array($verUser);
            if($UserC>0){
                $_SESSION['nombreUser']=$nombre;
                $_SESSION['claveUser']=$clave;
                $_SESSION['Direccion']=$vars['Direccion'];
                echo '<script> location.href="index.php"; </script>';
            }else{
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido';
            }
        }

    }else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacio<br>Intente nuevamente';
    }