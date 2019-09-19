<?php require_once("../../php/valida.php"); ?>
<!--Llamamos la a valida el cual contiene la informacion del usuario que a abierto sesión-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Administrador | Medical Social</title>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.min.css"/>
  <script type="text/javascript" src="../../js/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../js/scripts.js"></script>
       <style type="text/css">
    .aburtlist{
      margin-bottom: 12px;
    }
    .listAbout{
        color:  #676563;
    }

      </style>
</head>

<body>

<?php
//Llamamos al archivo conexion para tener acceso a la base de datos
include("../../clase/conectar.php");

$nickname = $_SESSION["nickname"];
$sentencia = $conn->query("SELECT * FROM admin where nickname='$nickname'");
$row=$sentencia->fetch(PDO::FETCH_ASSOC)
?>

<div class="container" id="contenedor">

<!--INICIO DEL BANNER-->
<div class="row-fluid" ><!--contenido-->
<div class="well" > <!-- SPAN WELL -->
<center><img src="../../imagen/Banner.png" alt="Banner" height="100%"></center>
<center><h2>Bienvenido(a): <?php echo $row['nombre']." ".$row['apellido']; ?></h2></center>
</div><!--CIERRE DEL ROW DEL FORM-->
</div><!--CIERRE DEL SPAN WELL-->
<!--FIN DEL BANNER-->

<!--INICIO DE MENU-->
<center><?php  require_once("../../php/menu_admin.php"); ?></center><br>
<!--FIN DE MENU-->

<div class="row-fluid"><!--contenido-->
<div class="well" > <!-- SPAN WELL -->

        <div><h3>Edita tus Datos:</h5></div>
        <div>

        <table>
        <form method="post">

            <tr>
            <td id="alinear">DUI:</td>
            <td><input type="text" maxlength="9" required name="dui" id="dui" value="<?php echo $row['dui']; ?>" /></td>
            </tr>

            <tr>
            <td  id="alinear">Nombres:</td>
            <td><input type="text" required name="nombre" id="nombre" value="<?php echo $row['nombre']; ?>" /></td>
            </tr>

            <tr>
            <td  id="alinear">Apellidos:</td>
            <td><input type="text" required name="apellido" id="apellido" value="<?php echo $row['apellido']; ?>" /></td>
            </tr>

            <tr>
            <td  id="alinear">Contraseña:</td>
            <td><input type="text" required name="password" id="password" value="<?php echo $row['password']; ?>" /></td>
            </tr>

            <tr>
            <td  id="alinear">Nombre de Usuario:</td>
            <td><input type="text" required name="nickname" id="nickname" value="<?php echo $row['nickname']; ?>" /></td>
            </tr>

            <tr>
            <td colspan="2"><button type="submit" name="boton" class="btn-success">Actualizar</button></td>
            </tr>

        </form>
      </table>
<?php

//Variables las cuales serán llenadas con los datos del formulario
$sql="";
$dui="";
$nombre="";
$apellido="";
$nickname="";

//Inicio del boton del formulario
 if(isset($_POST["boton"])==true)
  {
    $dui_S = $row['dui'];
    $dui = $_POST["dui"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $nickname = $_POST["nickname"];
   
    //Sentencia SQL que se ejecuta, se agregan los campos del formulario a los campos de la tabla de la base de datos
     $stmt = $conn->prepare('UPDATE admin SET dui= ?, nombre= ?, apellido= ?, nickname= ? WHERE dui= ?');

    $stmt->bindParam(1, $dui);
    $stmt->bindParam(2, $nombre);
    $stmt->bindParam(3, $apellido);
    $stmt->bindParam(4, $nickname);
    $stmt->bindParam(5, $dui_S);

    $stmt->execute();
    $_SESSION["nickname"]= $nickname;

    ?>
    <script language="javascript">
    alert("Actualizado Correctamente"); 
    location.href='informacion.php';
    </script>
    <?php
}
?>

        

</div>
</div>
<!--INICIO DE PIE-->
<div class="row-fluid" ><!--contenido-->
<div class="well" > <!-- SPAN WELL -->
<center><?php  include("../../php/pie.php");?></center>
</div><!--CIERRE DEL ROW DEL FORM-->
</div><!--CIERRE DEL SPAN WELL-->
<!--FIN DE PIE-->
</div>
</body>
</html>