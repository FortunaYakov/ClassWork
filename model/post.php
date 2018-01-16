<?php

  class Post {
    private $storageLink = 'model/db.txt';

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
          'body' => 'body',
          'author' => 'admin',
        ];
      }

      return $posts;
    }
  }

  function post($id) {
    return [
      'title' => 'title ' . ($id+1),
      'body' => 'body',
      'author' => 'admin',
    ];
  }
