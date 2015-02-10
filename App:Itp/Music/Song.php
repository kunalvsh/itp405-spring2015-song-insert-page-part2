<?php

namespace Itp\Music;
use \Itp\Base\Database;


class Song extends Database {
	private $id;
	private $title;
	private $artist_id;
	private $genre_id;
	private $price;

	public function getID() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setArtistID($artist_id) {
		$this->artist_id = $artist_id;
	}

	public function setGenreID($genre_id) {
		$this->genre_id = $genre_id;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function save() {
		$sql = "
			INSERT INTO songs (title, genre_id, artist_id, price)
			VALUES (:title, :genre_id, :artist_id, :price)
		";

		$statement = static::$pdo->prepare($sql);
		$statement->bindParam(":title", $this->title);
		$statement->bindParam(":genre_id", $this->genre_id);
		$statement->bindParam(":artist_id", $this->artist_id);
		$statement->bindParam(":price", $this->price);
		$statement->execute();
		
		$this->id = static::$pdo->lastInsertId();

		//return $statement->fetchAll(PDO::FETCH_OBJ);
	}

}


?>