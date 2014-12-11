<?php

echo $this->session->flashdata('created');

echo validation_errors();

echo form_open('members/new_member');
echo '<p>';
	echo form_label('Registration No: ','reg_no');
		echo form_input($reg_no);
echo '</p>';
echo '<p>';
	echo form_label('Email: ','email');
		echo form_input($email);
echo '</p>';
echo '<p>';
	echo form_label('Surname: ','surname');
		echo form_input($surname);
echo '</p>';
echo '<p>';
	echo form_label('Other names: ','other_names');
		echo form_input($other_names);
echo '</p>';
echo '<p>';
	echo form_label('Phone Number: ','phone');
		echo form_input($phone);
echo '</p>';
echo '<p>';
	echo form_label('Course: ','course');
		echo form_input($course);
echo '</p>';
echo form_submit('submit','submit');
echo form_close();







/*End of file: create.php*/
/*Location: application/views/members/create.php*/
?>