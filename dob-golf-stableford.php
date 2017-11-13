<?php /* 

/*
    Plugin Name: Stableford Score Calculator
    Description: Plugin to Calculate Stableford Points in a Round of Golf
    Author: Derek O'Brien
    Version: 1.0
*/

// ---------------------------------------------------------------------- Activation and de-activation


function dob_stableford_activation() {
}
register_activation_hook(__FILE__, 'dob_stableford_activation');

function dob_stableford_deactivation() {
}
register_deactivation_hook(__FILE__, 'dob_stableford_deactivation');


// ---------------------------------------------------------------------- Scripts

add_action('wp_enqueue_scripts', 'dob_stableford_scripts');
function dob_stableford_scripts() {

	//Register
	wp_register_script('dob_stableford_init', plugins_url('dob_stableford.js', __FILE__));

	//Enqueue
	wp_enqueue_script('dob_stableford_init');

}

// ---------------------------------------------------------------------- Styles

add_action('wp_enqueue_scripts', 'dob_stableford_styles');

function dob_stableford_styles() {
	
	//Register
	wp_register_style('dob_stableford_style', plugins_url('dob_stableford.css', __FILE__));

	//Enqueue
	wp_enqueue_style('dob_stableford_style');

}

// ---------------------------------------------------------------------- Shortcode and display to front end

add_shortcode("dob_stableford_shortcode", "dob_stableford_display");

function dob_stableford_display($attr) {
	//use the attributes
	extract( shortcode_atts( array(
     'borders' => '#000000',
	 'text' => '#000000',
	 'bgcol' => '#ffffff',
	 'opacity' => '0.5'
    ), $attr));

	// this code is to produce the scorecard
	
	$html=	'<div id="stableford-container" style="background-color: ' . get_rgba($bgcol, $opacity) . ';">
		<form id="frmScorecard" method="post" action="">
		<div id="stableford-handicap" style="border: ' . get_rgb($borders) . ' 1px solid;">
		<p style="color: ' . get_rgb($text) . ';"> Handicap goes here <input name="hcap" size="10" type="text" onchange="mainScorecard()"/></p>
		</div>
		<div id="stableford-inputs" style="border: ' . get_rgb($borders) . ' 1px solid;">
			<p style="color: ' . get_rgb($text) . ';"> Inputs </p>
			<div id="inputs-front9">
				<p style="color: ' . get_rgb($text) . ';"> Front 9 </p>
				<table>
					<tbody>
						<tr>
						  <td style="color: ' . get_rgb($text) . ';">Hole</td>
						  <td style="color: ' . get_rgb($text) . ';">Par</td>
						  <td style="color: ' . get_rgb($text) . ';">SI</td>
						  <td style="color: ' . get_rgb($text) . ';">Score</td>
						</tr>
						<tr>';
						
	// For each hole on the front 9
	for ($i = 1; $i < 10; $i++){
		$html .= '<td style="color: ' . get_rgb($text) . ';">' . $i . '</td>
				<td><input name="par' . $i . '" size="5" type="text" onchange="mainScorecard()"/></td>
						  <td><input name="si' . $i . '" size="5" type="text" onchange="mainScorecard()"/></td>
						  <td><input name="score' . $i . '" size="5" type="text" onchange="mainScorecard()"/></td>
						</tr>';
	}
	$html .= '</tbody>
				</table>
			</div>
			<div id="inputs-back9">
				<p style="color: ' . get_rgb($text) . ';"> Back 9 </p>
				<table>
					<tbody>
						<tr>
						  <td style="color: ' . get_rgb($text) . ';">Hole</td>
						  <td style="color: ' . get_rgb($text) . ';">Par</td>
						  <td style="color: ' . get_rgb($text) . ';">SI</td>
						  <td style="color: ' . get_rgb($text) . ';">Score</td>
						</tr>';
	
	// For each hole on the back 9
	for ($i = 10; $i < 19; $i++){
		$html .= '<td style="color: ' . get_rgb($text) . ';">' . $i . '</td>
				<td><input name="par' . $i . '" size="5" type="text" onchange="mainScorecard()"/></td>
						  <td><input name="si' . $i . '" size="5" type="text" onchange="mainScorecard()"/></td>
						  <td><input name="score' . $i . '" size="5" type="text" onchange="mainScorecard()"/></td>
						</tr>';
	}
	$html .= '</tbody>
				</table>
			</div>
		</div>
		<div id="stableford-points" style="border: ' . get_rgb($borders) . ' 1px solid;">
			<p style="color: ' . get_rgb($text) . ';"> Points are displayed here </p>
			<div id="points-front9">
				<p style="color: ' . get_rgb($text) . ';"> Front 9 </p>
				<ul>';
	
	// For each hole on the front 9
	for ($i = 1; $i < 10; $i++)
	{
		$html .= '<li id="points' . $i . '" style="color: ' . get_rgb($text) . ';">Hole ' . $i . '</li>';
	}
	$html .= '</ul>
			</div>
			<div id="points-back9">
				<p style="color: ' . get_rgb($text) . ';"> Back 9 </p>
				<ul>';
	
	// For each hole on the back 9
	for ($i = 10; $i < 19; $i++)
	{
		$html .= '<li id="points' . $i . '" style="color: ' . get_rgb($text) . ';">Hole ' . $i . '</li>';
	}
	
	// The total scores
	$html .= '</ul>
			</div>
		</div>
		<div id="totals" style="border: ' . get_rgb($borders) . ' 1px solid;">
			<p id="siunique" style="color: ' . get_rgb($text) . ';">SI Uniqueness</p>
			<p id="front9total" style="color: ' . get_rgb($text) . ';">Front 9 Total:</p>
			<p id="back9total" style="color: ' . get_rgb($text) . ';">Back 9 Total:</p>
			<p id="roundtotal" style="color: ' . get_rgb($text) . ';">Round Total:</p>
		</div>
	</form>
</div>';

return $html;
			
}

function get_rgba($col, $opacity){
	//Convert the colour to rgb
	$r = 0;
	$g = 0;
	$b = 0;
	
	$alpha = $opacity;
	
	if ($alpha > 1)
		$alpha = 1;
	if ($alpha < 0)
		$alpha = 0;
	
	if (substr($col, 0, 1) == "#") {
		$r = get_dec(substr($col, 1, 2));
		$g = get_dec(substr($col, 3, 2));
		$b = get_dec(substr($col, 5, 2));
	}
	
	$the_rgba = "rgba(" . $r . ", " . $g . ", " . $b . ", " . $alpha . ")";
	return $the_rgba;
}


function get_rgb($col){
	//Convert the colour to rgb
	$r = 0;
	$g = 0;
	$b = 0;
		
	if (substr($col, 0, 1) == "#") {
		$r = get_dec(substr($col, 1, 2));
		$g = get_dec(substr($col, 3, 2));
		$b = get_dec(substr($col, 5, 2));
	}
	
	$the_rgba = "rgb(" . $r . ", " . $g . ", " . $b . ")";
	return $the_rgba;
}


// convert hex to decimal
function get_dec($the_hex) {
	$good_chars = "0123456789abcdef";
	$first_char = substr($the_hex, 0, 1);
	$last_char = substr($the_hex, 1, 1);
	
	$sixteens = 0;
	$ones = 0;
	
	// get sixteens digit
	if (stripos($good_chars, $first_char) == false) {
		$sixteens = 0;
	}
	else
	{
		$sixteens = stripos($good_chars, $first_char);
	}
	
	//get units digit
	if (stripos($good_chars, $last_char) == false) {
		$ones = 0;
	}
	else
	{
		$ones = stripos($good_chars, $last_char);
	}
	
	return (16 * $sixteens) + $ones;
	
}
// ---------------------------------------------------------------------- Start Point

add_action('init', 'dob_stableford_start');

function dob_stableford_start() {

    $args = array(
       'labels' => $labels,
       'hierarchical' => true,
       'description' => 'Form',
       'supports' => array('title', 'editor'),
       'public' => true,
       'show_ui' => true,
       'show_in_menu' => true,
       'show_in_nav_menus' => true,
       'publicly_queryable' => false,
       'exclude_from_search' => true,
       'has_archive' => true,
       'query_var' => true,
       'can_export' => true,
       'rewrite' => true,
       'capability_type' => 'post'
    );
 
    
    register_post_type('golf_stableford_js', $args);

}


?>