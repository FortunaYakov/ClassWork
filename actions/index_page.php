<?php

  class IndexPage extends BasePage {
    private $postModel;

    public function __construct() {
      $this->postModel = new Post();
    }

    protected function get() {
      $posts = $this->postModel->getPosts();
      require_once './view/index.php';
    }
  }
