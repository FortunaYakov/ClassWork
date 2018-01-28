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

          <form method="POST" action="/index.php?r=/addPost" class="form">
            <?php if (isset($oldValues)) { ?>
            <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="title" value="<?php echo $oldValues['title']; ?>">
            </div>
            <div class="form-group">
              <textarea class="form-control" name="body"><?php echo $oldValues['body']; ?></textarea>
            </div>
            <?php } else { ?>
              <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="title">
              </div>
              <div class="form-group">
              <textarea class="form-control" name="body"></textarea>
              </div>
            <?php }?>
            <input type="submit" class="btn btn-success" value="Create!">
          </form>
        </div>

      </div>
    </div>
  </body>
</html>
