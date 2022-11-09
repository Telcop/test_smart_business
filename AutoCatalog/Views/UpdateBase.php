<?php

namespace AutoCatalog\Views;

class UpdateBase
{
	// ! Параметры подключение к БД 
	// local
	private $servername = "localhost";
	private $database = "bd_auto";
	private $username = "root";
	private $password = "";


	private $table = "tbl_catalog";

	private $mysqli;

	private $metka;

	/**
	 * @param	String	$servername	Имя сервера
	 * @param	String	$database	Имя базы
	 * @param	String	$username	Логин
	 * @param	String	$password	Пароль
	 */
	public function __construct($servername = null, $database = null, $username = null, $password = null)
	{
		if (isset($servername)) $this->servername = $servername;
		if (isset($database)) $this->database = $database;
		if (isset($username)) $this->username = $username;
		if (isset($password)) $this->password = $password;

		$this->metkaFix(); // фиксация даты и времени для последующего удаления записей из базы

		$this->mysqli = new \MySqli($this->servername, $this->username, $this->password, $this->database);
		if ($this->mysqli->connect_error) {
			die('Ошибка подключения (' . $this->mysqli->connect_errno . ') '
				. $this->mysqli->connect_error);
		}
		if (!$this->mysqli->set_charset("UTF8")) {
			printf("Ошибка при загрузке набора символов utf8: %s\n", $this->mysqli->error);
		} else {
			printf("Текущий набор символов: %s\n", $this->mysqli->character_set_name());
		}
	}

	/**
	 * @param	String	$table	Выбор таблицы
	 */
	public function setTable($table)
	{
		$this->table = $table;
	}

	/**
	 * @param	Integer	$id	
	 * @result	Boolean	
	 */
	public function selectId($id)
	{
		$sql = "SELECT id FROM " . $this->table . " WHERE id = '" . $id . "'";
		$result = $this->mysqli->query($sql);
		return $result->num_rows == 1;
	}

	/**
	 * @param	Array $item	Массив данных о товаре
	 */
	public function insert($item)
	{
		$sql = $this->sqlInsert($item);
		$result = $this->mysqli->query($sql);
		return $result;
	}

	/**
	 * @param	Array $item	Массив данных о товаре
	 */
	public function update($item)
	{
		$sql = $this->sqlUpdate($item);
		$result = $this->mysqli->query($sql);
		return $result;
	}

	/**
	 * @return	Boolean
	 * DELETE FROM `tbl_catalog` WHERE date_metka <
	 */
	public function delete()
	{
		$sql = "DELETE FROM " . $this->table . " WHERE date_metka < '" . $this->metka . "'";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}

	private function metkaFix()
	{
		$this->metka = date('Y-m-d H:i:s');
	}

	/**
	 * @param	Array	$item	Массив данных о товаре
	 * @result	String
	 */
	private function sqlInsert($item)
	{
		$keys = "";
		$vals = "";
		foreach ($item as $key => $val) {
			$keys .= "`" . $key . "`, ";
			$vals .= isset($val) ? "'" . $val . "', " : "NULL, ";
		}
		return "INSERT INTO " . $this->table . " (" . $keys . "`date_metka`) VALUES (" . $vals . "CURRENT_TIMESTAMP)";
	}

	/**
	 * @param	Array	$item	Массив данных о товаре
	 * @result	String
	 */
	private function sqlUpdate($item)
	{
		$set = "";
		foreach ($item as $key => $val) {
			if ($key != 'id')
				$set .= isset($val) ? "`" . $key . "` = '" . $val . "', " : "`" . $key . "` = NULL, ";
		}
		return "UPDATE " . $this->table . " SET " . $set . "`date_metka` =  CURRENT_TIMESTAMP WHERE `id` = " . $item['id'];
	}
}
