<?php

class UpdatePostPage extends BasePage {
  protected $postModel;

  public function __construct() {
    $this->postModel = new Post();
  }

  public function get() {
    $post = $this->postModel->getPost($this->getData['id']);
    require_once './view/update_post.php';
  }

  public function post() {
    $this->postModel->updatePost($this->postData['id'],
                                 $this->postData['title'],
                                 $this->postData['body'],
                                 $this->session['id']);

    $this->redirect('/post&id=' . $this->postData['id']);
  }
}
