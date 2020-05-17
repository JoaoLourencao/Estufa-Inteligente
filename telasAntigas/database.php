 <?php
	/*ler todos registros resgistros*/
	function DBread($table, $params = null, $fields = '*')
	{
		$params = ($params) ? "WHERE  {$params}" : null;

		$query = "SELECT {$fields} FROM {$table} {$params}";
		$result = DBexecute($query);


		if (!mysqli_num_rows($result))
			return false;
		else {
			while ($res = mysqli_fetch_assoc($result)) {
				$data[] = $res;
			}
			return $data;
		}
	}

	/*grava registros*/
	function DBcreate($table, array $data)
	{
		$table = DB_PREFIX . '_' . $table;
		$data = DBescape($data);
		$values = "'" . implode("', '", $data) . "'";

		$fields = implode(', ', array_keys($data));

		$query = "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
		return DBexecute($query);
	}


	/*executa querys*/
	function DBexecute($query)
	{
		$link = DBconnect();
		$result = @mysqli_query($link, $query) or die(mysqli_error($link));

		DBclose($link);
		return $result;
	}


	?>