<?php
echo $this->tinyMce;
if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}

echo form_open('admin/subscribers/sendemail');

echo "<p><label for='subject'>Subject</label><br/>";
$data = array('name' => 'subject', 'id' => 'subject', 'size' => 50, 'value'=>$subject);
echo form_input($data);
echo "</p>";

echo "<p><label for='message'>Message</label><br/>";
$data = array('name' => 'message', 'id' => 'message', 'rows' => 20, 'cols' => 50, 'value'=>$msg);
echo form_textarea($data);
echo "</p>";

echo "<p>".form_checkbox('test', 'true', TRUE) . " <b>This is a test!</b></p>";
echo form_submit('submit','send email');
echo form_close();
?>