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
		$this->stmt->execute($data);
	}

	// Returns an array with the data of the query
	public function data() {
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Counts the number of rows of the data returned
	public function rowCount() {
		return $this->stmt->rowCount();
	}

	// Returns the ID of the last inserted row
	public function lastInsertId() {
		return $this->lastInsertId();
	}

	// Liberates the statement produced by run()
	public function free() {
		$this->stmt->closeCursor();
	}
}