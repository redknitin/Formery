<?php
namespace Formery;
require 'inc/formery/attribute_helper.php';

class ListTable {
	function listTable($dbname, $collname, $options=array(), $server='mongodb://localhost:27017') {
		
		$table_cssclass = null;
		
		if (isset($options['table_cssclass']) && $options['table_cssclass']!=null && trim($options['table_cssclass'])!='') {
			$table_cssclass = $options['table_cssclass'];
		}
		
		$mkup = '<table'
			.AttributeHelper::attrib_if_set('class', $table_cssclass)
			.'>'.PHP_EOL;

		$m = new MongoClient($server);
		$db = $m->selectDB($dbname);
		$docstore = $db->selectCollection($collname);
		
		$cur = $docstore->find();
		while ($cur->hasNext()) {
			$row = $cur->getNext();
			echo '<tr>'.PHP_EOL;
			foreach($row as $key=>$val) {
				echo "<td>$val</td>".PHP_EOL;
			}
			echo '</tr>'.PHP_EOL;
		}
			
		$mkup .= '</table>'.PHP_EOL;
	}
}