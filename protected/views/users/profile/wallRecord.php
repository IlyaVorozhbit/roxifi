<div class="record">

    <div class="author">
        <a href="/profile/<?php echo $record->user_from;?>"><?php echo $authors[$record->user_from]->login;?></a>, <!--сегодня в--> <?php echo $record->time;?>.
    </div>

    <div class="message">
        <?php echo $record->text;?>
    </div>
</div>