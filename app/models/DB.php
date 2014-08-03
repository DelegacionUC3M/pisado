<?php

class DB {
	// Connection configurations
	private $host   =  SQL_HOST;
	private $user   =  SQL_USER;
	private $pass   =  SQL_PASSWD;
	private $dbs    =  SQL_DB;

	private $db;
	private $stmt;

	function __construct() {
		$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbs.';charset=utf8', $this->user, $this->pass);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	// Prepares and executes the queries
	public function run($sql,$data = array()) {
		$this->stmt = $this->db->prepare($sql);
		try { 
			return $this->stmt->execute($data);
		} catch(PDOException $e) {
			print_r($e);
			return false;
		}
	}

	// Returns an array with the data of the query
	public function data() {
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Counts the number of rows of the data returned
	public function count() {
		return $this->stmt->rowCount();
	}

}
