<?php
/* @var $this FriendsController */

$this->breadcrumbs=array(
	'Друзья'=>array('/friends'),
);
?>
<h1>Друзья</h1>

<p>
    <?php

        foreach($friends as $key=>$friend)
        {
            $this->renderPartial('_friend',array(
                'friend'=>$friend
            ));
        }

    ?>
</p>
