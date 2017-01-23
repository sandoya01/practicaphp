<?php
Class CompleteRange
{
	
	
	
	
public function build($valores)
	{

	
	$ban=1;
$num="";

$separador = ","; 

$array = split($separador,$valores); 

$cant_elem = count($array);  
if($cant_elem >1 ){
for($x=0; $x<$cant_elem ;$x++) 
{
if($x<$cant_elem-1){
	
$numero=$array[$x];
$numero2=$array[$x+1];

		if($numero>$numero2){
				echo "Error, ingrese de forma ascendente<br>";
				$ban=0;
				break;
						}
	
				}

else{
	$a=$array[$x-1];
$b=$array[$x];
//echo $b;
if($b<$a){
	echo "Error, ingrese de forma ascendente<br>";
	$ban=0;
	break;
}

	
}

	
	
}	
//echo $ban;
if($ban==1){
$range1= $array[0];
$range2=$array[$cant_elem-1 ];
echo "Resultado::";	
for($i=$range1; $i<=$range2;$i++) 
{ 
$num=$num.','.$i; 
}
//echo $num;
}
	return $num;

	
       
	}
} // mas de 1
	
	
}
?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Complete Ejemplo</title>
		
		<link href='style1.css' rel='stylesheet' type='text/css' >
		
	</head>
	<body>
	
		<h1 align="center">Ejemplo Complete</h1>
	<p align=center>Formato de Ingeso:1,5,4,10</p> 
	<form name="form1" method="get" action="complete">
	<center><table width="50%">
	<tr>
	<td>
	Ingrese Rango(solo numeros):</td><td> <input type="text" name="valor" value="<?php if (isset($_REQUEST['valor']) ) {echo $_REQUEST['valor']; }?>" id="valor" onKeyPress="if (event.keyCode < 48 || event.keyCode > 57  ){ event.returnValue = false; } if(event.keyCode==44 ){  event.returnValue = true ; } " ></td>
	<td> <input type="submit" value="Result"></td>
	</form>
	</table></center>
	
	<br><br>
		
	</body>
</html>


<?php 
//STRTOLOWER Y STRTOUPPER

if (isset($_REQUEST['valor']) ) {
	//build('ola');
 $valores= $_GET['valor'];
 
 
 $objeto= new CompleteRange();
 $result = $objeto->build($valores);
 echo $result;



echo "<br><br>";
echo "<center><a href=./>Regrese al Menu</a></center>";
	
}
      
?>


