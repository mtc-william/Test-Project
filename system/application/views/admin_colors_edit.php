<h1><?php echo $title;?></h1>

<?php
echo form_open('admin/colors/edit');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=>25, 'value'=>$color['name']);
echo form_input($data) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $color['status']) ."</p>";

echo form_hidden('id',$color['id']);
echo form_submit('submit','update color');
echo form_close();


?>