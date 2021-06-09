<?= \Config\Services::validation()->listErrors() ?>
<form name="new_customer" method="POST">
<div class="w3-container">
    <div class="w3-half" style="margin: 0 auto; border: 2px solid #000;">
        <div class="w3-section"><h3>Enter Your (Customer) Information</h3></div>
        <?php foreach($formFields as $field) :?>
            <?php if($field != 'customer_id' and $field != 'shipment_address') : ?>
                <div class="w3-section">
                    <input class="w3-input" name="<?php echo $field; ?>" />
                    <label><?php echo ucfirst(strtolower($field)); ?></label>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="w3-section">
            <input class="w3-btn w3-theme" type="submit" name="submit" value="Submit" />
        </div>
    </div>
</div>
</form>