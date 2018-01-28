<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
          <a class="btn btn-outline-warning btn-lg" href="/" role="button">Start Page</a>
        </div>
        <div class="col-md-1">
          <?php if ($this->isLoggedIn()) { ?>
            <form method="POST" action="/index.php?r=/logout">
              <div class="form-group">
                <span class="badge badge-info"><?php echo $this->session['username'];?></span>
                <input type="submit" class="btn btn-danger" name="logout" value="Logout!">
              </div>
            </form>
          <?php } else { ?>
            <a class="btn btn-outline-info" href="/?r=/register">REGISTRATION</a>
            <a class="btn btn-success btn-sm" href="/?r=/login">Login</a>
          <?php } ?>
        </div>
          <div class="col-md-10">
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-3">
                  <?php echo $post['title']; ?>
                </h1>
                <p class="lead">
                  <?php echo $post['body']; ?>
                </p>
                <p class="lead">
                  author: <?php echo $post['author']; ?>
                </p>
                <?php if ($this->isLoggedIn()) {if($this->isYourPost($post['user_id'])) {?>
                <a href="/index.php?r=/updatePost&id=<?php echo $post['id']; ?>" class="btn btn-default">Update Post</a>
              <?php }} ?>
              </div>
            </div>
            <ul class="list-group">
              <?php $com=False; foreach ($comments as $comment) { ?>
                <li class="list-group-item list-group-item-<?php if ($com){ echo 'primary';}else{echo 'dark';} $com=!$com;?>"><?php echo $comment['author'];?>:<?php echo $comment['body'];?></li>
              <?php };  ?>
            </ul>

            <form method="POST" action="/index.php?r=/addComment" class="form">
              <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
              <div class="form-row">
              <div class="col-7">
                <input class="form-control" type="text" name="body" placeholder="your opinion" >
              </div>
                <input type="submit"  class="btn btn-primary" value="comment!">
              </div>
            </form>

          </div>
      </div>
    </div>
  </body>
</html>
