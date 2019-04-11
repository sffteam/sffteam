<?php
	/*
		Generate however many unique bingo cards you require (should be fewer than 10k though).
		This is not meant to compute ALL possible bingo cards, obviously, but to help set up a
		nice amount of cards for play.
		If you require a free space somewhere on the board, you should probably tweak the output,
		not the generator.
		I wrote this because existing solutions on stackoverflow were in languages I could not
		test as easily and many existing generator websites generate crap cards that do not 
		adhere to the bingo number distribution in the 5 rows, so you spend an eternity looking
		up your numbers.
		I hope this helps somebody. Let me know if you find it useful or you know how to improve
		the code.
		
		Created: April 4, 2017
		By: Arno Richter
		Url: http://arnorichter.de/
	*/
	DEFINE('BR', "<br />\n");
	
	$number_of_cards = 60; // the amount of unique cards to generate. don't make too many!
	$columns = array(
		range(1,15),
		range(16,30),
		range(31,45),
		range(46,60),
		range(61,75)
	);
	$bingo_cards = array();
	$card_hashes = array();
	$i = 0;
	
	/* GENERATE THE CARDS */
	while($i < $number_of_cards) {
		$bingo_card = array();
		for($j=0; $j<5; $j++) {
			$random_keys = array_rand($columns[$j], 5);
			$random_values = array_intersect_key($columns[$j], array_flip($random_keys)); // http://stackoverflow.com/a/18047331/3625228
			$bingo_card = array_merge($bingo_card, $random_values);
		}
		// generate a unique hash for this card and compare it to the ones we already have
		$card_hash = md5(json_encode($bingo_card)); // or whatever hashing algorithm is preferred
		if(!in_array($card_hash, $card_hashes)) {
			$bingo_cards[] = $bingo_card;
			$i += 1;
		}
		if($i > 10000) break; // safety exit
	}
	/* OUTPUT, if needed (output with monospace font). could be made into an html table. */
	foreach($bingo_cards as $card) {
		for($k=0; $k<(sizeof($card)/5); $k++) {
			echo(str_pad($card[$k], 2, ' ', STR_PAD_LEFT).' | ');
			echo($card[$k+5].' | ');
			echo($card[$k+10].' | ');
			echo($card[$k+15].' | ');
			echo($card[$k+20].BR);
			if($k < 4) echo(str_repeat('-', 22).BR);
		}
		echo(BR.BR);
	}
?>