<?php

  class IndexPage extends BasePage {
    private $postModel;

    public function __construct() {
      $this->postModel = new Post();
      $this->commentModel = new Comment();
    }

    protected function get() {
      $sort='p.id';
      
      if (isset($this->getData['page'])) {
        $currentPage = $this->getData['page'];
      } else {
        $currentPage = 1;
      }

      $posts = $this->postModel->getPostsWithCommentsCount($currentPage,$sort);
      $pageNumber = $this->postModel->pageNumber();
      require_once './view/index.php';
    }
  }
