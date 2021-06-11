
<form name="update_status" method="POST">
<div class="w3-container">
    <div class="w3-half" style="margin: 0 auto; border: 2px solid #000;">
        <div class="w3-section"><h3>Order Status</h3></div>
        <input name="order_id" value="<?php echo $order[0]->order_id; ?>" />
        <label>Order ID: The order you want to change</label>
                <div class="w3-section">
                    <input class="w3-input" name="order_status" value="<?php echo $order[0]->order_status; ?>" />
                    <label>Status: Type new status and Submit</label>
                </div>
        <div class="w3-section">
            <a href="/order/view" class="w3-btn w3-theme">Cancel</a>
            <input class="w3-btn w3-theme" type="submit" name="submit" value="Submit" />
        </div>
    </div>
</div>
</form>