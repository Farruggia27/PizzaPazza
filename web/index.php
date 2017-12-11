<html>
	<head>
		<title>Pizzerie</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<?php
		$n=30;
		$citta="bergamo";
		$richiesta="pizzeria";
		
		# indirizzo foursquare con proprie credenziali
		$fourpage="https://api.foursquare.com/v2/venues/search?v=20161016&query=$richiesta&nit=$n&intent=checkin&client_id=X1GECFVKCU11GJRVBGXCRU0EYKOLTQCLDIIC4RPN2GN2ESLE&client_secret=Y2AXOQKNIL1BJJ1UWUDNLXOTME0D3310Y0XLQDP52HUEZPS5&near=$citta";
		
		$memorizza = curl_init() or die(curl_error());	# Memorizza l'api nella variabile $json
		curl_setopt($memorizza, CURLOPT_URL,$fourpage);
		curl_setopt($memorizza, CURLOPT_RETURNTRANSFER, 1);
		$json=curl_exec($memorizza) or die(curl_error());
		
		$jcode = json_decode($json); # Decodifico e salvo nella variabile $jcode
		
		echo "<table>";
			echo "<tr>";
				echo "<th>N.</th>";
				echo "<th>Nome Pizzeria</th>";
				echo "<th>Latitudine</th>";
				echo "<th>Longitudine</th>";
			echo "</tr>";
			for($i=0; $i<$n; $i++)
			{	
				echo "<tr>";
			 		echo "<td>";
					echo $i+1;
					echo "</td>";
					echo "<td>";
					echo $jcode->response->venues[$i]->name;
					echo "</td>";
					echo "<td>";
					echo $jcode->response->venues[$i]->location->lat;
					echo "</td>";
					echo "<td>";
					echo $jcode->response->venues[$i]->location->lng;
					echo "</td>";
				echo "</tr>";
			}
		echo "</table>";
		echo curl_error($memorizza);
		curl_close($memorizza);
	?>
	</body>
</html>
