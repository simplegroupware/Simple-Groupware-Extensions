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

}