<?php

try {
  $comment = $db->prepare('
    SELECT comments.content,
    newsfeed.id,
    lastname,
    firstname,
    authorid,
    comments.date,
    users.profile_pic,
    comments.id
    FROM comments,
    authorcomment,
    newscomment,
    users,
    newsfeed
    WHERE comments.id = authorcomment.commentid
    AND authorcomment.authorid = users.id
    AND comments.id = newscomment.commentid
    AND newscomment.newsfeedid = newsfeed.id
    AND newsfeed.id = :newsid
    ORDER BY comments.`date`
    LIMIT :limit
    ');
$comment->execute(array(
  'newsid' => $publication['newsfeedid'],
  'limit' => $_SESSION['commentUnfold'][$publication['newsfeedid']]
  ));
$nbrDisplayComment=$comment->rowCount();
$row = $comment->fetch();
$countComment = $db->prepare('
    SELECT comments.content,
    newsfeed.id,
    lastname,
    firstname,
    authorid,
    comments.date,
    users.profile_pic,
    comments.id
    FROM comments,
    authorcomment,
    newscomment,
    users,
    newsfeed
    WHERE comments.id = authorcomment.commentid
    AND authorcomment.authorid = users.id
    AND comments.id = newscomment.commentid
    AND newscomment.newsfeedid = newsfeed.id
    AND newsfeed.id = :newsid
    ');
$countComment->execute(array('newsid' => $publication['newsfeedid']));
$nbrTotalComment=$countComment->rowCount();
if($nbrDisplayComment > $nbrTotalComment) {
    $nbrDisplayComment=$nbrTotalComment;
}

} catch (PDOException $e) {
  echo '<div class="alert alert-danger">';
  die('Error:'.$e->getMessage());
  echo '</div>';
}

while($row) {
  ?><div class="vignets">

  <?php
  if (!empty($row['profile_pic'])){
    $pic = '/ensisocial/data/avatar/'.$row['profile_pic'];
  } else {
    $pic = '/ensisocial/data/avatar/'.$data['profile_pic'];
  }
  ?>

  <li class="list-group-item">
    <a class="pull-left" href="#">
      <img class="avatar" src=<?php echo $pic; ?> alt="avatar" height="80">
    </a>

    <?php if ($_SESSION['id'] == $row['authorid']): ?>
      <a class="btn btn-default pull-right supprComment" href=<?php echo '"/ensisocial/comment/deletecomment.php?id='.$row['id'].'"'; ?>>
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        Supprimer
      </a>
    <?php endif ?>

    <h4 class="user"><?php echo $row['firstname'].' '.$row['lastname']; ?></h4>
    <h5 class="time"><?php echo $row['date']; ?></h5>
    <p><?php echo $row['content']; ?></p>
  </li>
  </div>
  <?php
  $row=$comment->fetch();
}

?>
