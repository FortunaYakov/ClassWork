<?php

  class Post extends BaseModel {
    private $postsOnPage;

    public function __construct() {
      parent::__construct();
      $this->postsOnPage = 10;
    }

    public function validate($title, $body, $author) {
      $errors = [];

      if (strlen($title) < 5) {
        $errors[] = 'Title string is too short!';
      }

      if (empty($body)) {
        $errors[] = 'Body should not be empty!';
      }

      if ($author == 'admin') {
        $errors[] = 'Admin should not create posts!';
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

    public function updatePost($id, $title, $body, $author) {
      $stmt = $this->conn->prepare('UPDATE posts SET title = ?, body = ?, author = ? WHERE id = ?');
      $stmt->execute([$title, $body, $author, $id]);
    }

    public function getPost($id) {
      $stmt = $this->conn->prepare('SELECT * FROM posts WHERE id = ?');
      $stmt->execute([$id]);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPost($title, $body, $author) {
      $stmt = $this->conn->prepare('INSERT INTO posts (title, body, author) VALUES (?, ?, ?)');
      $stmt->execute([$title, $body, $author]);

      return $this->conn->lastInsertId();
    }

    public function getPostsWithCommentsCount() {
      $res = $this->conn->query('SELECT p.id, p.author, p.title, p.body, COUNT(c.id) as comments_count FROM posts as p LEFT JOIN comments as c ON p.id = c.post_id GROUP BY p.id');
      return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function deletePost($id) {
      $stmt = $this->conn->prepare('DELETE FROM posts WHERE id = ?');
      $stmt->execute([$id]);
    }
  }
