<div class="w3-row">&nbsp;</div>
<?php foreach($customers as $customer) : ?>
<div class="w3-container">
    <?php 
        echo ( 
            $customer->customer_id 
            .": ". $customer->first_name 
            . " " . $customer->last_name
            . " | " . $customer->email
            //. "<a href='$customer/update/".$customer->customer_id ."'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>"
            //. " <a href='$customer/delete/".$customer->customer_id ."'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></i></a>"
        ); 
    ?>
</div>
<?php endforeach; ?>