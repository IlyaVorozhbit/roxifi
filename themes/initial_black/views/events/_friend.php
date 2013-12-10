<div class="friend">
    <div class="avatar">

    </div>

    <div class="name">
        <?php
            if(Events::isMemberOrInvited($friend->id,$event->id))
                echo $friend->name.' '.$friend->surname.'. Пользователь приглашен';
            else
                echo '<a href="/event/invite/e'.$event->id.'/u'.$friend->id.'">'.CHtml::encode($friend->name).' '.CHtml::encode($friend->surname);'?></a>';
        ?>
    </div>


</div>