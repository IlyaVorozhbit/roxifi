<div class="friend">
    <?php if ($message->status==0) echo '<span class="label">new</span>';?>
    <a href="/u<?php echo $author->id;?>"><?php echo $author->login;?></a> <?php echo $message->time;?> <br>
    <?php echo $message->text;?>
    <div align="right">
        <?php /*<a href="/dialogs/deletemessage/<?php echo $message->id;?>"><i class="icon-trash"></i></a>*/?>
    </div>
</div>