<?php

$vowels = array('A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u');
$punctuations = array(',', ';', '.', '?', '!', ':');

function findFirstCharAmongArray($string, $array) {
	for ($i = 0; $i < strlen($string); $i++) { // go through the string
		if (in_array($string[$i], $array))     // if it is in the array
			return $i;                         // return the index
	}
	return false;
}

function findFirstVowel($word) {
	global $vowels;
	return findFirstCharAmongArray($word, $vowels);
}

function findFirstPunctuation($sentence) {
	global $punctuations;
	return findFirstCharAmongArray($sentence, $punctuations);
}

function processSentence($text) {
	global $vowels;

	$words = explode(" ", $text); // get an array from the sentence
	// var_dump($words);
	// echo "<br />";

	for ($i = 0; $i < count($words); $i++) {            // go through each word
		$word = $words[$i];

		if ($word != "") {                              // if it is not a space
			if (in_array($word[0], $vowels)) {          // if the word begins with a vowel
				$words[$i] = strtolower($word . "way"); // update the array
			} else {                                    // if the word begins with consonants
				$index = findFirstVowel($word);         // find the first vowel of the word
				if ($index !== false) {
					$words[$i] = strtolower(substr($word, $index) . substr($word, 0, $index) . "ay");
				}
			}
		}
	}

	return ucfirst(implode(" ", $words));
}

function processText($text) {
	$index = findFirstPunctuation($text);
	$translation = "";
	while ($index !== false) {
		// for each sentence
		$translation .= processSentence(trim(substr($text, 0, $index)));
		$translation .= $text[$index] . " ";
		$text = substr($text, $index + 1);
		$index = findFirstPunctuation($text);
	}

	// do it one more time n case there is no punctuation sign at the end
	$translation .= processSentence(trim($text));

	return $translation;
}

?>