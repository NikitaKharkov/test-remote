<?
/**
 * Copyright 2007, iMarc <info@imarc.net>
 * 
 * @author   Jeff Turcotte [jt] <jeff@imarc.net>
 */
class LanguageController extends Controller
{
	/**
	 * finds Language objects
	 * 
	 * @param string order_by
	 * @return array
	 */
	public function findLanguages($order_by=NULL, $code=NULL)
	{
		$order_by = parse_order_by($order_by);
		
		$sql = "SELECT language_id FROM languages WHERE 1=1 ";
		
		$sql .= ($code) ? " AND ebsco_code = '${code}' " : '';
		$sql .= ($order_by) ? " ORDER BY " . $order_by . " " : " ";
		
		return $this->performSql($sql);
	}
	
	
	/**
	 * print a select box of all languages defaulting to english
	 *
	 * @param language_id
	 * @return void
	 */
	public function printLanguageSelect($language_id=NULL, $onchange=NULL)
	{
		$language_id = ($language_id) ? $language_id : 1;
		
		$onchange = ($onchange) ? " onchange=\"${onchange}\" " : ""; 
		
		echo "<select id=\"language_id\" name=\"language_id\"${onchange}>";
		try {
			$languages = $this->listLanguages('name_asc');
			foreach($languages as $id => $language) {
				print_option($language_id, $id, $language->getName());
			}
		} catch (Exception $e) {}
		echo "</select>";
	}
}
?>