<h1><?php echo $title;?></h1>
<p><?php echo anchor("admin/subscribers/sendemail", "Create new email");?></p>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($subscribers)){
	echo "<table border='1' cellspacing='0' cellpadding='3' width='400'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Email</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($subscribers as $key => $list){
		echo " <tr valign='top'>\n";
		echo "  <td>".$list['id']."</td>\n";
		echo "  <td>".$list['name']."</td>\n";
		echo "  <td>".$list['email']."</td>\n";
		echo "  <td align='center'>";
		echo anchor('admin/subscribers/delete/'.$list['id'],'unsubscribe');
		echo "</td>\n";
		echo " </tr>\n";
	}
	echo "</table>";
}
?>