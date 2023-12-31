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

    public function getAllUsers() {
        $query = "SELECT username
                  FROM utenti";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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
                  WHERE mail=? OR username=? AND password=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $mail, $mail, $pwd);
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
        $query = "SELECT follower as username
                  FROM follow
                  WHERE user=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowed($username) {
        $query = "SELECT user as username
                  FROM follow
                  WHERE follower=?"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getComments($user, $postId) {
        $query = "SELECT *
                  FROM commenti
                  WHERE post_user=? AND post_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $user, $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $this->checkLike($result->fetch_all(MYSQLI_ASSOC));
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

    public function likePost($postUser, $postId) {
        $likeUser = $_SESSION["username"];

        if ($this->isLikeToPostPresent($postUser, $postId, $likeUser)) {
            $like = $this->updatePostLike($postUser, $postId, false);
            $query = "DELETE FROM likes
                      WHERE post_username=? AND post_id=? AND username=?";
            echo json_encode(array('like' => false, 'likes' => $like));
        } else {
            $like = $this->updatePostLike($postUser, $postId);
            $query = "INSERT INTO likes
                      (post_username, post_id, username)
                      VALUES (?, ?, ?)";
            echo json_encode(array('like' => true, 'likes' => $like));
        }

        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "sis",
            $postUser,
            $postId,
            $likeUser
        );
        $stmt->execute();
    }

    private function updatePostLike($postUser, $postId, $like = true) {
        $likes = $this->getLikesOfPost($postUser, $postId) + ($like ? 1 : -1);
        $query = "UPDATE posts
                  SET spark=?
                  WHERE username=? AND id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "isi",
            $likes,
            $postUser,
            $postId
        );
        $stmt->execute();

        return $likes;
    }

    private function checkLike($result) {
        foreach ($result as $key => $value) {
            $query = "SELECT *
                      FROM like_post
                      WHERE comment_username=? AND post_username=? AND post_id=? AND comment_id=? AND like_username=?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param(
                "ssiis",
                $value["user"],
                $value["post_user"],
                $value["post_id"],
                $value["id"],
                $_SESSION["username"]
            );
            $stmt->execute();

            if (empty($stmt->get_result()->fetch_all(MYSQLI_ASSOC))) {
                $result[$key]["like"] = false;
            } else {
                $result[$key]["like"] = true;
            }
        }
        return $result;
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

    public function getUserBio($username) {
        $query = "SELECT biografia
                  FROM utenti
                  WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function likeComment($commentUser, $postUser, $postId, $commentId) {
        $likeUser = $_SESSION["username"];

        if ($this->isLikeToCommentPresent($commentUser, $postUser, $postId, $commentId, $likeUser)) {
            $this->updateCommentLike($postUser, $postId, $commentUser, $commentId, false);
            $query = "DELETE FROM like_post
                      WHERE comment_username=? AND post_username=? AND post_id=? AND comment_id=? AND like_username=?";
        } else {
            $this->updateCommentLike($postUser, $postId, $commentUser, $commentId);
            $query = "INSERT INTO like_post
                      (comment_username, post_username, post_id, comment_id, like_username)
                      VALUES (?, ?, ?, ?, ?)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssiis",
            $commentUser,
            $postUser,
            $postId,
            $commentId,
            $likeUser
        );
        $stmt->execute();
    }

    private function isLikeToCommentPresent($commentUser, $postUser, $postId, $commentId, $likeUser) {
        $query = "SELECT *
                  FROM like_post
                  WHERE comment_username=? AND post_username=? AND post_id=? AND comment_id=? AND like_username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssiis",
            $commentUser,
            $postUser,
            $postId,
            $commentId,
            $likeUser
        );
        $stmt->execute();
        return !empty($stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    }

    private function isLikeToPostPresent($postUser, $postId, $likeUser) {
        $query = "SELECT *
                  FROM likes
                  WHERE post_username=? AND post_id=? AND username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "sis",
            $postUser,
            $postId,
            $likeUser
        );
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return !empty($result);
    }

    private function updateCommentLike($postUser, $postId, $user, $id, $like = true) {
        $likes = $this->getLikesOfComment($postUser, $postId, $user, $id) + ($like ? 1 : -1);

        $query = "UPDATE commenti
                  SET upvote=?
                  WHERE post_user=? AND post_id=? AND user=? AND id=?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "isisi",
            $likes,
            $postUser,
            $postId,
            $user,
            $id
        );
        $stmt->execute();
    }

    public function checkPostLike($postUser, $postId) {
        $userLike = $_SESSION["username"];
        $query = "SELECT *
                  FROM likes
                  WHERE post_username=? AND post_id=? AND username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "sis",
            $postUser,
            $postId,
            $userLike
        );
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return !empty($result);
    }

    private function getLikesOfPost($postUser, $postId) {
        $query = "SELECT spark
                  FROM posts
                  WHERE username=? AND id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "si",
            $postUser,
            $postId
        );
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["spark"];
    }

    private function getLikesOfComment($postUser, $postId, $user, $id) {
        $query = "SELECT upvote
                  FROM commenti
                  WHERE post_user=? AND post_id=? AND user=? AND id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssii",
            $postUser,
            $postId,
            $user,
            $id
        );
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["upvote"];
    }
}
