<h1><?php echo $title;?></h1>
<p><?php echo anchor("admin/pages/create", "Create new page");?></p>
<?php
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

if (count($pages)){
	echo "<table border='1' cellspacing='0' cellpadding='3' width='600'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Full Path</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($pages as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td>".$list['id']."</td>\n";
		echo "<td>".$list['name']."</td>\n";
		echo "<td>";
   		if (!preg_match("/\.html$/",$list['path'])){
  			$list['path'] .= ".html";
  		}		
		
		if ($list['category_id'] == 0){
			echo "/". $list['path'];
		}else{
			echo "/". $cats[$list['category_id']]. "/". $list['path'];
		}
		echo "</td>";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/pages/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/pages/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
}
?>