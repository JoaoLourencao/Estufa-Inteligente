<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/corpo.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body class="corpo">
	<?php include("cabecalho.php"); ?>
	<div class="corpogeral">
		<table class="table table-striped">
			<thead>
				<tr class='thead-dark '>
					<th scope="col">ID</th>
					<th scope="col">Sensor</th>
					<th scope="col">Valor</th>
					<th scope="col">Data</th>
					<th scope="col">Hora</th>
				</tr>
			</thead>
			<tbody class="corporgeral">
				<?php
				ini_set('display_errors', 1);
				ini_set('display_startup_erros', 1);
				error_reporting(E_ALL);

				require 'config.php';
				require 'connection.php';
				require 'database.php';

				$dados = DBread('SENSORES', "SENSORES.SENSORESSENSOR='temperatura'");

				//var_dump($dados);

				foreach ($dados as $value) {
					echo ("<tr>");
					echo ('<th scope="row">' . $value['SENSORESID'] . '</th>');
					echo strtoupper('<td>' . $value['SENSORESSENSOR'] . '</td>');
					echo ('<td>' . $value['SENSORESVLR'] . ' °C</td>');
					$data_hora = explode(' ', $value['SENSORESDTHR']);
					$originalDate = $data_hora[0];
					$newDate = date("d/m/Y");
					strtotime($originalDate);
					echo ('<td>' . $newDate . '</td>');
					if ($data_hora[1] >= '12:00:00' && $data_hora[1] <= '23:59:59')
						echo ('<td>' . $data_hora[1] . '  PM</td>');
					else
						echo ('<td>' . $data_hora[1] . '  AM</td>');
					echo ("</tr>");
					//foreach($value as )
				} ?>
			</tbody>
		</table>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>