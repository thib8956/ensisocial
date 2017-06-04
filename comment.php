<?php

$comment = $db->prepare('SELECT comments.content,
       newsfeed.id,
       lastname,
       firstname,
       comments.date
FROM comments,
     authorcomment,
     newscomment,
     users,
     newsfeed
WHERE comments.id=authorcomment.commentid
  AND authorcomment.authorid=users.id
  AND comments.id=newscomment.commentid
  AND newscomment.newsfeedid=newsfeed.id
  AND newsfeed.id = :newsid'
);
$comment->execute(array('newsid' => $res['id']));
$row = $comment->fetch();

if($res['id'] == $row['id']){

    while($row) {
        ?>
        <li class="list-group-item">
            <a class="pull-left" href="#">
                <img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" alt="avatar">
            </a>
            <div class="comment-body">
                <div class="comment-heading">
                    <h4 class="user"><?php echo $row['firstname'].' '.$row['lastname']; ?></h4>
                    <h5 class="time"><?php echo $row['date']; ?></h5>
                </div>
                <p><?php echo $row['content']; ?></p>
            </div>
        </li>
        <?php
        $row=$comment->fetch();
    }
}
?>
