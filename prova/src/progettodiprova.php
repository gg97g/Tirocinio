<?php

require "Connector.php";

	function login(){
		echo("Sei entrato nella funzione login.");


		$user = trim($_POST['user']);
		$pass = trim($_POST['pass']);


		if(!$user || !$pass){
			echo("Non hai inserito tutti i dati. Si prega di inserire i dati richiesti.");
			exit;
		}
		else{

			$DB_name="";
			$DB_pass="";
			$DB_host="";
			$DB_user="";

			$conn = mysql_connect($DB_host, $DB_user, $DB_pass);
			$db = mysql_select_db($DB_name);

			if(!$conn || !$db){

				echo("Ci sono problemi con il data base. Riprovare.");
				exit;
			}
			else{

				$user = mysql_real_escape_string($user);
				$pass = mysql_real_escape_string($pass);

				$DB_table="";

				$query = "SELECT * FROM $DB_table WHERE username ='$user' AND password = md5('$pass')";
				$result=mysql_query($query);
				$row=mysql_fetch_array($result);
				echo ($row);

				if(!$row){
					echo("Utente non registrato.");
				}
				else{
					echo ($row);
					echo ("Complimenti ti sei loggato con successo.");
					mysql_close($conn);

				}

			}
		}

	}
	function form(){?>
		<html>
			<head>
				<title>Login form</title>
			</head>

			<body>
				<form action"" method="post">

					Username:<input type="text" name="user" value="" size="30">
					Password:<input type="password" name="pass" value"" size="30">
					<input type="submit" name="login" value="Login"><br>
					<label>Powered by ghostmars919</label>
				</form>
			</body>
		</html>
	<?php
	}


	if($_POST){
		login();
	}
	else{
		form();
	}
?>
