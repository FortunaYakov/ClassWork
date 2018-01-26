<?php



  require_once './model/base_model.php';
  require_once './model/post.php';
  require_once './model/comment.php';
  require_once './model/user.php';

  require_once './router.php';

  require_once './actions/base_page.php';
  require_once './actions/index_page.php';
  require_once './actions/post_page.php';
  require_once './actions/add_post_page.php';
  require_once './actions/delete_page.php';
  require_once './actions/update_post_page.php';
  require_once './actions/addComment.php';
  require_once './actions/register_user_page.php';
  require_once './actions/login_user_page.php';
  require_once './actions/logout_user_page.php';


  $router = new Router($_GET, $_POST, $_SESSION, $_SERVER);

  $router->attach('indexPage', new IndexPage());
  $router->attach('postPage', new PostPage());
  $router->attach('addPostPage', new AddPostPage());
  $router->attach('deletePostPage', new DeletePostPage());
  $router->attach('updatePostPage', new UpdatePostPage());
  $router->attach('addCommentPage', new AddCommentPage());
  $router->attach('registerPage', new RegisterUserPage());
  $router->attach('loginPage', new LoginUserPage());
  $router->attach('logoutPage', new LogoutUserPage());


  $router->serve();
