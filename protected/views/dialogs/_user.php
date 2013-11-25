<?php

    $messages_count = Messages::model()->count('recipient='.Yii::app()->user->id.' and dialog = '.$dialog->id.'');

    if($messages_count>0)
        $dialogs_label = ' ('.$messages_count.')';

?>

<a class="btn" href="/dialogs/view/<?php echo $dialog->id;?>">
    <?php echo $user->login.' '.$dialogs_label?>
</a>

<hr/>