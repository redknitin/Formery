<?php
namespace Formery;
require 'inc/formery/attribute_helper.php';

class MockTable {
	public $table_cssclass = null;
	public $table_border = 1;
	public $fields = array();
	
	function generate($echo = FALSE) {
		$cssclass = is_array($this->table_cssclass) ? implode(' ', $this->table_cssclass) : $this->table_cssclass;
		
		$mkup = '<table'
			.AttributeHelper::attrib_if_set('class', $cssclass)
			.AttributeHelper::attrib_if_set('border', $this->table_border)
			.'>'.PHP_EOL;

		$mkup .=  '<tr>';
		foreach($this->fields as $iter_field) {
			$mkup .= "<th>$iter_field</th>";
		}
		$mkup .=  '</tr>';
			
		for ($i=0;$i<10;$i++) {
			$mkup .= '<tr>';
			foreach($this->fields as $iter_field) {
				$mkup .= "<td>$iter_field</td>";
			}
			$mkup .= '</tr>';
		}
			
		$mkup .= '</table>'.PHP_EOL;
		
		if ($echo) echo $mkup;
		else return $mkup;
	}
}