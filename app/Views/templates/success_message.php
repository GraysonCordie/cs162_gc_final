<div class="w3-row">&nbsp;</div>
<div class="w3-container">
    <h2 class="w3-center w3-border-green"><?php echo $message; ?></h2>
    <a href="<?php echo $callback_link; ?>" class="w3-button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
    <?php if($next_link != false) : ?>
        <a href="<?php echo $next_link; ?>" class="w3-button w3-right">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    <?php endif; ?>
</div>
<div class="w3-row">&nbsp;</div>