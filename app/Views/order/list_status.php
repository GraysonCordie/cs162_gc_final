<div class="w3-row">&nbsp;</div>
<div>Statuses:</div>
<?php foreach($statuses as $status) : ?>
<div class="w3-container">
    <?php 
        echo ( 
            $status->name 
            .": ". $status->department
            ." | ". $status->description 
        ); 
    ?>
</div>
<?php endforeach; ?>