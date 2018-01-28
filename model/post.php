<?php

  class Post extends BaseModel {
    private $postsOnPage;

    public function __construct() {
      parent::__construct();
      $this->postsOnPage = 5;
    }

    public function validate($title, $body) {
      $errors = [];

      if (strlen($title) < 5) {
        $errors[] = 'Title string is too short!';
      }

      if (empty($body)) {
        $errors[] = 'Body should not be empty!';
      }

        return $errors;
    }

    public function pageNumber() {
      $res = $this->conn->query('SELECT count(id) as count FROM posts');
      $totalNumber = $res->fetch(PDO::FETCH_ASSOC)['count'];

      return ceil($totalNumber / $this->postsOnPage);
    }

    public function getPosts($pageNumber) {
      $offsetValue = ($pageNumber - 1) * $this->postsOnPage;

      $stmt = $this->conn->prepare('SELECT * FROM posts LIMIT :lim OFFSET :offs');
      $stmt->bindParam(':lim', $this->postsOnPage, PDO::PARAM_INT);
      $stmt->bindParam(':offs', $offsetValue, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $body, $user_id) {
      $stmt = $this->conn->prepare('UPDATE posts SET title = ?, body = ?, user_id = ? WHERE id = ?');
      $stmt->execute([$title, $body, $user_id, $id]);
    }

    public function getPost($id) {
      $stmt = $this->conn->prepare('SELECT p.id, u.username as author, p.user_id, p.title, p.body FROM posts as p LEFT JOIN users as u on p.user_id=u.id WHERE p.id=?');
      $stmt->execute([$id]);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPost($title, $body, $user_id) {
      $stmt = $this->conn->prepare('INSERT INTO posts (title, body, user_id) VALUES (?, ?, ?)');
      $stmt->execute([$title, $body, $user_id]);

      return $this->conn->lastInsertId();
    }

    public function getPostsWithCommentsCount($pageNumber,$sort) {
      $offsetValue = ($pageNumber - 1) * $this->postsOnPage;
      $stmt = $this->conn->prepare('SELECT p.id, u.username as author,p.user_id, p.title, p.body, COUNT(c.id) as comments_count FROM posts as p
      LEFT JOIN comments as c ON p.id = c.post_id LEFT JOIN users as u on p.user_id=u.id
      GROUP BY p.id  ORDER BY :sort LIMIT :lim OFFSET :offs');
      $stmt->bindParam(':sort', $sort, PDO::PARAM_STR);
      $stmt->bindParam(':lim', $this->postsOnPage, PDO::PARAM_INT);
      $stmt->bindParam(':offs', $offsetValue, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetUserById($user_id)
    {
      $stmt = $this->conn->prepare('SELECT username FROM users WHERE id=?');
      $stmt->execute([$user_id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletePost($id) {
      $stmt = $this->conn->prepare('DELETE FROM posts WHERE id = ?');
      $stmt->execute([$id]);
    }
  }
