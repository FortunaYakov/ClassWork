<?php

require_once '/model/posts.php';

$post = new Post();
$posts = $post->getPosts();

require_once './view/index.php';
