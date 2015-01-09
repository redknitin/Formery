<!doctype html><html>
<?php require 'inc/formery/mock_table.php'; ?>
<head>
<title></title>
</head>
<body>
<?php
	$tab = new \Formery\MockTable;
	$tab->fields = array(
		'ID',
		'Job Title',
		'Positions',
		'Closing Date',
	);
	$tab->generate(TRUE);
?>
</body></html>