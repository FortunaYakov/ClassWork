<?php

  class Post {
    private $storageLink = 'model/db.txt';

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

    public function __construct() {
      if (!$this->dbExists()) {
        $this->createDB();
      }
    }

    public function getPosts() {
      return unserialize(file_get_contents($this->storageLink));
    }

    public function getPost($id) {
      $posts = $this->getPosts();
      if ($id >= count($posts)) {
        return null;
      } else {
        return $posts[$id];
      }
    }

    public function addPost($title, $body, $author) {
      $posts = $this->getPosts();

      $posts[] = [
        'title' => $title,
        'body' => $body,
        'author' => $author,
      ];

      file_put_contents($this->storageLink, serialize($posts));
      return count($posts) - 1;
    }

    private function dbExists() {
      return file_exists($this->storageLink);
    }

    private function createDB() {
      $posts = $this->generatePosts();
      $str = serialize($posts);

      file_put_contents($this->storageLink, $str);
    }

    private function generatePosts($number = 5) {
      $posts = [];

      for($i = 0; $i < $number; $i++) {
        $posts[] = [
          'title' => 'title ' . ($i+1),
          'body' => 'another body',
          'author' => 'admin',
        ];
      }

      return $posts;
    }
  }
