<?php
  require_once '/model/posts.php';

  if(!isset($_GET['id'])) {
    header('location: /');
  }

  $postObj = new Post();
  $post = $postObj->getPost($_GET['id']);

  require_once '/view/post.php';
