<div class="message">
    <?php

    if($message->sender == $user->id)
        $this->renderPartial('_message_user',array(
            'author'=>$user,
            'message'=>$message
        ));
    else
        $this->renderPartial('_message_friend',array(
            'author'=>$friend,
            'message'=>$message
        ));
    ?>
</div>