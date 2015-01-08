<?php
namespace Formery;

class AttributeHelper {
	public static function attrib_if_set($attrib, $val, $echo=FALSE) {
		if (isset($attrib) && $attrib!=null && ($attrib=trim($attrib))!='')
		if (isset($val) && $val!=null && ($val=trim($val))!='') {
			$retval = " $attrib=\"$val\"";
			if ($echo) echo $retval;
			else return $retval;
		}
	}
}