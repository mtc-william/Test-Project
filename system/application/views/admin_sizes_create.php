<h1><?php echo $title;?></h1>

<?php
echo form_open('admin/sizes/create');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=>25);
echo form_input($data) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</p>";

echo form_submit('submit','create size');
echo form_close();
?>