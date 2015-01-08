<?php
namespace Formery;
require 'inc/formery/attribute_helper.php';

class Form {
	public $method = 'post';
	public $action = '';
	public $form_cssclass = null;
	public $fields = array();
	public $show_placeholder = TRUE;
	public $show_label = TRUE;
	public $submit_text = 'Register';
	
	public static function the_style_labelsubmit_block() {
		echo <<<EOS1
<style>
label, input[type~=submit] {display: block;}
</style>
EOS1;
	}

	private function field($field_spec, $echo=FALSE) {
		if (strpos($field_spec, '::') !== FALSE) {
			$tmp_arr = explode('::', $field_spec);
			if (count($tmp_arr)>0) $name=$tmp_arr[0];
			if (count($tmp_arr)>1) $type=$tmp_arr[1];
			if (count($tmp_arr)>2) $default=$tmp_arr[2];
		} else {
			$name = $field_spec;
		}
		
		if (!(isset($type) && $type!=null && ($type=trim($type))!='')) $type='text';
		if (!(isset($default) && $default!=null && ($default=trim($default))!='')) $default=NULL;
		
		if (strpos($name, '@') !== FALSE) {
			$placeholder = substr($name, strpos($name, '@')+1);
			$name = substr($name, 0, strpos($name, '@'));
		} else $placeholder = null;
		
		if (strpos($type, 'select@') === 0) {
			$lov_arr=explode(',', substr($type, count('select@')));
			$retval = ''
				.($this->show_label?'<label>'.($placeholder==NULL?$name:$placeholder).'</label>':'')
				.'<select name="'.$name.'">'.PHP_EOL;
			foreach($lov_arr as $lov_iter) {
				if (strpos($lov_iter, '|') !== FALSE) {
					$lov_iter_parts = explode('|', $lov_iter);
					$option_val = $lov_iter_parts[0];
					$option_txt = $lov_iter_parts[1];
				} else {
					$option_txt = $option_val = $lov_iter;
				}
				$retval .= "<option value=\"$option_val\">$option_txt</option>".PHP_EOL;
			}
			$retval .= '</select>'.PHP_EOL;
		} else {	
			$retval = ''
				.($this->show_label?'<label>'.($placeholder==NULL?$name:$placeholder).'</label>':'')
				.'<input type="text"'
				.AttributeHelper::attrib_if_set('name', $name)
				.AttributeHelper::attrib_if_set('type', $type)
				.AttributeHelper::attrib_if_set('value', $default)
				.($this->show_placeholder?AttributeHelper::attrib_if_set('placeholder', $placeholder):'')
				.'>'.PHP_EOL;
		}
		
		if ($echo) echo $retval;
		else return $retval;
	}
	
	public function generate($echo=FALSE) {
		$cssclass = is_array($this->form_cssclass) ? implode(' ', $this->form_cssclass) : $this->form_cssclass;
		$mkup = '<form'
			.AttributeHelper::attrib_if_set('method', $this->method)
			.AttributeHelper::attrib_if_set('action', $this->action)
			.AttributeHelper::attrib_if_set('class', $cssclass)
			.'>'.PHP_EOL;
		foreach($this->fields as $iter_field) {
			$mkup .= $this->field($iter_field);
		}
		$mkup .= '<input type="submit" value="'.$this->submit_text.'">'.PHP_EOL;
		$mkup .= '</form>'.PHP_EOL;
		
		if ($echo) echo $mkup;
		else return $mkup;
	}
}