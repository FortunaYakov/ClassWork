<?php

  class PostPage extends BasePage {
    private $postModel;

    public function __construct() {
      $this->postModel = new Post();
    }

    protected function get() {
      $post = $this->postModel->getPost($this->getData['id']);

      if (isset($post)) {
        require_once './view/post.php';
      } else {
        $this->notFound();
      }
    }


  }
