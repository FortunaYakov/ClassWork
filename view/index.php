<!doctype html>
<html lang="en">
  <head>
    <title>Start Page</title>
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
          <a class="btn btn-warning btn-lg" href="/" role="button">Start Page</a>
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
        <?php if ($this->isLoggedIn()) { ?>
        <div class="col-md-5">
          <a class="btn btn-success btn-sm" href="/?r=/addPost" role="button">Add new post</a>
        </div><?php } ?>
        <!-- <div class="btn-group" role="group"> -->
          <!-- <button type="button" class="btn btn-secondary">Left</button> -->
          <!-- <button type="button" class="btn btn-secondary">Middle</button> --> 
          <!-- <button type="button" class="btn btn-secondary">Right</button> -->
        <!-- </div> -->
        <?php foreach ($posts as $post) { ?>
          <div class="col-md-10">
            <div class="jumbotron jumbotron-fluid">
              <div class="container-fluid">
                <a href="/index.php?r=/post&id=<?php echo $post['id']; ?>">
                  <h1 class="display-3">
                    <?php echo $post['title']; ?>
                  </h1>
                </a>
                <p class="lead">
                  <?php echo $post['body']; ?>
                </p>
                <p class="lead">
                  <span class="badge badge-info">author: <?php echo $post['author']; ?></span>
                  <span class="badge badge-pill badge-secondary">comments count:<?php echo $post['comments_count']; ?></span>
                <ul class="list-group">
                  <?php $comment=$this->commentModel->getLastComment($post['id']); ?>
                    <li class="list-group-item list-group-item-primary">
                      <?php echo $comment['author'];?>:<?php echo $comment['body'];?>
                    </li>
                </ul>

                <?php if ($this->isLoggedIn()) {if($this->isYourPost($post['user_id'])) {?>
                <form method="POST" action="/index.php?r=/deletePost">
                  <label class="col-sm-2 col-form-label">Delete Post? </label>
                  <div class="form-group row">
                    <input type="hidden" value="<?php echo $post['id'] ?>" name="id">
                  <div class="col-sm-10">
                      <input type="submit" value="Delete!" class="btn btn-danger">
                  </div>
                  </div>
                </form>
                  <?php }} ?>
              </div>
            </div>
          </div>
        <?php } ?>

        <nav>
          <ul class="pagination">
            <li class="page-item <?php if ($currentPage == 1) { echo 'active'; } ?>">
              <a class="page-link" href="/index.php?r=/&page=1">First page</a>
            </li>
            <?php
              $start = ($currentPage < 4) ? 1 : $currentPage - 3;
              $stop = ($currentPage > $pageNumber - 3) ? $pageNumber : $currentPage + 3;

              for($i = $start; $i <= $stop; $i++) { ?>
              <li class="page-item <?php if ($i == $currentPage) { echo 'active'; } ?>">
                <a class="page-link" href="/index.php?r=/&page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php }?>
            <li class="page-item <?php if ($currentPage == $pageNumber) { echo 'active'; } ?>">
              <a class="page-link" href="/index.php?r=/&page=<?php echo $pageNumber; ?>">Last page</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </body>
</html>
