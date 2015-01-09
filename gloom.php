<?php
$m = new MongoClient();

// $ntt = [
	// 'name' => 'Rowan Atkinson',
	// 'best_known_for' => 'Mr. Bean'
	// ];

// $m->grande->celebrity->insert($ntt);

//echo 'Saved';

//header('Content-Type: text/plain');
$cur = $m->grande->celebrity->find();

echo '<table border="1">';
while($cur->hasNext()) {
	$row=$cur->getNext();
	echo '<tr>';
	foreach($row as $key=>$val) {
		if ($key=='_id') continue;
		echo "<td>$val</td>";
	}
	echo '</tr>';
}
echo '</table>';

echo 'Done!!';