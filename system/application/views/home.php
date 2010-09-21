<div id='pleft'>
<?php
  echo "<img src='".$mainf['image']."' border='0' align='left'/>\n";
  echo "<h2>".$mainf['name']."</h2>\n";
  echo "<p>".$mainf['shortdesc'] . "<br/>\n";
  echo anchor('welcome/product/'.$mainf['id'],'see details') . "<br/>\n";
  echo anchor('welcome/cart/'.$mainf['id'],'add to cart') . "</p>\n";
?>

<br style='clear:both'><br/>
<?php
if ($this->session->flashdata('subscribe_msg')){
	echo "<div class='message'>";
	echo $this->session->flashdata('subscribe_msg');
	echo "</div>";
}
echo form_open("welcome/subscribe");
echo form_fieldset('Subscribe To Our Newsletter');
$data = array('name'=>'name', 'id' => 'name','size'=>'25');
echo "<p><label for='name'>Name</label><br/>";
echo form_input($data) . "</p>";
$data = array('name'=>'email', 'id' => 'email', 'size'=>'25');
echo "<p><label for='email'>Email</label><br/>";
echo form_input($data) . "</p>";
echo form_submit("submit","subscribe");
echo form_fieldset_close();
echo form_close();
?>


</div>

<div id='pright'>
<?php
  foreach ($sidef as $key => $list){
    echo "<div class='productlisting'><img src='".$list['thumbnail']."' border='0' class='thumbnail'/>\n";
    echo "<h4>".$list['name']."</h4>\n";
    echo anchor('welcome/product/'.$list['id'],'see details') . "<br/>\n";
    echo anchor('welcome/cart/'.$list['id'],'add to cart') . "\n</div>";
  }
?>


</div>