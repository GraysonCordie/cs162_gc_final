<?= \Config\Services::validation()->listErrors() ?>
<form name="new_order" method="POST">
<div class="w3-container">
    <div class="w3-half" style="margin: 0 auto; border: 2px solid #000;">
        <div class="w3-section"><h3>Enter Some Information</h3></div>
                <div class="w3-section">
                    <input class="w3-input" name="customer_id" value='<?php echo($custid) ?>' />
                    <label>Customer ID</label>
                </div>
        <div class="w3-section">
            <input class="w3-btn w3-theme" type="submit" name="submit" value="Submit" />
        </div>
    </div>
</div>
</form>