
<?php

$comment=$db->query('SELECT comments.content,newsfeed.id,lastname,firstname,comments.date FROM comments,authorcomment,newscomment,users,newsfeed where comments.id=authorcomment.commentid and authorcomment.authorid=users.id and comments.id=newscomment.commentid and newscomment.newsfeedid=newsfeed.id');
$tagueul=$comment->fetch();

if($res['id']==$tagueul['id']){
    ?>
    <div class="input-group">
            <!--Thibaud pas touche!!!-->
        <form action="comment_submit.php" method="post" accept-charset="utf-8">
           <input class="form-control" placeholder="Ajouter votre commentaire" type="text">
        </form>
    </div>
    <ul class="comments-list">
        <?php

        while($tagueul) {
            ?>

            <li class="comment">
                <a class="pull-left" href="#">
                    <img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" alt="avatar">
                </a>
                <div class="comment-body">
                    <div class="comment-heading">
                        <h4 class="user"><?php echo $tagueul['firstname'].$tagueul['lastname']; ?></h4>
                        <h5 class="time"><?php echo $tagueul['date']; ?></h5>
                    </div>
                    <p><?php echo $tagueul['content']; ?></p>
                </div>
            </li>
        </ul>
        <?php
        $tagueul=$comment->fetch();
    }
}
?>
