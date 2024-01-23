<?php
final class DatabaseHelper {
    private $db;
    //create a constant date format
    private $dateFormat = "Y-m-d H:i:s";

    public function __construct($serverName, $userName, $password, $dbName, $port) {
        $this->db = new mysqli($serverName, $userName, $password, $dbName, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        $this->db->set_charset("utf8mb4");
    }

    public function getAllUsers() {
        $query = "SELECT username, profile_img as img
                  FROM utenti WHERE username!=? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function validateUsername($username) {
        $query = "SELECT username FROM utenti WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) == 0;
    }
    public function validateMail($mail) {
        $query = "SELECT mail FROM utenti WHERE mail=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        return count($stmt->get_result()->fetch_all(MYSQLI_ASSOC)) == 0;
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

        $query = "SELECT p.username, file, id, descrizione, data, spark, profile_img
                  FROM posts AS p, utenti AS u
                  WHERE p.username=? AND p.username = u.username
                  ORDER BY data DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($mail, $pwd) {
        $query = "SELECT username
                  FROM utenti
                  WHERE (mail=? OR username=?) AND password=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $mail, $mail, $pwd);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function updateUser(
        $oldUser,
        $profileImg,
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
        $query = "UPDATE utenti SET
                  username =?, nome=?, cognome=?, sesso=?, password=?, data_nascita=?, mail=?, numero=?, biografia=?, nome_social=?, profile_img=?
                  WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssissss',
            $username,
            $nome,
            $cognome,
            $sesso,
            $password,
            $dataNascita,
            $mail,
            $numero,
            $biografia,
            $nome_social,
            $profileImg,
            $oldUser
        );
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function insertNewUser(
        $profileImg,
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
                  (username, nome, cognome, sesso, password, data_nascita, mail, numero, biografia, nome_social, profile_img)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssisss',
            $username,
            $nome,
            $cognome,
            $sesso,
            $password,
            $dataNascita,
            $mail,
            $numero,
            $biografia,
            $nome_social,
            $profileImg
        );
        $stmt->execute();
    }

    public function getFollower($username) {
        $query = "SELECT follower as username, profile_img as img
                  FROM follow,utenti
                  WHERE user=? AND username=follower"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowed($username) {
        $query = "SELECT user as username, profile_img as img
                  FROM follow, utenti
                  WHERE follower=? AND username=user"; // ? is a placeholder
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getComments($user, $postId) {
        $query = "SELECT c.*, u.profile_img
                  FROM commenti AS c, utenti AS u
                  WHERE c.post_user=? AND c.post_id=?
                  AND c.user = u.username";
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

    public function getUserInfo($username) {
        $query = "SELECT nome, cognome, username, sesso, password, data_nascita, mail, numero,  biografia, profile_img
                  FROM utenti
                  WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
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

    public function followUser($follower, $user) {
        $query = "INSERT INTO follow( follower, user) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $follower, $user);
        $stmt->execute();
    }

    public function unfollowUser($follower, $user) {
        $query = "DELETE FROM follow WHERE follower=? AND user=? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $follower, $user);
        $stmt->execute();
    }

    private function getLastPostId($username) {
        $query = "SELECT MAX(id) as id
                  FROM posts
                  WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]["id"];
    }

    public function sharePost($filename, $description) {
        $zero = 0;
        $username = $_SESSION["username"];
        $nextId = $this->getLastPostId($username) + 1;
        $date = date($this->dateFormat);
        $query = "INSERT INTO posts(username, file, id, descrizione, data, spark)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssisss",
            $username,
            $filename,
            $nextId,
            $description,
            $date,
            $zero
        );
        $stmt->execute();
    }

    public function findExistingChat() {
        $query = "SELECT sen_username rec_username testo FROM messaggio";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function sendMessage($sender, $reciver, $testo) {
        $date = date($this->dateFormat);
        $id = $this->getLastMessageId();
        $query = "INSERT INTO messaggio(sen_username, rec_username, testo, id, data) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssis', $sender, $reciver, $testo, $id, $date);
        $stmt->execute();
    }
    private function getLastMessageId() {
        $query = "SELECT MAX(id) as id FROM messaggio";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (empty($result)) {
            return 1;
        } else {
            return $result[0]['id'] + 1;
        }
    }

    public function getMessages($sender, $reciver) {
        $query = "SELECT sen_username as sender, testo, data, id
                  FROM messaggio
                  WHERE (sen_username=? AND rec_username=?) OR (rec_username=? AND sen_username=? ) ORDER BY data";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $sender, $reciver, $sender, $reciver);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteMessage($id) {
        $id_i = intval($id);
        $query = "DELETE FROM messaggio
                      WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_i);
        $stmt->execute();
        $query = "UPDATE messaggio SET id = id -1 WHERE id>?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
    }
    public function getChats() {
        $sender = $_SESSION['username'];
        $query = "SELECT sen_username as sender, rec_username as reciver, testo, data
                  FROM messaggio
                  WHERE sen_username=? OR rec_username=? ORDER BY data";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $sender, $sender);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getDailyHashtag() {
        $query = "SELECT nome, descrizione
                  FROM hashtags
                  ORDER BY RAND(CURDATE() * CURDATE())
                  LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function updateUserPicture($username, $profileImg) {
        $query = "UPDATE utenti
                  SET profile_img=?
                  WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ss",
            $profileImg,
            $username
        );
        $stmt->execute();
    }

    private function getLastNotficationId() {
        $query = "SELECT MAX(id) as id FROM notifica";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (empty($result)) {
            return 1;
        } else {
            return $result[0]['id'] + 1;
        }
    }

    public function sendNotification($sender, $reciver, $type) {
        $id = $this->getLastNotficationId();
        $date = date($this->dateFormat);
        $query = "INSERT INTO notifica(tipo, sen_user, id, username, data) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssiss', $type, $sender, $id, $reciver, $date);
        $stmt->execute();
        return $id;
    }

    public function getUserNotification() {
        $reciver = $_SESSION['username'];
        $query = "SELECT tipo, sen_user as sender ,id, utenti.profile_img FROM notifica, utenti WHERE notifica.username=? AND utenti.username=sen_user ORDER BY data DESC ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $reciver);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function checkNewNotification() {
        $reciver = $_SESSION['username'];
        $lastCheck = $_SESSION['last_ver_not'];
        $query = "SELECT * FROM notifica WHERE username=? ORDER BY data ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $reciver);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $nots = [];
        if (empty($result)) {
            return $nots;
        } else {
            //check if bigger
            foreach ($result as $value) {
                if ($value['data'] > $lastCheck) {
                    array_push($nots, $value);
                }
            }
            return $nots;
        }
    }

    public function deleteNotification($id) {
        $query = "DELETE FROM notifica WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $query = "UPDATE notifica SET id = id -1 WHERE id>?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
    }

    public function removeAllNotification() {
        $user = $_SESSION['username'];
        $query = "SELECT id FROM notifica WHERE username=? ORDER BY data DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $not) :
            $this->deleteNotification($not['id']);
        endforeach;
    }

    public function deletePost($username, $id) {
        $query = "DELETE FROM like_post WHERE post_username=? AND post_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $id);
        $stmt->execute();

        $query = "DELETE FROM likes WHERE post_username=? AND post_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $id);
        $stmt->execute();

        $query = "DELETE FROM commenti WHERE post_user=? AND post_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $id);
        $stmt->execute();

        $query = "DELETE FROM posts WHERE username=? AND id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $id);
        $stmt->execute();
    }

    public function deleteComment($commentUser, $postUser, $postId, $commentId) {
        $query = "DELETE FROM like_post
                  WHERE comment_username=? AND post_username=? AND post_id=? AND comment_id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sisi", $commentUser, $postUser, $postId, $commentId);
        $stmt->execute();

        $query = "DELETE FROM commenti
                  WHERE post_user=? AND post_id=? AND user=? AND id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sisi", $postUser, $postId, $commentUser, $commentId);
        $stmt->execute();
    }
}
