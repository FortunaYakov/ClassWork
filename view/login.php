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

          <form method="POST" action="/index.php?r=/login">
            <div class="form-group">
               <label>Login</label>
              <input type="text" class="form-control" name="username" placeholder="username">
            </div>
            <div class="form-group">
               <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="password">
            </div>
              <input type="submit" class="btn btn-primary" value="Login!">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
