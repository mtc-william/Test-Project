<h1><?php echo $title;?></h1>

<?php
echo form_open_multipart('admin/products/create');

echo "<p><label for='parent'>Category</label><br/>";
echo form_dropdown('category_id',$categories) ."</p>";


echo "<p><label for='pname'>Name</label><br/>";
$data = array('name'=>'name','id'=>'pname','size'=>25);
echo form_input($data) ."</p>";

echo "<p><label for='short'>Short Description</label><br/>";
$data = array('name'=>'shortdesc','id'=>'short','size'=>40);
echo form_input($data) ."</p>";

echo "<p><label for='long'>Long Description</label><br/>";
$data = array('name'=>'longdesc','id'=>'long','rows'=>5, 'cols'=>'40');
echo form_textarea($data) ."</p>";


echo "<p><label for='uimage'>Upload Image</label><br/>";
$data = array('name'=>'image','id'=>'uimage');
echo form_upload($data) ."</p>";

echo "<p><label for='uthumb'>Upload Thumbnail</label><br/>";
$data = array('name'=>'thumbnail','id'=>'uthumb');
echo form_upload($data) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</p>";


echo "<p><label for='group'>Grouping</label><br/>";
$data = array('name'=>'grouping','id'=>'group','size'=>10);
echo form_input($data) ."</p>";

echo "<p><label for='price'>Price</label><br/>";
$data = array('name'=>'price','id'=>'price','size'=>10);
echo form_input($data) ."</p>";

echo "<p><label for='featured'>Featured?</label><br/>";
$options = array('true' => 'true', 'false' => 'false');
echo form_dropdown('featured',$options) ."</p>";

echo form_fieldset('Colors');
foreach ($colors as $key => $value){
	echo form_checkbox('colors[]', $key, FALSE). $value;
}
echo form_fieldset_close(); 

echo form_fieldset('Sizes');
foreach ($sizes as $key => $value){
	echo form_checkbox('sizes[]', $key, FALSE). $value;
}
echo form_fieldset_close(); 

echo form_submit('submit','create product');
echo form_close();


?>