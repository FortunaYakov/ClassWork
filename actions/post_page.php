<?php

  class PostPage extends BasePage {
    private $postModel;

    public function __construct() {
      $this->postModel = new Post();
    }

    public function process($id) {
      $post = $this->postModel->getPost($id);

      if (isset($post)) {
        require_once './view/post.php';
      } else {
        $this->notFound();
      }
    }
  }
