<h1><?php echo $title;?></h1>

<?php
echo form_open_multipart('admin/products/edit');

echo "<p><label for='parent'>Category</label><br/>";
echo form_dropdown('category_id',$categories,$product['category_id']) ."</p>";

echo "<p><label for='pname'>Name</label><br/>";
$data = array('name'=>'name','id'=>'pname','size'=>25, 'value' => $product['name']);
echo form_input($data) ."</p>";

echo "<p><label for='short'>Short Description</label><br/>";
$data = array('name'=>'shortdesc','id'=>'short','size'=>40, 'value' => $product['shortdesc']);
echo form_input($data) ."</p>";

echo "<p><label for='long'>Long Description</label><br/>";
$data = array('name'=>'longdesc','id'=>'long','rows'=>5, 'cols'=>'40', 'value' => $product['longdesc']);
echo form_textarea($data) ."</p>";


echo "<p><label for='uimage'>Upload Image</label><br/>";
$data = array('name'=>'image','id'=>'uimage');
echo form_upload($data) ."<br/>Current image: ". $product['image']."</p>";

echo "<p><label for='uthumb'>Upload Thumbnail</label><br/>";
$data = array('name'=>'thumbnail','id'=>'uthumb');
echo form_upload($data) ."<br/>Current thumbnail: ". $product['thumbnail']."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $product['status']) ."</p>";


echo "<p><label for='group'>Grouping</label><br/>";
$data = array('name'=>'grouping','id'=>'group','size'=>10, 'value' => $product['grouping']);
echo form_input($data) ."</p>";

echo "<p><label for='price'>Price</label><br/>";
$data = array('name'=>'price','id'=>'price','size'=>10, 'value' => $product['price']);
echo form_input($data) ."</p>";

echo "<p><label for='featured'>Featured?</label><br/>";
$options = array('true' => 'true', 'false' => 'false');
echo form_dropdown('featured',$options, $product['featured']) ."</p>";

echo form_fieldset('Colors');
foreach ($colors as $key => $value){
	if (in_array($key,$assigned_colors)){
		$checked = TRUE;
	}else{
		$checked = FALSE;
	}
	echo form_checkbox('colors[]', $key, $checked). $value;
}
echo form_fieldset_close(); 

echo form_fieldset('Sizes');
foreach ($sizes as $key => $value){
	if (in_array($key,$assigned_sizes)){
		$checked = TRUE;
	}else{
		$checked = FALSE;
	}
	echo form_checkbox('sizes[]', $key, $checked). $value;
}
echo form_fieldset_close(); 

echo form_hidden('id',$product['id']);
echo form_submit('submit','update product');
echo form_close();


?>