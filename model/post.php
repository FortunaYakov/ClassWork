<?php

  class Post extends BaseModel {
    public function __construct() {
      parent::__construct();
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

    public function getPosts() {
      $res = $this->conn->query('SELECT * FROM posts');
      return $res->fetchAll(PDO::FETCH_ASSOC);
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

    public function deletePost($id) {
      $stmt = $this->conn->prepare('DELETE FROM posts WHERE id = ?');
      $stmt->execute([$id]);
    }
  }
