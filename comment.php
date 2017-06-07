<?php

try {
  $comment = $db->prepare('
    SELECT comments.content,
    newsfeed.id,
    lastname,
    firstname,
    comments.date,
    users.profile_pic
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
    ');
  $comment->execute(array('newsid' => $publication['newsfeedid']));
  $row = $comment->fetch();

} catch (PDOException $e) {
  echo '<div class="alert alert-danger">';
  die('Error:'.$e->getMessage());
  echo '</div>';
}

while($row) {
  ?>

  <?php
  if (!empty($row['profile_pic'])){
    $pic = '/ensisocial/data/avatar/'.$row['profile_pic'];
  } else {
    $pic = '/ensisocial/data/avatar/'.$data['profile_pic'];
  }
  ?>

  <li class="list-group-item">
    <a class="pull-left" href="#">
      <img class="avatar" src=<?php echo $pic; ?> alt="avatar" height="80px">
    </a>

    <h4 class="user"><?php echo $row['firstname'].' '.$row['lastname']; ?></h4>
    <h5 class="time"><?php echo $row['date']; ?></h5>
    <p><?php echo $row['content']; ?></p>
  </li>
  <?php
  $row=$comment->fetch();
}

?>
