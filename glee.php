<!doctype html><html>
<?php require 'inc/formery/form.php'; ?>
<head>
<title></title>
<?php \Formery\Form::the_style_labelsubmit_block(); ?>
</head>
<body>
<?php
	$frm = new \Formery\Form;
	$frm->fields = array(
		'name@Name',
		'dob@Date of Birth::datetime-local',
		'gender@Sex::select@M|Male,F|Female::M',
		'email@Email::email',
		'phone@Mobile::tel',
		'password@Password::password',
		'confirm@Repeat Password::password'
	);
	$frm->generate(TRUE);
?>
</body></html>