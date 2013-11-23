<?php
/* @var $this FriendsController */

$lang = new Language;

$this->breadcrumbs=array(
    $lang->Translate(19)=>array('/friends'),
);
?>
<h1><?php echo $lang->Translate(19)?></h1>

<p>

    <?php

    if(!empty($requests))
        echo '<h5>'.$lang->Translate(30).'</h5>';

    foreach($requests as $key=>$friend)
    {
        $this->renderPartial('_friend_incomming',array(
            'friend'=>$friend
        ));
    }

    if(!empty($requests))
        echo '<hr/>';

    ?>
    <?php

        foreach($friends as $key=>$friend)
        {
            $this->renderPartial('_friend',array(
                'friend'=>$friend
            ));
        }

    ?>
</p>
