<div class="mind">

    <div class="time">
        <?php echo $mind->time;?>
    </div>

    <div class="delete_btn">
        <?php
        if($mind->sender == Yii::app()->user->id)
            echo '<a class="btn btn-mini" href="/minds/edit/'.$mind->id.'">'.Yii::t('minds','Edit').'</a>'
        ?>
        <a class="btn btn-mini" href="/minds/delete/<?php echo $mind->id;?>"><?php echo Yii::t('minds','Delete');?></a>
    </div>

    <div class="text">
        <?php echo $mind->text;?>
    </div>


</div>