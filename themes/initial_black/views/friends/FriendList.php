<?php
    /* @var $this FriendsController */

    $this->pageTitle .= Yii::t('friends', 'Friends');

?>
<h1><?php echo Yii::t('friends', 'Friends')?></h1>

<p>

    <div class="friend_list">

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

        ?>
        <?php

        $this->widget('CLinkPager',array(
            'pages'=>$pages,
            'maxButtonCount' => 1,
            'cssFile'=>'',
        ));


        if(!empty($friends))
            foreach($friends as $key=>$friend)
            {
                $this->renderPartial('_friend',array(
                    'friend'=>$friend,
                ));
            }
        else
            echo Yii::t('friends', 'You don\'t have friends yet');

        ?>
    </div>
</p>
