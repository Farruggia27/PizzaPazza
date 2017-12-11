<html>
	<head>
		<title>Pizzerie</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<?php
		$n=120;
		$citta="bergamo";
		$richiesta="bar";
		# questo script chiama un'API e la inserisce in una tabella 
		# Indirizzo dell'API da richiedere
		$fourpage="https://api.foursquare.com/v2/venues/search?v=20161016&query=$richiesta&nit=$n&intent=checkin&client_id=X1GECFVKCU11GJRVBGXCRU0EYKOLTQCLDIIC4RPN2GN2ESLE&client_secret=Y2AXOQKNIL1BJJ1UWUDNLXOTME0D3310Y0XLQDP52HUEZPS5&near=$citta";
		# Codice di utilizzo di cURL
		# chiama l'API e la immagazzina in $json
		
		$chiamata = curl_init() or die(curl_error());
		curl_setopt($chiamata, CURLOPT_URL,$fourpage);
		curl_setopt($chiamata, CURLOPT_RETURNTRANSFER, 1);
		$json=curl_exec($chiamata) or die(curl_error());
		# Decodifico la stringa json e la salvo nella variabile $data
		$jcode = json_decode($json);
		
		echo "<table>";
			echo "<tr>";
				echo "<th>Nome Pizzeria</th>";
				echo "<th>Latitudine</th>";
				echo "<th>Longitudine</th>";
			echo "</tr>";
			for($i=0; $i<$n; $i++)
			{	$cont=1;
				echo "<tr>".$cont." ";
					echo "<td>";
					echo $jcode->response->venues[$i]->name;
					echo "</td>";
					echo "<td>";
					echo $jcode->response->venues[$i]->location->lat;
					echo "</td>";
					echo "<td>";
					echo $jcode->response->venues[$i]->location->lng;
					echo "</td>";
			 	$cont=$cont+1;
				echo "</tr>";
			}
		echo "</table>";
		echo curl_error($chiamata);
		curl_close($chiamata);
	?>
	</body>
</html>
