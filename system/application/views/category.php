<div id='pleft'>	
<?php
  echo "<h2>".$category['name']."</h2>\n";
  echo "<p>".$category['shortdesc'] . "</p>\n";
  
  foreach ($listing as $key => $list){
    echo "<div class='productlisting'><img src='".$list['thumbnail']."' border='0' class='thumbnail'/>\n";
    echo "<h4>";

		switch($level){
			case "1":
			echo anchor('welcome/cat/'.$list['id'],$list['name']);
			break;
			
			case "2":
			echo anchor('welcome/product/'.$list['id'],$list['name']);
			break;
		}
    echo "</h4>\n";
    echo $list['shortdesc'].
    	"<br/>" . anchor('welcome/cart/'.$list['id'],'add to cart').
		"</div>";	
  }
?>
</div>