<?php
  require_once './model/post.php';

  require_once './router.php';

  require_once './actions/base_page.php';
  require_once './actions/index_page.php';
  require_once './actions/post_page.php';

  $router = new Router($_GET);

  $router->attach('indexPage', new IndexPage());
  $router->attach('postPage', new PostPage());

  $router->serve();
