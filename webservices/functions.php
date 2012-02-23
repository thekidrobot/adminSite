<?php

//Custom JSON encoder, for displaying the special chars.
//Taken from : http://www.php.net/manual/en/function.json-encode.php#104278
//Modified by me. 

function my_json_encode($in) {
  
  $out = "";
  if (is_object($in)) {
    $class_vars = get_object_vars(($in));
    $arr = array();
    foreach ($class_vars as $key => $val) {
      $arr[$key] = "\"{$key}\":\"{$val}\"";
    }
    $val = implode(',', $arr);
    $out .= "{{$val}}";
  }elseif (is_array($in)) {
    $obj = false;
    $arr = array();
    foreach($in AS $key => $val) {
      if(!is_numeric($key)) {
        $obj = true;
      }
      $arr[$key] = my_json_encode($val);
    }
    if($obj) {
      foreach($arr AS $key => $val) {
        $arr[$key] = "\"{$key}\":{$val}";
      }
      $val = implode(',', $arr);
      $out .= "{{$val}}";
    }else {
      $val = implode(',', $arr);
      $out .= "[{$val}]";
    }
  }elseif (is_bool($in)) {
    $out .= $in ? 'true' : 'false';
  }elseif (is_null($in)) {
    $out .= 'null';
  }elseif (is_string($in)) {
    $out .= "\"{$in}\"";
  }else {
    $out .= $in;
  }
  return "{$out}";
} 


//Safely escape values. Please use in your SQL queries. 
function escape_value($value)
{
  if(function_exists('mysql_real_escape_string'))
  {
    if(get_magic_quotes_gpc())
    { 
      $value = stripslashes($value); 
		}
		$value = mysql_real_escape_string($value);
	}
  else
  {
    if(!get_magic_quotes_gpc())
    { 
      $value = addslashes($value); 
    }
  }
  return $value;
}

?>