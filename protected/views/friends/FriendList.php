<?php
/* @var $this FriendsController */

    $this->breadcrumbs=array(
        Yii::t('friends', 'Friends')=>array('/friends'),
    );

    $this->pageTitle .= Yii::t('friends', 'Friends');

?>
<h1><?php echo Yii::t('friends', 'Friends')?></h1>

<p>

    <?php

    if(!empty($requests))
        echo '<h5>'.Yii::t('friends', 'Incomming requests').'</h5>';

    if(!empty($requests))
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

        if(!empty($friends))
            foreach($friends as $key=>$friend)
            {
                $this->renderPartial('_friend',array(
                    'friend'=>$friend,
                ));
                echo '<hr/>';
            }
        else
            echo Yii::t('friends', 'You don\'t have friends yet');

    ?>
</p>
