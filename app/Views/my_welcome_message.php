<style>
    .myDiv{
        border: 2px solid #000;
        padding: 10px;
    }

    .alert{
        color: red;
    }

    .employee{
        border: 2px solid red;
        padding: 10px;
    }
</style>

<div class="myDiv<?php if($alert) { echo " alert"; } ?>">
    <?php echo $page_title; ?>
</div>

<div class="w3-container w3-center">
    <h3>Column Fields Names</h3>
    <?php foreach($employeeFields as $field) : ?>
    <div class="w3-quarter w3-card"><?php echo $field; ?></div>
    <?php endforeach; ?>
</div>

