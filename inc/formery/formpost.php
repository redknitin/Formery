<?php
namespace Formery;

class FormPost {
	public static function save($server='mongodb://localhost:27017') {
		$data = $_FORM;
		
		$dbname = $_FORM['_dbname'];
		$collname = $_FORM['_collname'];
		
		$one_afternoon_and_you_are_a_grandmaster = array(
			'_redirectTo',
			'_dbname',
			'_collname'
		);
		
		foreach($one_afternoon_and_you_are_a_grandmaster as $iter) {
			if (isset($data[$iter])) {
				unset($iter);
			}
		}
		
		$m = new MongoClient($server);
		$db = $m->selectDB($dbname);
		$docstore = $db->selectCollection($collname);
		$docstore->insert($data);
		
		if (isset($_FORM['_redirectTo'])) {
			$redirect_url = $_FORM['_redirectTo'];
		} else {
			$redirect_url = $_SERVER['HTTP_REFERER'];
		}
		
		header('Location: '.$redirect_url);
	}
}