<h1><?php echo $title;?></h1>

<?php
echo form_open('admin/sizes/edit');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=>25, 'value'=>$size['name']);
echo form_input($data) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $size['status']) ."</p>";

echo form_hidden('id',$size['id']);
echo form_submit('submit','update size');
echo form_close();


?>