<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Style Tests</title>
<link href="css/core.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="centerPosition"> 
 <!-- HEADER -->
 <div id="topBar">
  <div id="badgeLeft"></div>
  <div id="badgeRight"></div>
  <div id="plane"></div>
  <div id="logo"></div>
  <div id="imgLeft"></div>
 </div>
 
 <!-- NAVIGATION --><ul id="menu">
  <li><a href="index.html">Home</a></li>
  <li> <a href="#">Intelligence</a>
   <ul>
    <li><a href="teamspeak.html">TeamSpeak</a></li>
    <li><a href="headtracking.html">Head Tracking</a></li>
    <li><a href="#">The GIAP</a>
     <ul>
      <li><a href="#">GvYAP</a></li>
      <li><a href="#">GvShaP</a></li>
      <li><a href="#">GvBaP</a></li>
     </ul>
    </li>
    <li><a href="#">Battle Of Stalingrad</a>
     <ul>
      <li><a href="squadSkins.html">Squad Skins</a></li>
      <li><a href="skinsMgmnt.html">Skins Mgmnt</a></li>
      <li><a href="bombsightTable.php">Bombsight Tool</a></li>
     </ul>
   </ul>
  </li>
  <li><a href="#">Base Tour</a>
   <ul>
    <li><a href="#">Roster</a></li>
    <li><a href="rules.html">Squad Rules</a></li>
    <li><a href="tales.html">Giap Tales</a></li>
    <li><a href="pravda.html">Pravda</a></li>
    <li><a href="#">Top Dog Ladder</a></li>
    <li><a href="#">Our Badges</a></li>
   </ul>
  </li>
  <li><a href="application.html">Recruiting</a></li>
  <li><a href="#">Forums</a></li>
 </ul>
 
 <!-- CONTENT -->
 <div id="mainContent">
  <h1>Battle Of Stalingrad</h1>
  <img src="img/main/grafic_h1Line.png"></img>
  <p>The script is used to calculate the SVV bombsight settings for most precise accuracy during the high altitude bomb runs.</p>
  <h2>Wind Correction Calculator</h2>
  <?php
echo "<div class=\"formContainer\">\n";

# get variables and bind them
if (empty ($_POST['reload']) ) {
	$acHeading 	= "please enter aircraft heading";
	$acAltitude	= "please enter aircraft altitude";
	$wHeading 	= "please enter wind heading";
	$wSpeed 		= "please enter wind speed";
	$side 		= '';
	$correction = '';
	$doIt			= 0;
}
else {
	if (is_numeric($_POST['acHeading']) ) 
		{
			if ($_POST['acHeading'] > 360)						# check if POST variable is filled with valid data
				{
					$acHeading 	= "max value is 360!";			# feedback to user
				} else {
					$acHeading = $_POST['acHeading'];
				}
		} else {
			$acHeading 	= "please enter aircraft heading";	# feedback to user
			unset ($_POST['reload']);
		}
	
	if (is_numeric($_POST['acAltitude']) )
		{
			$acAltitude = $_POST['acAltitude'];					# check if POST variable is filled with valid data
		} else {
			$acAltitude	= "please enter aircraft altitude";	# feedback to user
		}
	
	if (is_numeric($_POST['windHeading']) ) 					# check if POST variable is filled with valid data
		{
			if ($_POST['windHeading'] > 360)
				{
					$wHeading 	= "max value is 360!";			# feedback to user
				} else {
					$wHeading = $_POST['windHeading'];
				}
		} else {
			$wHeading 	= "please enter wind heading";		# feedback to user
			unset ($_POST['reload']);
		}

	if (is_numeric($_POST['windSpeed']) )						# check if POST variable is filled with valid data 
		{
			$wSpeed = $_POST['windSpeed'];
		} else {
			$wSpeed = "please enter wind speed";				# feedback to user		
		}
}

# calculate side correction

echo "<form id=\"bombsightTableForm\" name=\"calculate\" action=\"bombsightTable.php\" method=\"post\">\n";

echo "<p class=\"remark\">fields with * are mandatory</p>\n";
   
echo "	<fieldset id=\"inputs\">\n";
echo "		<label>Aircraft Altitude in meter:</label>\n";
if (is_numeric($acAltitude) ) 
			{
				echo "		<input type=\"number\" class=\"form\" name=\"acAltitude\" value=\"$acAltitude\" ><br>\n";
			} else {
				echo "		<input type=\"number\" class=\"form\" name=\"acAltitude\" value=\"\" placeholder=\"$acAltitude\" ><br>\n";
			}

echo "		<label class=\"mandatory\">Aircraft Heading in degrees:</label>\n";
if (is_numeric($acHeading) ) 
			{
				echo "		<input type=\"number\" class=\"formAcHeading\" name=\"acHeading\" value=\"$acHeading\"><br>\n";
			} else {
				echo "		<input type=\"number\" class=\"form\" name=\"acHeading\" value=\"\" placeholder=\"$acHeading\"><br>\n";
			}
echo "		<label class=\"mandatory\">Wind Direction in degrees:</label>\n";
if (is_numeric($wHeading) ) 
			{
				echo "		<input type=\"number\" class=\"form\" name=\"windHeading\" value=\"$wHeading\" ><br>\n";
			} else {
				echo "		<input type=\"number\" class=\"form\" name=\"windHeading\" value=\"\"placeholder=\"$wHeading\" ><br>\n";
			}
echo "		<label>Wind Speed in m/s:</label>\n";
if (is_numeric($wSpeed) ) 
			{
				echo "		<input type=\"number\" class=\"form\" name=\"windSpeed\" value=\"$wSpeed\" ><br>\n";
				echo "	</fieldset>\n";				
			} else {
				echo "		<input type=\"number\" class=\"form\" name=\"windSpeed\" value=\"\" placeholder=\"$wSpeed\" ><br>\n";
				echo "	</fieldset>\n";
			}

// hidden field to manage first and reloaded access of form
echo "		<input type=\"hidden\" name=\"reload\" value=1 >\n";
echo "	</fieldset>\n";

// submit action
echo "	<fieldset id=\"action\">\n";
echo "		<input type=\"submit\" id=\"doIt\" value=\"Calculate\">\n";
echo "	</fieldset>\n";

echo "</form>\n";
echo "</div>\n";


// table container
echo "<div class=\"tableContainer\">\n";

// table headers
	echo "<table id = \"bombsight\">\n";
	echo "<colgroup>\n";
	echo "	<col style=\"width:150px\">\n";
	echo "	<col style=\"width:125px\">\n";
	echo "	<col style=\"width:134px\">\n";
	echo "</colgroup>	\n";
	echo "<tbody>\n";
	echo "	<tr>\n";
	echo "		<th>Approach Heading</th>\n";
	echo "		<th>Correction</th>\n";
	echo "		<th>To Side</th>\n";
	echo "	</tr>\n";


		
if (!empty ($_POST['reload']) ) {

	// if there is any degree value bigger than 360 do nothing
	if ( (is_numeric($acHeading) and ($acHeading <= 360)) and (is_numeric($wHeading) and ($wHeading <= 360)) ) {
	# initialize counter
		$i = -10;
		
		while ($i <= 10) {
		
		if ($i == -10) {
			$acHeading 	= $acHeading	+ $i;
			$correction = $correction	+ $i;
		}
		else {
			$acHeading 	= $acHeading	+ 1;
			$correction = $correction	+ 1;	
		}
		
		# create new variable for full circle value
		$circle = 360;
		
		# correction for crossing 360°	
			if ($correction < 0) {
				$correction = 360 + $correction;
			}
			if ($acHeading < 0) {
				$acHeading = 360 + $acHeading;
			}
		
		// calculate correction side
		if ($acHeading > $wHeading)
			{
				// substract acHeading from wHeading and check if result is bigger then 180
				// set offset variable accordingly
				$correction = $acHeading - $wHeading;
				$side = "left";
				if ($correction > 180)
					{
						$correction = ($circle - $acHeading) + $wHeading; 	#calculate correction angle
						$side = "right";
					}
			}
		else
			{
				// substract  wHeading from acHeading and check if result is bigger then 180
				// set offset variable accordingly
				$correction = $wHeading - $acHeading;
				$side = "right";
				if ($correction > 180)
					{
						$correction = ($circle - $wHeading) + $acHeading;	#calculate correction angle
						$side = "left";
					}
			}
		
		// add table data
		
		if ($i == 0) { # this is to always show the original values
			echo "	<tr>\n";
			echo "		<td class=\"original\">$acHeading °</td>\n";
			echo "		<td class=\"original\">$correction °</td>\n";
			echo "		<td class=\"original\">$side</td>\n";	
			echo "	</tr>\n";
		} else {
				if ($correction %5 == 0) #check if wind correction is a value dividable by 5 without rest
				{
					echo "	<tr>\n";
					echo "		<td>$acHeading °</td>\n";
					echo "		<td>$correction °</td>\n";
					if ($side == "left") {
						echo "		<td class=\"left\">$side</td>\n";
					}
					if ($side == "right") {
						echo "		<td class=\"right\">$side</td>\n";
					}
					echo "	</tr>\n";
					}
				}
			$i = $i + 1;	
		}
		
		// close table
		echo "	<tbody>\n";
		echo "</table>\n";	
			
	} else {
		// echo error and close table
if (!is_numeric($acHeading) ) {
		echo "	<tr>\n";
		echo "		<th colspan=\"3\">Aircraft heading: $acHeading !</th>\n";
		echo "	<\tr>\n";
		}		
if (!is_numeric($wHeading) ) {			
		echo "	<tr>\n";			
		echo "		<th colspan=\"3\">Wind heading: $wHeading !</th>\n";
		echo "	<\tr>\n";	
		}			
		echo "	<tbody>\n";
		echo "</table>\n";
	}
		
}


?>
  <table id="bombRadius">
   <caption>
   Bomb Radius Table
   </caption>
   <colgroup>
   <col style="width:125px">
   <col style="width:125px">
   <col style="width:125px">
   <col style="width:125px">
   <col style="width:125px">
   <col style="width:125px">
   </colgroup>
   <tbody>
    <tr>
     <th>Payload</th>
     <th>Light truck</th>
     <th>Heavy truck</th>
     <th>Armored carrier</th>
     <th>Medium tank</th>
    </tr>
    <tr>
     <td class="first">2.5 kg</td>
     <td>5 /</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td class="first">10 kg</td>
     <td>15 / 5</td>
     <td>10 /</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td class="first">25 kg</td>
     <td>15 / 10</td>
     <td>15 / 5</td>
     <td>5 /</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td class="first">50 kg</td>
     <td>20 / 15</td>
     <td>20 / 10</td>
     <td>5 /</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td class="first">100 kg</td>
     <td>35 / 25</td>
     <td>35 / 15</td>
     <td>15 / 5</td>
     <td>5 / 5</td>
    </tr>
    <tr>
     <td class="first">250 kg</td>
     <td>45 / 30</td>
     <td>40 / 20</td>
     <td>20 / 5</td>
     <td>5 / 5</td>
    </tr>
    <tr>
     <td class="first">500 kg</td>
     <td>80 / 60</td>
     <td>60 / 35</td>
     <td>30 / 15</td>
     <td>10 / 10</td>
    </tr>
    <tr>
     <td class="first">1000 kg</td>
     <td>140 / 90</td>
     <td>100 / 50</td>
     <td>40 / 25</td>
     <td>15 / 15</td>
    </tr>
    <tr>
     <td class="first">1500 kg</td>
     <td>180 / 140</td>
     <td>150 / 80</td>
     <td>50 / 30</td>
     <td>25 / 20</td>
    </tr>
    <tr>
     <td class="first">2500 kg</td>
     <td>200 / 170</td>
     <td>180 / 110</td>
     <td>60 / 35</td>
     <td>30 / 25</td>
    </tr>
   </tbody>
  </table>
  <p class="remarkCenter"> Out of order (meters) / Completely destroyed (meters) <br  />
   data source: <a href="http://forum.il2sturmovik.com/topic/11758-fyi-bomb-blast-radius/?hl=%2Bexplosion+%2Bradius/">forum.il2sturmovik.com</a> </p>
 </div>
</div>
<!-- FOOTER --> 
<img src="img/main/grafic_disclaimerLine.png"></img>
<p id="disclaimer">This site and its extensive use of Soviet era graphics is a tribute to the Soviet people. A people who fought and shed blood under extreme conditions to repel a vile aggressor. It is in no way an endorsement or reverement of the brutal Communist regime, which under Stalin was responsible for perhaps even more soviet deaths than the war itself.</p>
</div>
</body>
</html>