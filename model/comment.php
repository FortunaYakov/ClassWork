<?php
class Comment extends BaseModel
{

  function __construct(){
    parent::__construct();
  }
  public function getCommentByPostId($id){
     $stmt = $this->conn->prepare("SELECT u.username as author, c.body FROM comments as c LEFT JOIN users as u on c.user_id=u.id WHERE c.post_id=? ORDER BY c.id");
     $stmt->execute([$id]);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function addComment( $post_id, $body, $user_id) {
    $stmt = $this->conn->prepare('INSERT INTO comments (body, user_id,post_id) VALUES (?, ?, ?)');
    $stmt->execute([$body, $user_id, $post_id]);
    return $post_id;
  }

  public function getLastComment($id)
  {
    $stmt = $this->conn->prepare("SELECT c.body, u.username as author FROM comments as c LEFT JOIN users as u on c.user_id=u.id WHERE c.post_id=? ORDER By c.id DESC");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function validate($body) {
        $errors = [];

        if (empty($body)) {
          $errors[] = 'Comment should not be empty!';
        }

          return $errors;
      }
}


 ?>
