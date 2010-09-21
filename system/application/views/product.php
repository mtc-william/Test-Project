<div id='pleft'>

<?php
if ($this->session->flashdata('conf_msg')){ //change!
	echo "<div class='message'>";
	echo $this->session->flashdata('conf_msg');
	echo "</div>";
}
?>
<?php
  echo "<img src='".$product['image']."' border='0' align='left'/>\n";
  echo "<h2>".$product['name']."</h2>\n";
  echo "<p>".$product['longdesc'] . "<br/>\n";
  echo "Colors: ";
  foreach ($assigned_colors as $value){
  	echo $colors[$value] . "&nbsp;";
  }
  echo "<br/>";
  echo "Sizes: ";
  foreach ($assigned_sizes as $value){
  	echo $sizes[$value] . "&nbsp;";
  }  
  echo "<br/>";
  echo anchor('welcome/cart/'.$product['id'],'add to cart') . "</p>\n";
?>
</div>


<div id='pright'>
<?php
  foreach ($grouplist as $key => $list){
    echo "<div class='productlisting'><img src='".$list['thumbnail']."' border='0' class='thumbnail'/>\n";
    echo "<h4>".$list['name']."</h4>\n";
    echo anchor('welcome/product/'.$list['id'],'see details') . "<br/>\n";
    echo anchor('welcome/cart/'.$list['id'],'add to cart') . "\n</div>";
  }
?>
</div>