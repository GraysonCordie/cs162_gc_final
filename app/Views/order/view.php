<div class="w3-row">&nbsp;</div>
<?php foreach($orders as $order) : ?>
<div class="w3-container">
    <?php 
        echo ( 
            "Order ID:".$order->order_id 
            .", Customer ID: ".$order->customer_id 
            . "| Date: " . $order->order_date
            . " | Paid: " . $order->paid
            . ", Status: " . $order->order_status
            . " | "
            ."<a href='/order/updateStatus/".$order->order_id ."'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>"
            //. " <a href='$order/delete/".$order->order_id ."'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></i></a>"
        ); 
    ?>
</div>
<?php endforeach; ?>