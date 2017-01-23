<?php
Class ClearPar
{
public function build($cadena)
	{
			 
$acum="";
$longitud=strlen($cadena);

$x=0;

echo "<center>Resultado</center>";	
for($i=0; $i<$longitud;$i++) 
{ 
if($x<=$longitud-2){
$par1= substr($cadena,$x,1);
$par2= substr($cadena,$x+1,1);
if($par1=="(" and $par2==")"){
	
	//echo "<center>()</center>". "<br>";
	$acum=$acum."()";
	$x=$x+2;
}
else{$x=$x+1;}
}
}
	return $acum;

	
       
	}
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
	
	<form name="form1" method="get" action="clear">
	<center><table width="50%">
	<tr>
	<td>
	Ingrese Parentesis:</td><td> <input type="text" name="valor" id="valor"></td><td> <input type="submit" value="Result"></td>
	</form>
	</table></center>
	<br><br>
		
	</body>
</html>


<?php 
//STRTOLOWER Y STRTOUPPER

if (isset($_REQUEST['valor']) ) {

	 $cadena= $_GET['valor'];
	 
	  $objeto= new ClearPar();
 $result = $objeto->build($cadena);
echo "<center>".$result."</center><br>";

}
echo "<br><br>";
echo "<center><a href=./>Regrese al Menu</a></center>";
      
?>


