<?php
//Problem is:
//Populating the form using a foreach loop from the $formFields array
//Field Array reference: $formFields[0] => "firstName"

//We also have to get the values from the $employee object to populate the fields
//during the foreach loop.
//Object reference: $employee->firstName

?>

<form name="update_employee" method="POST">
<div class="w3-container">
    <div class="w3-half" style="margin: 0 auto; width: 50%; border: 2px solid #000;">
        <div class="w3-section"><h3>Employee Information</h3></div>
        <input type="hidden" name="id" value="<?php echo $employee[0]->id; ?>" />
        <?php foreach($employee[0] as $key => $value) :?>
            <?php if($key != 'id') : ?>
                <div class="w3-section">
                    <input class="w3-input" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
                    <label><?php echo ucfirst(strtolower($key)); ?></label>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="w3-section">
            <a href="/employee" class="w3-btn w3-theme">Cancel</a>
            <input class="w3-btn w3-theme" type="submit" name="submit" value="Submit" />
        </div>
    </div>
</div>
</form>