<?php
/**
 *  Создание коментариев
 */
class AddCommentPage extends BasePage
{
  private $commentModel;
  private $errors = [];

  public function __construct() {
    $this->commentModel = new Comment();
  }
  protected function post() {
    $post_id=$this->commentModel->addComment($this->postData['post_id'],
                                            $this->postData['body'],
                                            $this->session['id']);

    $this->redirect('/post&id=' . $post_id);
  }
}

 ?>
