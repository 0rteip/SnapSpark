<?php
final class DatabaseHelper {
    private $db;

    public function __construct($serverName, $userName, $password, $dbName, $port) {
        $this->db = new mysqli($serverName, $userName, $password, $dbName, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        $this->db->set_charset("utf8mb4");
    }

    public function getRandomPosts($n) {
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

    public function getHashtags() {

        $query = "SELECT nome, descrizione
                  FROM hashtags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($n = -1) {
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

    public function getPostsByAuthor($username) {

        $query = "SELECT username, file, id, descrizione, data, spark
                  FROM posts
                  WHERE username=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($mail, $pwd) {
        $query = "SELECT username
                  FROM utenti
                  WHERE mail=? AND password=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $mail, $pwd);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNewUser(
        $username,
        $nome,
        $cognome,
        $sesso,
        $password,
        $dataNascita,
        $mail,
        $numero,
        $biografia
    ) {
        $nome_social = "SnapSpark";
        $query = "INSERT INTO utenti
                  (username, nome, cognome, sesso, password, data_nascita, mail, numero, biografia, nome_social)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssiss',
            $username,
            $nome,
            $cognome,
            $sesso,
            $password,
            $dataNascita,
            $mail,
            $numero,
            $biografia,
            $nome_social
        );
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getFollower($username) {
        $query = "SELECT follower
                  FROM follow
                  WHERE user=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowed($username) {
        $query = "SELECT user
                  FROM follow
                  WHERE follower=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getComments($user, $postId) {
        $query = "SELECT user, testo, upvote
                  FROM commenti
                  WHERE post_user=? AND post_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $user, $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addComment($postUser, $postId, $text) {
        $zero = 0;
        $nextId = $this->getLastId($postUser, $postId, $_SESSION["username"]) + 1;

        $query = "INSERT INTO commenti
                  (post_user, post_id, user, id, testo, upvote)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "sisisi",
            $postUser,
            $postId,
            $_SESSION["username"],
            $nextId,
            $text,
            $zero
        );
        $stmt->execute();
    }

    private function getLastId($postUser, $postId, $user) {
        $query = "SELECT MAX(id) as id
                  FROM commenti
                  WHERE post_user=? AND post_id=? AND user=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sis", $postUser, $postId, $user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["id"];
    }
}
