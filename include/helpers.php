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

function findFirstLetter($string) {
	for ($i = 0; $i < strlen($string); $i++) {
		if ($string[$i] != " ")
			return $i;
	}
	return false;
}

function ucfirstwithspace($string) {
	$index = findFirstLetter($string); // find the first non-space character
	if ($index !== false)
		$string[$index] = strtoupper($string[$index]);
	return $string;
}

function processSentence($text) {
	global $vowels;

	$text = str_replace(array("\n", "\r"), ' ', $text);

	$words = explode(" ", $text); // get an array from the sentence

	for ($i = 0; $i < count($words); $i++) {            // go through each word
		$word = $words[$i];

		if ($word != "") {                              // if it is not a space
			if (in_array($word[0], $vowels)) {          // if the word begins with a vowel
				$word = strtolower($word . "way");
			} else {                                    // if the word begins with consonants
				$index = findFirstVowel($word);         // find the first vowel of the word
				if ($index !== false) {
					$word = strtolower(substr($word, $index) . substr($word, 0, $index) . "ay");
				}
			}
		}

		$words[$i] = $word;
	}

	return ucfirstwithspace(implode(" ", $words));
}

function processText($text) {
	$translation = "";
	$index = findFirstPunctuation($text);

	while ($index !== false) {
		// for each sentence
		$translation .= processSentence(substr($text, 0, $index));
		$translation .= $text[$index];
		$text = substr($text, $index + 1);
		$index = findFirstPunctuation($text);
	}

	// do it one more time in case there is no punctuation sign at the end
	$translation .= processSentence($text);

	return $translation;
}

?>