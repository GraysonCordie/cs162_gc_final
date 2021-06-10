<div class="w3-row">&nbsp;</div>
<?php foreach($orders as $order) : ?>
<div class="w3-container">
    <?php 
        echo ( 
            $order->order_id 
            .": ". $order->customer_id 
            . ", " . $order->order_date
            . " | " . $order->paid
            . " : " . $order->order_status
            //. "<a href='$order/update/".$order->order_id ."'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>"
            //. " <a href='$order/delete/".$order->order_id ."'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></i></a>"
        ); 
    ?>
</div>
<?php endforeach; ?>