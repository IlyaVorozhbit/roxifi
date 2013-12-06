<div class="invite">
    <div class="event_name">
        <a href="/events/<?php echo $invite->event;?>"><?php echo Events::model()->findByPk($invite->event)->name;?></a>
    </div>
    <div class="buttons">
        <a class="btn btn-mini" href="/events/invites/accept/<?php echo $invite->id;?>"><?php echo Yii::t('events','Accept');?></a>
        <a class="btn btn-mini" href="/events/invites/reject/<?php echo $invite->id;?>"><?php echo Yii::t('events','Reject');?></a>
    </div>
</div>