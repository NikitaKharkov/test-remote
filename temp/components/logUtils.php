<?
//Log values to an XML file
function logEntry($submitTime, $values, $selectedSections, $selectedLearnings) {
	//Load the XML
	$log = new DOMDocument();
	$log->load("./data/log.xml");
	$doc = $log->getElementsByTagName("log")->item(0);
	
	//Create a new <entry> element
	$entry = $log->createElement("entry");
	$doc->appendChild($entry);
	
	//Add the submit time to the log
	addChild($log, $entry, "submitTime", $submitTime);
	
	//Add all values as children of the <entry> element
	foreach($values as $key => $value)
		if(!strstr($key, "_") && !strstr($key, "all"))
			addChild($log,$entry,$key, $value);
	
	//Add all sections as children of the <entry> elements
	$sections = addChild($log,$entry,"sections","");
	foreach($selectedSections as $selectedSection)
		addChild($log,$sections,"section", $selectedSection);
	
	//Add all learnings as children of the <entry> elements
	$learnings = addChild($log,$entry,"learnings","");
	foreach($selectedLearnings as $selectedLearning)
		addChild($log,$learnings,"learning", $selectedLearning);
	
	//Save the log to disk
	$log->save("./data/log.xml");
}

//For the XML document $xml, add a <$name> element with $text content as the
//last child of the $addTo element
function addChild($xml, $addTo, $name, $text) {
	$element = $xml->createElement($name);
	$element->appendChild($xml->createTextNode($text));
	$addTo->appendChild($element);
	return $element;
}
?>
