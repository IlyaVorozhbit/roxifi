<?php
  $lang = new Language;
  preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s(\d{2}):(\d{2}):(\d{2})$/', $comment->time, $arr);
  $time = ($lang->lang == 'ru' ? $arr[3].'.'.$arr[2] : $arr[2].'.'.$arr[3]) .'.'.$arr[1].' '.$arr[4].':'.$arr[5].':'.$arr[6];
  $user = Users::model()->findByPk($comment->user);
  $avatar = UsersImages::model()->find('user = :user', array('user'=>$comment->user));
  $profile_image =  $avatar !== NULL ? '/avatars/u'.$comment->user.'/'.$avatar->filename : '/images/no_avatar.png';
?>
<div class="comment">
  <div class="user_status">
    <?php
    if (time()-strtotime($user->last_update) < 120)
        echo '<div class="online"></div>';
    else
        echo '<div class="offline"></div>';
    ?>
  </div>
  <div class="comment_avatar">
    <a href='/u<?php echo $comment->user;?>'><img style="width: 100px; height: 100px; border: 1px solid #E7E7E7;" src='<?php echo $profile_image;?>'></a>
  </div>
  <div class="comment_right_block">
    <div class="comment_username">
        <a href="/u<?php echo $comment->user;?>"><?php echo $user->name.' '.$user->surname;?></a>, <!--сегодня в--> <?php echo $time;?>.
    </div>
    <div class="text">
        <?php echo $comment->text;
          $blog = BlogsMessages::model()->findByPk($comment->blog_message);
          echo ($comment->user == Yii::app()->user->id || $blog->user == Yii::app()->user->id) ?
            '<a href="/blog/message/'.$comment->blog_message.'?comment_id='.$comment->id.'&delete"><img style="height: 30px; width: 30px;" src="/images/delete.png" align="right"/></a>' : '';
        ?>
    </div>
  </div>
</div>
