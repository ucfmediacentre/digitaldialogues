<?php

// Returns an associative array with all the links in an array
// and the parts either side of the links in an array.
function parse_string_for_links($string)
{
	$pattern = "/(?<=\[\[)[\w ]+(?=\]\])/"; // [[ ... ]] regex
	$links = null;							// array to store results of regex					
	$cursor = 0;							// cursor to keep track of the substring start position
	$parts = array();						// to store the parts either side of the links
		
	// excute the regex and populate $links array storing the offset with the match
	preg_match_all ( $pattern, $string, $links, PREG_OFFSET_CAPTURE );

	// loop through each link saving the string to the right of it to the parts array
	foreach($links[0] as $link)
	{
		// calculate the length of the substring
		$length = $link[1] - $cursor;
		
		// create a substring from the starting cursor 
		$part = substr($string, $cursor, $length);
		
		// add the string to the parts array
		array_push($parts, $part);
		
		// update the cursor position
		$cursor = $link[1] + strlen($link[0]); 
	}
	
	// collect the last substring from the end of the string
	$part = substr($string, $cursor, strlen($string));
	array_push($parts, $part);
	
	// create and associative array of the results and return it
	$result['links'] = $links[0];
	$result['parts'] = $parts;
	return $result;
}

$string = "perhaps this would be easier to debug it said[[hello]] how are you instead [[ere minate]]of this one [[this one]]perhaps this would be easier to debug it said[[hello]] how are you instead [[ere minate]]of this one [[this one]] dafsdf adsfasd fasdfasf";

$linkInfo = parse_string_for_links($string);

print_r($linkInfo);

?>