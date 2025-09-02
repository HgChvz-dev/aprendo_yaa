<?php
// include phpmailer class
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$envio = 0;
$request = file_get_contents('php://input');
$datos = json_decode($request);

if ($datos->event == "PURCHASE_APPROVED" && $datos->data->purchase->status == "APPROVED") {
        // requerimos los archjivos .php
	require("PHPMailer/PHPMailer.php");
	require("PHPMailer/SMTP.php");
	require("PHPMailer/Exception.php");

	$iproducto = $datos->data->product->id;
	$nombre = $datos->data->buyer->name;
	$email = $datos->data->buyer->email;
	$codigo = "1";
	$fecha = "'".date('Y-m-d')."'";
	$pais = "'".$datos->data->purchase->checkout_country->name."'";
	$sigla = "'".$datos->data->purchase->checkout_country->iso."'";
	$estado = "'Activo'";
	$dateHora = "'".date('Y-m-d H:i:s')."'";

	// ************************************************************** //
	// * PARA EL ALMACENAMIENTO EN LA DB                            * //
	// ************************************************************** //
	$servername = "localhost";
	$dbname = "u443300861_datavidhd";
	$username = "u443300861_datavidhdRoot";
	$password = "h7C~t5foiRC!";
	$clave = "\$2y\$10\$elL9Q8K1xbYOopcZMBa0L.lD9Yvrvy7QGJ.pFpzQBYIQSs/R.nOx.";
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    $sql = "SELECT * FROM users WHERE email = '".$email."'"; 
	    $query = $conn->prepare($sql); 
	    $query -> execute(); 
	    $results = $query->fetchAll(PDO::FETCH_OBJ); 
	    
	    if($query->rowCount()>0) { 
	        foreach($results as $result){
	            $curso = $result->id_curso;
	            $newCurso = $curso."|".$iproducto;
	            $sql = "UPDATE users SET id_curso = '".$newCurso."' WHERE email = '".$email."'";
	            $stmt = $conn->prepare($sql);
	            $stmt->execute();
	            $envio = $stmt->rowCount();
		        if ($envio > 0) {
				$idUltimo = $result->id;
				$sql1 = "INSERT INTO t_alumnocurso(id_alumno,id_curso,id_creador,fecha_registro) VALUES ($idUltimo,1,1,$dateHora)";
				$stmt1 = $conn->prepare($sql1);
				$stmt1->execute();
		        }  
		    echo $sql1;          
	            echo $stmt->rowCount()." registros Actualizados en USERS";        
	            echo $stmt1->rowCount()." registros Actualizados en ALUMNOCURSO";        
	        }
	        $conn = null;
	    } else {
	        $sql = "INSERT INTO users(id_curso,name,email,codigo_alumno,fecreg_alumno,password,pais_alumno,siglapais_alumno,status,created_at) VALUES ('".$iproducto."','".$nombre."','".$email."','".$codigo."',$fecha,'".$clave."',$pais,$sigla,$estado,$dateHora)";
	        $stmt = $conn->prepare($sql);
	        $stmt = $stmt->execute();
	        $envio = $stmt->rowCount();
	        if ($envio > 0) {
			$idUltimo = $result->id;
			$sql2 = "INSERT INTO t_alumnocurso(id_alumno,id_curso,id_creador,fecha_registro) VALUES ($idUltimo,1,1,$dateHora)";
			$stmt2 = $conn->prepare($sql2);
			$stmt2->execute();
	        }  
		echo $sql2;          
		echo $stmt->rowCount()." registros Insertado en USERS";        
		echo $stmt2->rowCount()." registros Insertado en ALUMNOCURSO";        

	        $conn = null;    
	    }
	} catch(PDOException $e) {
	  echo $sql . "<br>" . $e->getMessage();
	  echo $sql;
	}

	echo $envio;
	echo $sql;
	$conn = null;

	// ************************************************************** //
	// * PARA EL ENVIO DE CORREO                                    * //
	// ************************************************************** //
	if ($envio > 0) {
		$mensaje = "<!DOCTYPE html>
			<html lang='es'>
			<head>
				<meta charset='UTF-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
				<title>.:: Registro de Afiliación ::.</title>
				<style>
					.cuerpo
					{
						margin: 0;
						padding: 0;
						width: 100%;
						align-items: center;
					}
					.recuadro
					{
						margin: 0 auto;
						padding: 50px 50px;
						border: 1px dotted silver;
						width: 50%;-webkit-box-shadow: 4px 5px 5px 0px rgba(122,113,122,1);
						-moz-box-shadow: 4px 5px 5px 0px rgba(122,113,122,1);
						box-shadow: 4px 5px 5px 0px rgba(122,113,122,1);
					}
					.p-t{
						text-align: left;
						font-size: 1.5em;
						font-weight: bold;
						font-style: italic;
						font-family: 'Latin Modern Roman';
			  		}
					.p-l{
						text-align: left;
						font-size: 1em;
						font-weight: bold;
						font-style: italic;
						font-family: 'Latin Modern Roman';
			  		}
			  		.p-c{
						text-align: center;
						font-size: 1em;
						font-weight: bold;
						/* font-style: italic; */
						font-family: 'Latin Modern Roman';
			  		}
			  		.p-r{
						text-align: right;
						font-size: 1em;
						font-weight: bold;
						font-style: italic;
						font-family: 'Latin Modern Roman';
			  		}
				</style>
			</head>
			<body>
			<div class='cuerpo'>
				<div class='recuadro'>
					<p class='p-t' h3>Registro de afiliación al curso</p>
					<p class='p-l'>Estimad@ ".$nombre.", bien venid@ al curso <b>LA BASE DE LOS RECOGIDOS<b> tu usuario y contraseña para tu ingreso.</p>
					<p class='p-c'>Usuario: ".$email."<br>Pin: Ingreso.123*<br><a href='http://www.aprendoyaa.com/cursos' >Pincha aquí para Ingresar</a></p>
					<p class='p-l'>Esperemos te sea de gran ayuda para tus propósitos y desarrollo personal.</p>
					<br><br>
					<p class='p'><a href='http://www.aprendoyaa.com' >aprendoyaa.com</a></p>
				</div>
			</div>
			</body>
			</html>";

		$mail = new PHPMailer(TRUE);
		try {
		        $mail->isSMTP();
		        $mail->SMTPAuth = true;
		        $mail->Host = "smtp.hostinger.com";
		        $mail->Port = "465";
		        $mail->Username = "registro@aprendoyaa.com";
		        $mail->Password = "Hcc.123*Red";
		        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

		     	$mail->CharSet = 'UTF-8';
		     	$mail->Encoding = 'base64';

			$mail->setFrom('registro@aprendoyaa.com', 'Aprende Yaa');
			$mail->addAddress($email,$nombre);
			// $mail->addAddress('humbertocopa@gmail.com', "'".$nombre."'");
			$mail->addCC('info@aprendoyaa.com', 'Informacion Aprendo Yaa');
		        $mail->addBCC('soporte@aprendoyaa.com', 'Soporte Aprendo Yaa');

		        $mail->isHTML(true);
		        $mail->Subject = "Registro de afiliación al curso";
		     	$mail->Body = $mensaje;
		     	$mail->AltBody = $mensaje;
		        // $mail->addAttachment("/home/user/Desktop/ejemplodeimagen.png", "ejemplodeimagen.png");

		        $mail->send();
		        echo "Mensaje enviado correctamente...";
		} catch (Exception $e) {
		    echo "Mensaje no fue enviado. Error: ".$mail->ErrorInfo;
		}
	} else {
		$mensaje = "<!DOCTYPE html>
			<html lang='es'>
			<head>
				<meta charset='UTF-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
				<title>.:: Error al registro de afiliación ::.</title>
				<style>
					.cuerpo
					{
						margin: 0;
						padding: 0;
						width: 100%;
						align-items: center;
					}
					.recuadro
					{
						margin: 0 auto;
						padding: 50px 50px;
						border: 1px dotted silver;
						width: 50%;-webkit-box-shadow: 4px 5px 5px 0px rgba(122,113,122,1);
						-moz-box-shadow: 4px 5px 5px 0px rgba(122,113,122,1);
						box-shadow: 4px 5px 5px 0px rgba(122,113,122,1);
					}
					.p-t{
						text-align: left;
						font-size: 1.5em;
						font-weight: bold;
						font-style: italic;
						font-family: 'Latin Modern Roman';
			  		}
					.p-l{
						text-align: left;
						font-size: 1em;
						font-weight: bold;
						font-style: italic;
						font-family: 'Latin Modern Roman';
			  		}
			  		.p-c{
						text-align: center;
						font-size: 1em;
						font-weight: bold;
						/* font-style: italic; */
						font-family: 'Latin Modern Roman';
			  		}
			  		.p-r{
						text-align: right;
						font-size: 1em;
						font-weight: bold;
						font-style: italic;
						font-family: 'Latin Modern Roman';
			  		}
				</style>
			</head>
			<body>
			<div class='cuerpo'>
				<div class='recuadro'>
					<p class='p-t' h3>Registro de afiliación al curso</p>
					<p class='p-l'>Se presento ERRORES al registrar el USUARIO ".$nombre.", con EMAIL ".$email." en el curso <b>LA BASE DE LOS RECOGIDOS<b></p>
					<p class='p-l'>Ponerse en contacto para verificar ERROR...</p>
					<br><br>
					<p class='p'>
            			<a href='http://www.aprendoyaa.com' >aprendoyaa.com</a><br>
            			<span style='font-size: 0.8em;'>whatsapp: +591 74091600</span>
            		</p>
				</div>
			</div>
			</body>
			</html>";

		$mail = new PHPMailer(TRUE);
		try {
		        $mail->isSMTP();
		        $mail->SMTPAuth = true;
		        $mail->Host = "smtp.hostinger.com";
		        $mail->Port = "465";
		        $mail->Username = "registro@aprendoyaa.com";
		        $mail->Password = "Hcc.123*Red";
		        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

		     	$mail->CharSet = 'UTF-8';
		     	$mail->Encoding = 'base64';

			$mail->setFrom('registro@aprendoyaa.com', 'Aprende Yaa');
			// $mail->addAddress("'".$email."'", "'".$nombre."'");
			$mail->addAddress('info@aprendoyaa.com', "Informacion Aprendo Yaa");
			$mail->addCC('soporte@aprendoyaa.com', 'Soporte Aprendo Yaa');
		        // $mail->addBCC('soporte@aprendoyaa.com', '');

		        $mail->isHTML(true);
		        $mail->Subject = "ERROR de afiliación al curso";
		     	$mail->Body = $mensaje;
		     	$mail->AltBody = $mensaje;
		        // $mail->addAttachment("/home/user/Desktop/ejemplodeimagen.png", "ejemplodeimagen.png");

		        $mail->send();
		        echo "Mensaje enviado correctamente...";
		} catch (Exception $e) {
		    echo "Mensaje no fue enviado. Error: ".$mail->ErrorInfo;
		}
	}
}


?>







