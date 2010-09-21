<h1><?php echo $title;?></h1>
<p><?php echo anchor("admin/products/create", "Create new product");?> | <?php echo anchor("admin/products/export","Export");?></p> 

<?php
echo form_open_multipart("admin/products/import");
$data = array('name' => 'csvfile', 'size'=>15);
echo form_upload($data);
echo form_hidden('csvinit',true);
echo form_submit('submit','IMPORT');
echo form_close();
?>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($products)){
	echo form_open("admin/products/batchmode");
	echo "<p>Category: ". form_dropdown('category_id',$categories);
	echo "&nbsp;";
	$data = array('name'=>'grouping','size'=>'10');
	echo "Grouping: ". form_input($data);
	echo form_submit("submit","batch update");
	echo "</p>";
	echo "<table border='1' cellspacing='0' cellpadding='3' width='500'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>&nbsp;</th><th>ID</th>\n<th>Name</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($products as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td align='center'>".form_checkbox('p_id[]',$list['id'],FALSE)."</td>";
		echo "<td>".$list['id']."</td>\n";
		echo "<td>".$list['name']."</td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/products/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/products/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
	echo form_close();
}
?>