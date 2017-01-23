<?php
Class ChangeString
{
public function build($Cadenax)
	{
		$cadena="";
	$cadena2="";
	$ban=0;
	
    $longitud=strlen($Cadenax);
	//echo $longitud;
	
	 for($i=0; $i < $longitud; $i++) {  
	 $texto= substr($Cadenax,$i,1);
	// echo "<script>alert('$valor')</script>";
	$valor=STRTOUPPER($texto);

	//  COMPRARA ABECEDARIO
	  for($x=65; $x<=90; $x++) {
		   $letra = chr($x);
		   
		 if($valor==$letra){
			 $ban=1;		
			$n=$x+1;
			if($n==91){
				$n=65;
			}
			$resp=chr($n);
			$cadena=$cadena.$resp;
			//echo STRTOLOWER($resp);
	      break;
		 }
		 else{ $ban=0;}
		 
		
		 
	}
	// FIN ABECEDARIO
	
	
	
} 


		
	return $cadena;

	
       
	}
}
?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Change Ejemplo</title>
		
		<link href='style1.css' rel='stylesheet' type='text/css' >	
		
	</head>
	<body>
	
		<h1 align="center">Ejemplo ChangeString</h1>
	
	<form name="form1" method="get" action="change">
	<center><table width="50%">
	<tr>
	<td>
	Ingrese Letras :</td><td> <input type="text" name="letra" id="letra"></td><td> <input type="submit" value="Result"></td>
	</form>
	</table></center>
	<br><br>
		
	</body>
</html>


<?php 
  

if (isset($_REQUEST['letra']) ) {
	
	 $nombre = $_GET['letra'];
	 
$objeto= new ChangeString();
 $result = $objeto->build($nombre);
 
 
	echo "<br>"; 
	echo "<center><b>Resultado:".$result."</b></center><br>";  
	
echo "<center><a href=./>Regrese al Menu</a></center>";
}
      
?>


