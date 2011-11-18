<?php
// GPL

class compose_html {

static function replymessage($value,$args,$data) {
  if ($value!="") {
	$value = "<blockquote style='border-left:1px solid #808080; margin-left:10px; padding-left:10px;'>".$value."</blockquote>";
    if (!empty($data["efrom"]["data"][0]) and !empty($data["created"])) {
	  $value = modify::dateformat($data["created"],array("","{t}m/d/Y{/t}")).", ".$data["efrom"]["data"][0].":<br>".$value;
    }
	$value = "<br><br>".$value;
  }
  if (isset($_REQUEST["return_receipt"])) $value = sprintf("{t}Your message was read on %s.{/t}",sys_date("r")).$value;
  return $value;
}

static function forwardmessage($value,$args,$data) {
  $header = modify::forwardmessage("",$args,$data);
  $header = str_replace("\n\n\n", "\n\n", $header);
  return nl2br(htmlspecialchars($header, ENT_QUOTES)).$value;
}

static function createemail($id, $data) {
  if (empty($data["message"]) and !empty($data["message_html"])) {
	$message = modify::htmlmessage($data["message_html"]);
	db_update("simple_emails",array("message"=>$message),array("id=@id@"),array("id"=>$id));
  }
  return "";
}

static function htmlfield($text) {
  $badtags = array("applet","area","base","body","button","embed","form","frame","frameset","head",
    "html","input","link","map","meta","object","script","select","style","textarea","title","!doctype","iframe");
  $text = str_replace(chr(0),"",$text); // remove null-byte vulnerability
  $text = preg_replace(array("|<head[^>]*?>.*?</head>|si","|<script[^>]*?>.*?</script>|si","|<style[^>]*?>.*?</style>|si","|<!--.*?-->|si"),"",$text);
  $text = explode("<"," ".$text);
  $result = array_shift($text);
  foreach ($text as $v) {
    $v = explode(">",$v);
    $bad_tag = false;
	$tag_new = "";
    $tag_arr = explode(" ",trim(str_replace(array("\t","(")," ",$v[0])));
	foreach ($tag_arr as $key=>$item_str) {
	  $item = explode("=", $item_str, 2);
	  $item[0] = strtolower($item[0]);
	  if (strlen($item[0])!=0 and $item[0][0]=="/") $item[0] = substr($item[0],1);
	  if (preg_match("/^(\?|on|mce|background\$)/",$item[0])) continue;
	  if (!empty($item[1]) and stripos($item[1],"javascript:")) continue;
	  if ($key==0 and in_array($item[0],$badtags)) {
	    $bad_tag = true;
		break;
	  } else $tag_new .= " ".$item_str;
	}
	if (!$bad_tag) $result .= "<".trim($tag_new).">";
	if (!empty($v[1])) $result .= $v[1];
  }
  return $result;
}

}