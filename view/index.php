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
        <div class="col-md-10">
  <a class="btn btn-outline-warning btn-lg" href="/" role="button">Start Page</a>
  <a class="btn btn-success btn-sm" href="/?r=/addPost" role="button">add new post</a>
        </div>
        <?php foreach ($posts as $post) { ?>
          <div class="col-md-10">
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <a href="/index.php?r=/post&id=<?php echo $post['id']; ?>">
                  <h1 class="display-3">
                    <?php echo $post['title']; ?>
                  </h1>
                </a>
                <p class="lead">
                  <?php echo $post['body']; ?>
                </p>
                <p class="lead">
                  author: <?php echo $post['author']; ?>
                  <form method="POST" action="/index.php?r=/deletePost">
                    <input type="hidden" value="<?php echo $post['id'] ?>" name="id">
                    <input type="submit" value="Destroy!" class="btn btn-default">
                  </form>
                </p>
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
