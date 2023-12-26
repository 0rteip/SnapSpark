<?php
final class DatabaseHelper
{
    private $db;

    public function __construct($serverName, $userName, $password, $dbName, $port)
    {
        $this->db = new mysqli($serverName, $userName, $password, $dbName, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        
        $this->db->set_charset("utf8mb4");
    }

    public function getRandomPosts($n)
    {
        $query = "SELECT username, file, id, descrizione, data, spark
                  FROM posts
                  ORDER BY RAND()
                  LIMIT ?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $n); // i mean integer (n is the number) -> number of parameters
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getHashtags()
    {

        $query = "SELECT nome, descrizione
                  FROM hashtags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($n = -1)
    {
        $query = "SELECT  idarticolo, titoloarticolo, imgarticolo, dataarticolo, anteprimaarticolo, nome
                  FROM articolo, autore
                  WHERE autore=idautore";
        if ($n > 0) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($n > 0) {
            $stmt->bind_param("i", $n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all((MYSQLI_ASSOC));
    }

    public function getPost($n)
    {
        $query = "SELECT  idarticolo, titoloarticolo, imgarticolo, dataarticolo, testoarticolo, nome
                  FROM articolo, autore
                  WHERE autore=idautore AND idarticolo=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all((MYSQLI_ASSOC));
    }

    public function getPostsByAuthor($username)
    {

        $query = "SELECT username, file, id, descrizione, data, spark
                  FROM posts, utenti
                  WHERE username=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("c", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
