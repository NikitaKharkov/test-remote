<?

//Load DynaMed topic types
$articleTypes = new SimpleXmlElement(file_get_contents("data/articletypes.xml"));

//Load credit types
$creditTypes = new SimpleXmlElement(file_get_contents("data/credittypes.xml"));

//Load user types
$userTypes = new SimpleXmlElement(file_get_contents("data/usertypes.xml"));

//Load learned items
$learnedItems = new SimpleXmlElement(file_get_contents("data/learneditems.xml"));

//Generate a list of sections for the current article type
if(isset($_REQUEST['type']))
	$sectionOptions = $articleTypes->xpath("//type[@id='{$_REQUEST['type']}']/option");
?>
