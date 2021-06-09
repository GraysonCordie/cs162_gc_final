<div class="w3-row">&nbsp;</div>
<?php foreach($employees as $employee) : ?>
<div class="w3-container">
    <?php 
        echo (
            $employee->departmentName 
            .": " . $employee->id 
            ."-". $employee->firstName 
            . " " . $employee->lastName
            . " | "
            . "<a href='/employee/update/".$employee->id ."'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>"
            . " <a href='/employee/delete/".$employee->id ."'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></i></a>"
        ); 
    ?>
</div>
<?php endforeach; ?>