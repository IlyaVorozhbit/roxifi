<div class="event">

    <div class="time">
        <?php echo date('d/m/y',strtotime($event->time)) ?>
    </div>

    <div class="name">
        <a href="/events/<?php echo $event->id;?>"><?php echo $event->name;?></a>.
    </div>

</div>