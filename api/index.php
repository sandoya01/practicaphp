<?php


require "php-json-file-decode/json-file-decode.class.php";

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(['templates.path' => 'view']);
$app->contentType('text/html; charset=utf-8');


function creartabla(){
	echo "<table width='60%'  border='0' class='over_externo'>
          
                <tr class='barra_menu'>
				<td>NAME</td><td>EMAIL</td><td>POSITION</td><td>SALARY</td>
                  
               </tr>  ";
}

function llenartabla(){
	$leer = new json_file_decode();
$archivo=$leer->json("employees.json");
	
	for($x =0; $x < count($archivo["employees"]); $x++)
{ 
$nombre=$archivo["employees"][$x]["name"];
$email=$archivo["employees"][$x]["email"];
$position=$archivo["employees"][$x]["position"];
$salario=$archivo["employees"][$x]["salary"];
$telefono=$archivo["employees"][$x]["phone"];
$direccion=$archivo["employees"][$x]["address"];
$skill=$archivo["employees"][$x]["skills"];
$detalle= json_encode($skill);
//echo  $detalle."<br>";

echo "<tr >";
 echo "<td>".$nombre."</td><td>".$email."</td><td>".$position."</td><td>".$salario."</td>"; 
 
 echo "</tr>";
 }	

}



function retornar(){
	
	echo "<center><a href=./>Regrese al Menu</a></center>";
	
}





$app->get('/', function () {
	echo "<link href='style1.css' rel='stylesheet' type='text/css' >";
	
echo "<body>";	
echo "<h1 align=center>Bienvenido a slim</h1>";
echo "<dl class='accordion' style='width:170'>";
echo "<dt><b>EMPLEADO</b></dt>";
echo "<dd><a href=ver>Listar Empleados</a></dd>";
echo "<dd><a href=formatoxml>Rango de Salarios XML</a></dd>";
echo "<dt><b>EJERCICIOS</b></dt>";
echo "<dd><a href=change>ChangeString</a></dd>";
echo "<dd><a href=complete>CompleteRange</a></dd>";
echo "<dd><a href=clear>ClearPar</a></dd>";

echo "</dl>";

echo "</body>";	
});

$app->get('/ver', function() use($app){
	
	
	echo "<link href='style1.css' rel='stylesheet' type='text/css' >";
	
$leer = new json_file_decode();
$archivo=$leer->json("employees.json");
if(isset($_REQUEST['email'])){
	
	$dato=$_REQUEST['email'];
}
	else{
		$dato="";
}
echo  "<html><h1 align='center'>EMPLEADOS</h1></html>";
echo  " <div align='center'> 
	   <form name='form1' method='GET' action='ver'>
     Ingrese Email <input type='text' name='email' value=$dato >
	  <input  type='submit'  value='BUSCAR'>
	   </form>
      
	  </div>";
	
echo "<table width='60%'  border='0' align='center' class='over_externo' cellpadding='2' cellspacing='2'>
          
                <tr class='barra_menu'>
				<td><b>NAME</b></td><td><b>EMAIL</b></td><td><b>POSITION</b></td><td><b>SALARY</b></td><td><b>DETALLE</b></td>
                  
               </tr>  ";

		
	if ($dato=="")
{
	for($x =0; $x < count($archivo["employees"]); $x++)
{ 
$nombre=$archivo["employees"][$x]["name"];
$email=$archivo["employees"][$x]["email"];
$position=$archivo["employees"][$x]["position"];
$salario=$archivo["employees"][$x]["salary"];
$telefono=$archivo["employees"][$x]["phone"];
$direccion=$archivo["employees"][$x]["address"];
$skill=$archivo["employees"][$x]["skills"];
$detalle= json_encode($skill);
//echo  $detalle."<br>";

echo "<tr>";
 echo "<td>".$nombre."</td><td>".$email."</td><td>".$position."</td><td>".$salario."</td>";
 
 echo "<td><a target='_blank' href='detalle?name=$nombre&email=$email&position=$position&salary=$salario&phone=$telefono&address=$direccion&detalle=$detalle'><img src=editar.gif></a></td>";
 echo "</tr>";
 }

}
else{
	
	
		for($x =0; $x < count($archivo["employees"]); $x++)
{ 
if ($dato==$archivo["employees"][$x]["email"]){
$nombre=$archivo["employees"][$x]["name"];
$email=$archivo["employees"][$x]["email"];
$position=$archivo["employees"][$x]["position"];
$salario=$archivo["employees"][$x]["salary"];
$telefono=$archivo["employees"][$x]["phone"];
$direccion=$archivo["employees"][$x]["address"];
$skill=$archivo["employees"][$x]["skills"];
$detalle= json_encode($skill);

echo "<tr>";
 echo "<td>".$nombre."</td><td>".$email."</td><td>".$position."</td><td>".$salario."</td>";
 
 echo "<td><a target='_blank' href='detalle?name=$nombre&email=$email&position=$position&salary=$salario&phone=$telefono&address=$direccion&detalle=$detalle'><img src=editar.gif></a></td>";
 echo "</tr>";
 break;
 }
}
}
	
 echo "</table><br>";
 retornar();

});


$app->get('/detalle', function() use($app){

$app->render('detalle.php');
});

$app->get('/formatoxml', function() use($app){

echo "<link href='style1.css' rel='stylesheet' type='text/css' >";	 


if(isset($_REQUEST['rango1']) and  isset($_REQUEST['rango2'])){
	
	$rango1=$_REQUEST['rango1'];
	$rango2=$_REQUEST['rango2'];
	$ban=1;
}
	else{
		$rango1=0;
		$rango2=0;
		$ban=0;
		
}


echo  "<html><center><h1>RANGO DE SALARIOS</h1></center></html>";
echo  "<p align=center>Formato de Ingeso:1,500.00</p>"; 
echo  " <div align='center'> 
	   <form name='form1' method='GET' action='formatoxml'>
	   <table>
	   <tr>
	   <td>Salario Min.</td><td><input type='text' name='rango1' value=''></td>
	   <td>Salario Max.</td><td><input type='text' name='rango2' value=''></td>
	  <td><input  type='submit'  value='MOSTRAR'></td>
	  </tr>
	  <table>
	   </form>
      
	  </div>";
creartabla();

// CREAR XML
$leer = new json_file_decode();
$archivo=$leer->json("employees.json");


		  	if ($rango1==0 or $rango2==0)
{
	$mensaje="";
llenartabla();
echo "</table><br>";
retornar();
}

else{
	// Crear XML
	
	
	$mensaje="El archivo salario.xml ha sido Generado";
	$xml = new DomDocument('1.0', 'UTF-8');
 
    $planilla= $xml->createElement('planilla');
    $planilla = $xml->appendChild($planilla);
 
    $empleado = $xml->createElement('empleado');
    $empleado = $planilla->appendChild($empleado);

	 
    // Agregar un atributo
	$empleado->setAttribute('seccion', 'rangosalario');
	
	
	for($x =0; $x < count($archivo["employees"]); $x++)
{ 
$xsalario= substr($archivo["employees"][$x]["salary"],1);

if ($xsalario>=$rango1  and  $xsalario<=$rango2){
$nombre=$archivo["employees"][$x]["name"];
$email=$archivo["employees"][$x]["email"];
$position=$archivo["employees"][$x]["position"];
$salario=$archivo["employees"][$x]["salary"];
$telefono=$archivo["employees"][$x]["phone"];
$direccion=$archivo["employees"][$x]["address"];
$skill=$archivo["employees"][$x]["skills"];
$detalle= json_encode($skill);
echo "<tr class='barra_menu'>";
 echo "<td>".$nombre."</td><td>".$email."</td><td>".$position."</td><td>".$salario."</td>";
 
 
 echo "</tr>";
 //break;
 
 // LLenar xml
 $nombre = $xml->createElement('nombre',$nombre);
    $nombre = $empleado->appendChild($nombre);
 
    $email= $xml->createElement('email',$email);
    $email = $empleado->appendChild($email);
 
    $position = $xml->createElement('posicion',$position);
    $position = $empleado->appendChild($position);
 
    $salario= $xml->createElement('salario',$salario);
    $salario= $empleado->appendChild($salario);
 
 
 }
}

 
   $xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('salario.xml');
//echo "	<script type='text/javascript' charset='utf-8'>ef = window.open('salario.xml', '_blank')</script>";

echo "<script type='text/javascript' charset='utf-8'>document.location ='salario.xml'</script>";

echo "</table>";
echo $mensaje;
}

 
   });
   $app->get('/change', function() use($app){
	   $app->render('ChangeString.php');
	});   

	$app->get('/complete', function() use($app){
	   $app->render('CompleteRange.php');
	});   
	$app->get('/clear', function() use($app){
	   $app->render('ClearPar.php');
	});   
	
	
$app->run();

?>



