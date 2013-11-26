<?php
/* @var $this FriendsController */

$lang = new Language;

$this->breadcrumbs=array(
    Yii::t('friends', 'Friends')=>array('/friends'),
);
?>
<h1><?php echo Yii::t('friends', 'Friends')?></h1>

<p>

    <?php

    if(!empty($requests))
        echo '<h5>'.Yii::t('friends', 'Incomming requests').'</h5>';

    foreach($requests as $key=>$friend)
    {
        $this->renderPartial('_friend_incomming',array(
            'friend'=>$friend,
        ));
    }

    if(!empty($requests))
        echo '<hr/>';

    ?>
    <?php

        foreach($friends as $key=>$friend)
        {
            $this->renderPartial('_friend',array(
                'friend'=>$friend,
            ));
            echo '<hr/>';
        }

    ?>
</p>
