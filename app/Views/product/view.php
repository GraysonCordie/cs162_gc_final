<div class="w3-row">&nbsp;</div>
<div>Products:</div>
<?php foreach($products as $product) : ?>
<div class="w3-container">
    <?php 
        echo ( 
            $product->product_name 
            .": ". $product->description 
        ); 
    ?>
</div>
<?php endforeach; ?>