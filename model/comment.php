<?php
/**
 * Коментарии к постам
 */
class Comment extends BaseModel
{

  function __construct(){
    parent::__construct();
  }
  public function getCommentByPostId($id){
     $stmt = $this->conn->prepare("SELECT c.author, c.body FROM comments as c WHERE c.post_id=?");
     $stmt->execute([$id]);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function addComment( $post_id, $body, $author) {
    $stmt = $this->conn->prepare('INSERT INTO comments (body, author,post_id) VALUES (?, ?, ?)');
    $stmt->execute([$body, $author, $post_id]);
    return $post_id;
  }

  public function validate($body, $author) {
        $errors = [];

        if (empty($body)) {
          $errors[] = 'Body should not be empty!';
        }

        if ($author == 'admin') {
          $errors[] = 'Admin should not create posts!';
        }

        return $errors;
      }
}


 ?>
