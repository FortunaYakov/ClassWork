<?php

class LoginUserPage extends BasePage {
  private $userModel;
  private $errors = [];

  public function __construct() {
    $this->userModel = new User();
  }

  protected function get() {
    require_once './view/login.php';
  }

  protected function post() {
    $username = $this->postData['username'];
    $password = $this->postData['password'];

    $user = $this->userModel->checkUser($username, $password);

    if ($user) {
      $this->session['username'] = $user['username'];
      $this->session['id'] = $user['id'];
      $this->redirect('/');
    } else {
      $this->redirect('/login');
    }
  }
}
