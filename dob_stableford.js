
// This is the main function, which calls the other functions
function mainScorecard(){
	//Handicap, Front 9 points, Back 9 pints, Total Points
	var myHandicap = parseInt(document.forms.frmScorecard.hcap.value);
	var front9 = 0;
	var back9 = 0;
	var totalScore = 0;
	
	//Par Ratings, Scores (in strokes), Points (in Stableford), Stroke Indices
	var pars = new Array();
	var scores = new Array();
	var points = new Array();
	var sis = new Array();
	
	pars[0] = parseInt(document.forms.frmScorecard.par1.value);
	pars[1] = parseInt(document.forms.frmScorecard.par2.value);
	pars[2] = parseInt(document.forms.frmScorecard.par3.value);
	
	pars[3] = parseInt(document.forms.frmScorecard.par4.value);
	pars[4] = parseInt(document.forms.frmScorecard.par5.value);
	pars[5] = parseInt(document.forms.frmScorecard.par6.value);

	pars[6] = parseInt(document.forms.frmScorecard.par7.value);
	pars[7] = parseInt(document.forms.frmScorecard.par8.value);
	pars[8] = parseInt(document.forms.frmScorecard.par9.value);

	pars[9] = parseInt(document.forms.frmScorecard.par10.value);
	pars[10] = parseInt(document.forms.frmScorecard.par11.value);
	pars[11] = parseInt(document.forms.frmScorecard.par12.value);

	pars[12] = parseInt(document.forms.frmScorecard.par13.value);
	pars[13] = parseInt(document.forms.frmScorecard.par14.value);
	pars[14] = parseInt(document.forms.frmScorecard.par15.value);

	pars[15] = parseInt(document.forms.frmScorecard.par16.value);
	pars[16] = parseInt(document.forms.frmScorecard.par17.value);
	pars[17] = parseInt(document.forms.frmScorecard.par18.value);
	
	//Stroke Indices
	sis[0] = parseInt(document.forms.frmScorecard.si1.value);
	sis[1] = parseInt(document.forms.frmScorecard.si2.value);
	sis[2] = parseInt(document.forms.frmScorecard.si3.value);

	sis[3] = parseInt(document.forms.frmScorecard.si4.value);
	sis[4] = parseInt(document.forms.frmScorecard.si5.value);
	sis[5] = parseInt(document.forms.frmScorecard.si6.value);

	sis[6] = parseInt(document.forms.frmScorecard.si7.value);
	sis[7] = parseInt(document.forms.frmScorecard.si8.value);
	sis[8] = parseInt(document.forms.frmScorecard.si9.value);
	
	sis[9] = parseInt(document.forms.frmScorecard.si10.value);
	sis[10] = parseInt(document.forms.frmScorecard.si11.value);
	sis[11] = parseInt(document.forms.frmScorecard.si12.value);
	
	sis[12] = parseInt(document.forms.frmScorecard.si13.value);
	sis[13] = parseInt(document.forms.frmScorecard.si14.value);
	sis[14] = parseInt(document.forms.frmScorecard.si15.value);

	sis[15] = parseInt(document.forms.frmScorecard.si16.value);
	sis[16] = parseInt(document.forms.frmScorecard.si17.value);
	sis[17] = parseInt(document.forms.frmScorecard.si18.value);

	
	//Player's Scores
	scores[0] = parseInt(document.forms.frmScorecard.score1.value);
	scores[1] = parseInt(document.forms.frmScorecard.score2.value);
	scores[2] = parseInt(document.forms.frmScorecard.score3.value);
	
	scores[3] = parseInt(document.forms.frmScorecard.score4.value);
	scores[4] = parseInt(document.forms.frmScorecard.score5.value);
	scores[5] = parseInt(document.forms.frmScorecard.score6.value);

	scores[6] = parseInt(document.forms.frmScorecard.score7.value);
	scores[7] = parseInt(document.forms.frmScorecard.score8.value);
	scores[8] = parseInt(document.forms.frmScorecard.score9.value);

	scores[9] = parseInt(document.forms.frmScorecard.score10.value);
	scores[10] = parseInt(document.forms.frmScorecard.score11.value);
	scores[11] = parseInt(document.forms.frmScorecard.score12.value);

	scores[12] = parseInt(document.forms.frmScorecard.score13.value);
	scores[13] = parseInt(document.forms.frmScorecard.score14.value);
	scores[14] = parseInt(document.forms.frmScorecard.score15.value);

	scores[15] = parseInt(document.forms.frmScorecard.score16.value);
	scores[16] = parseInt(document.forms.frmScorecard.score17.value);
	scores[17] = parseInt(document.forms.frmScorecard.score18.value);

	// Check that the SIs are unique
	if (verifyUniqueSIs(sis) == true){
		for (var i = 0; i < 18; i++)
		{
			points[i] = getStablefordPoints(myHandicap, pars[i], sis[i], scores[i]);
			if (i < 9)
				front9 += points[i];
			else
				back9 += points[i];
		}
	}
	
	//Add up the scores
	totalScore = front9 + back9;
	
	document.getElementById("points1").innerHTML = "Hole 1: " + points[0] + " points";
	document.getElementById("points2").innerHTML = "Hole 2: " + points[1] + " points";
	document.getElementById("points3").innerHTML = "Hole 3: " + points[2] + " points";
	
	document.getElementById("points4").innerHTML = "Hole 4: " + points[3] + " points";
	document.getElementById("points5").innerHTML = "Hole 5: " + points[4] + " points";
	document.getElementById("points6").innerHTML = "Hole 6: " + points[5] + " points";
	
	document.getElementById("points7").innerHTML = "Hole 7: " + points[6] + " points";
	document.getElementById("points8").innerHTML = "Hole 8: " + points[7] + " points";
	document.getElementById("points9").innerHTML = "Hole 9: " + points[8] + " points";
	
	document.getElementById("points10").innerHTML = "Hole 10: " + points[9] + " points";
	document.getElementById("points11").innerHTML = "Hole 11: " + points[10] + " points";
	document.getElementById("points12").innerHTML = "Hole 12: " + points[11] + " points";
	
	document.getElementById("points13").innerHTML = "Hole 13: " + points[12] + " points";
	document.getElementById("points14").innerHTML = "Hole 14: " + points[13] + " points";
	document.getElementById("points15").innerHTML = "Hole 15: " + points[14] + " points";
	
	document.getElementById("points16").innerHTML = "Hole 16: " + points[15] + " points";
	document.getElementById("points17").innerHTML = "Hole 17: " + points[16] + " points";
	document.getElementById("points18").innerHTML = "Hole 18: " + points[17] + " points";
	
	document.getElementById("front9total").innerHTML = "Front 9 total: " + front9 + " points";
	document.getElementById("back9total").innerHTML = "Back 9 total: " + back9 + " points";
	document.getElementById("roundtotal").innerHTML = "ROUND TOTAL: " + totalScore + " POINTS";
	
}


// This function checks that all the SIs are unique from 1 to 18
function verifyUniqueSIs(mySIs){
	//var sis = new Array();
	var mySum = 0;
	var mySumofSquares = 0;
	var theNum;
	var theSIUniqueLine = document.getElementById("siunique");
	
	for (var i = 0; i < 18; i++){
		if (isNaN(mySIs[i]) == false){
			theNum = parseInt(mySIs[i]);
			if (theNum > 0 && theNum < 19){
				mySum += theNum;
				mySumofSquares += (theNum * theNum);
			}
		}
	}
	
	if (mySum == 171 && mySumofSquares == 2109){
		theSIUniqueLine.innerHTML = "All SIs are OK";
		return true;		
	}
	else{
		theSIUniqueLine.innerHTML = "Some of the SIs need checking";
		return false;
	}
}

function getStablefordPoints(handicap, par, si, score) {
	//set the Adjusted Score, by which the par rating is adjusted
	var adjustedScore = 0;
	var points = 0;
	
	//if no score is returned
	if (isNaN(score)){
		points = 0;
	}
	else {
		adjustedScore = (Math.floor((90 + handicap - si) / 18)) - 4;
		points = 2 + par + adjustedScore - score;
	}
	
	if (points < 0) points = 0;
	
	return points;
}