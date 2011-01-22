<?php
// GPL

/**
 * Example PHP class for custom functions
 * 
 * default error reporting: E_ALL ^ E_NOTICE
 */
class example {


  /**
   * PHP include view with Helloworld output
   *
   * Example sgsML:
   * <view name="display" displayname="{t}Display{/t}" function="example::helloworld" schema_mode="static" />
   * 
   * @param string $folder current folder id or mountpoint path
   * @param string $view   name of the current view
   * @return string HTML output
   */
  static function helloworld($folder, $view) {
	$output = "<b>Hello World!</b><br/>";
	$output .= "<br/>";
	$output .= "PHP file: ".__FILE__."<br/>";
	$output .= "class: ".__CLASS__."<br/>";
	$output .= "function: ".__FUNCTION__."<br/>";
	$output .= "folder: ".$folder."<br/>";
	$output .= "view: ".$view."<br/>";

	/**
	 * Smarty can be also used here (templates are in templates/*):
	 *
	 * $output .= sys::$smarty->fetch("custom.tpl");
	 */

	// use echo $output to avoid output filtering for bad HTML and Javascript
	return $output;
  }


  /**
   * Example function for validating a field
   *
   * Example sgsML: <validate function="example::validate_url" />
   *
   * @param string $value Value to be checked
   * @return string "" validation ok, "error message" validation failed
   */
  static function validate_url($value) {
	if (!strpos($value, "://")) return "{t}Please enter a valid url.{/t}";
	return "";
  }

  
  /**
   * Example function for filtering a field
   *
   * Example sgsML: <filter function="example::short_url" />
   *
   * @param string $value Value to be filtered
   * @return string filtered value
   */
  static function short_url($value) {
    return str_replace("http://", "", $value);
  }
}