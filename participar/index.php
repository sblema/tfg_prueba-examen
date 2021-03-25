<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

    <title>plantilla encuesta</title>
<!--
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
prueba1
-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
    			rel="stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<style>
.show-text {
    background: none repeat scroll 0 0 #869CA8;
    color: #ffffff !important;
    font-family: Arial !important;
    font-size: 21 !important;
    border-radius: 5px 5px 5px 5px;
    font-size: 21px;
    line-height: 1.4em;
    margin-bottom: 10px;
    min-height: 25px;
    padding: 14px 22px;
    color: #FFFFFF;
}
.recuadro{
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    border-radius: 5px 5px 5px 5px;
    color: #808080;
    cursor: pointer;
    font-size: 18px;
    line-height: 1.5em;
    min-height: 45px;
    padding: 6px 6px 6px 6px;
}
 .recuadro:hover, .recuadro:active, .recuadro:focus{
    background: #b0c2d0;
    color:#fff;
}
.recuadro img{
   max-width: 100% ;
}
</style>
<script>
	<?php echo 'var idcuestionario='.$_GET["id"].';';?>
    function introduce_usuario(){
    	//sessionStorage.removeItem("jsonData");
    	sessionStorage.removeItem("idcuestionario");
    	sessionStorage.removeItem("usuario");
    	var nombreUsuario =document.getElementsByName("nombreId")[0].value;
		var usuario =sessionStorage.getItem("usuario");
		
		var idcuestionario =sessionStorage.getItem("idcuestionario");
        //alert('Contexta: ' + nombreUsuario);  
        // Cargamos las respuestas que llevamos contestadas

		if (usuario==null){
			var arrayId = new Array();
		}else{
			var arrayId = new Array(usuario);
		}
		//arrayId.push('{nombre:' + nombreUsuario.toString()+'}');
		arrayId.push(nombreUsuario.toString());
		<?php 
		echo 'arrayId.push('.$_GET["id"].');';
		?>
		console.log(arrayId);
		usuario=arrayId; 

		sessionStorage.setItem("usuario", usuario); //Grabamos en el localStorage las respuestas
        location.href = 'prueba.php?id='+<?php  echo $_GET["id"] ?> + '&idUser=' + nombreUsuario.toString(); 		
      }
</script>
</head>
<body>
	<section>
<?php
$sql="Select * from cuestionarios WHERE id=".$_GET["id"] ." and tipo='1';";
//echo $sql;
$resultado=mysqli_query($mysqli, $sql);

//if (isset($resultado)) { //ver si es vacio el resultado
$row = mysqli_fetch_array(mysqli_query($mysqli, $sql),MYSQLI_ASSOC);

if(isset($row)){  
?>

	<div class="row" style="background: #2e3e4a;padding:5px;text-alig:center;">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <img src="img/logo.png"  
					style="width: 30%;float: right;" 
					class="img-responsive center-block" />
		</div>
	</div>

    <div class="row" style="background:#fff;/*padding:25px;*/text-alig:center;height:auto;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 show-text" id="nombre-elemento"><i class="icon_profile"></i>
            <input type="text" placeholder="Usuario" name="nombreId">  
			<!--   href="enprueba.html"  -->
			<a data-placement="top"  onclick='introduce_usuario();' href="#" data-toggle="tooltip" class="btn btn-warning">
                 OK</a>

        </div>
    </div>

<?php 
}else{
	echo '<img src="img/cerrado.png" class="img-fluid rounded d-block m-l-none img-responsive center-block">';
}
?>
</section>
</body>
</html>

