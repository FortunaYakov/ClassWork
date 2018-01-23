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
        <div class="col-md-10">
          <?php if (isset($validateErrors)) {
              foreach ($validateErrors as $error) { ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $error; ?>
                </div>
            <?php }
          } ?>

          <form method="POST" action="/index.php?r=/updatePost" class="form">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <input type="text" name="title" placeholder="title" value="<?php echo $post['title']; ?>">
            <input type="text" name="author" placeholder="author" value="<?php echo $post['author']; ?>">
            <textarea name="body"><?php echo $post['body']; ?></textarea>
            <input type="submit" value="Update!">
          </form>
        </div>

      </div>
    </div>
  </body>
</html>
