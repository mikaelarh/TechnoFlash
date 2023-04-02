<?php
session_start(); 
include '../library/consulSQL.php';
$num=$_POST['clien-number'];
if($num=='notlog'){
   $nameClien=$_POST['clien-name'];
   $passClien=  md5($_POST['clien-pass']); 
}
if($num=='log'){
   $nameClien=$_POST['clien-name'];
   $passClien=$_POST['clien-pass']; 
}
sleep(3);
$sql="select * from cliente where Clave='".$passClien."' and Usuario='".$nameClien."'";
$verdata=  ejecutarSQL::consultar($sql);
$num=  mysqli_num_rows($verdata);
if($num>0){
  if($_SESSION['sumaTotal']>0){
  $data= mysqli_fetch_array($verdata);
  $nitC=$data['id_Cliente'];
  $StatusV="Pendiente";
  
  /*Insertando datos en tabla venta*/
  consultasSQL::InsertSQL("venta", "Fecha, NIT, Descuento, TotalPagar, Estado", "'".date('d-m-Y')."','".$nitC."','0','".$_SESSION['sumaTotal']."','".$StatusV."'");
  
  /*recuperando el número del pedido actual*/
  $sql2="select * from venta where NIT='$nitC' order by NumPedido desc limit 1";
  echo $sq2;
  $verId=ejecutarSQL::consultar($sql2);
  while($fila=mysqli_fetch_array($verId)){
     $Numpedido=$fila['NumPedido'];
  }
  
  /*Insertando datos en detalle de la venta*/
  for($i = 0;$i< $_SESSION['contador'];$i++){
      consultasSQL::InsertSQL("detalle", "NumPedido, CodigoProd, CantidadProductos", "'$Numpedido', '".$_SESSION['producto'][$i]."', '1'");
  }
    
    /*Vaciando el carrito*/
    unset($_SESSION['producto']);
    unset($_SESSION['contador']);
    
    echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito';
  }else{
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>No has seleccionado ningún producto, revisa el carrito de compras';
  }

}else{
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>El nombre o contraseña invalidos';
}
 


