<h1><?php echo $title;?></h1>
<p><?php echo anchor("admin/admins/create", "Create new user");?>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($admins)){
	echo "<table border='1' cellspacing='0' cellpadding='3' width='400'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Username</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($admins as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td>".$list['id']."</td>\n";
		echo "<td>".$list['username']."</td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/admins/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/admins/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
}
?>