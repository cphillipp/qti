<?php
//die("This tool has not been activated"); /* Comment out this line to activate */

if (strpos($_SERVER["SERVER_NAME"], 'localhost') !== false){
	$hostName = $_SERVER['DB1_HOST'];
	$database = "marvolus_current";
	$userName = $_SERVER["DB1_USER"];
	$password = $_SERVER["DB1_PASS"];
} else { // for pagodabox
	$hostName = $_SERVER['DB1_HOST'] . ':' . $_SERVER['DB1_PORT'];
	$database = $_SERVER["DB1_NAME"];
	$userName = $_SERVER["DB1_USER"];
	$password = $_SERVER["DB1_PASS"];
}

/*************************** DO NOT CHANGE ANYTHING BELOW THIS LINE ***************************/
$NOTES = "";
function queryDB($query) {
	global $hostName;
	global $database;
	global $userName;
	global $password;

	$result = "Error-query";
	if (!($db = mysql_connect($hostName,$userName,$password))) {
		return "Error-server";
	} else {
		if (!(mysql_select_db($database))) {
			return "Error-database";
		}
		$result = mysql_query($query);
	}
	mysql_close($db);
	return $result;
}

function sanitize($text) {
	$text = str_replace("'","\'",$text);
	$text = str_replace('"','\"',$text);
	return $text;
}

function searchReplaceArray($search, $replace, $theArray) {
	global $arrayCount;
global $NOTES;
//$NOTES .= "start<br />";

	if (sizeof($theArray) == 0 || is_array($theArray) == false) {
//			$NOTES .= "array1=".$theArray." --- search: ".$search."<br />";
			$NOTES .= $theArray."<br />";
			$theArray = str_replace($search,$replace,$theArray,$count);
			$arrayCount += $count;
			if ($count > 0) { $NOTES .= "----------- found one -----------".$theArray."<br />"; }
//			$NOTES .= "array2=".$theArray." --- replace: ".$replace."<br />";
			return $theArray;
	} else {
//		for ($i = 0; $i < sizeof($theArray); $i++) {
//			$NOTES .= "in array-size: ".sizeof($theArray)."<br />";
//			$theArray[$i] = searchReplaceArray($search, $replace, $theArray[$i]);
//		}
		$i = 0;
		foreach ($theArray as $value) {
//			$NOTES .= "in array before: ".$value."<br />";
			$theArray[$i] = searchReplaceArray($search, $replace, $value);
			$i++;
//			$NOTES .= "in array after: ".$value."<br />";
		}
		return $theArray;
	}

//$NOTES .= "stop<br />";	
//	return $theArray;
}

function getHTML() {
	$tableList = "";
	$error = "";
	$result = queryDB('SHOW TABLES');
	if ($result == "Error-database" || $result == "Error-server" || $result == "Error-query") {
		$error = "<<< ".$result." >>> &nbsp; Make sure that your database credentials are correct.";
	} else {
		$numRows = mysql_num_rows($result);
		$tableList = "<select id='table_name' name='table_name' size='31'>";
		for ($i = 0; $i < $numRows; $i++) {
			$row = mysql_fetch_array($result);
			$tableList .= "<option value='".$row[0]."'>".$row[0]."</option>";
		}
		$tableList .= "</select>";
	}
	?>
	<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script type="text/javascript">
			function sendData(task) {
				var theData = {};
				theData["task"] = task;

				switch (task) {
					case "getColumns":
						theData["tableName"] = jQuery('#table_name').val();
						theData["greyForeignKeys"] = jQuery("#foreignKey").is(':checked');
						break;
					case "searchReplace":
						theData["tableName"] = jQuery('#table_name').val();
						theData["columnName"] = jQuery('#column_name').val()
						theData["searchFor"] = jQuery('#searchFor').val();
						theData["replaceWith"] = jQuery('#replaceWith').val();
						theData["skipSerialized"] = jQuery("#skipSerial").is(':checked');
						if (jQuery("#priKey").is(':checked')) {
							theData["indexKey"] = "primaryKey";
						} else {
							theData["indexKey"] = jQuery('#columnIndex').val();
						}
						break;
				}

				sendAjax(theData);
			}

			function sendAjax(theData) {
				jQuery.ajax({
					type: "POST",
					url: "dbFindAndReplace.php",
					data: theData,
					success: function( data ) {
						if (true) {
							returnData(data);
						}
					}
				});
			}

			function returnData(data) {
				var result = $.parseJSON(data);
				if (typeof result.payload != "undefined" && result.payload !== null) {
					if (result.location == "result_data") {
						var log = result.payload;
						if (jQuery("#"+result.location).html() != "") {
							log += "--------------------------------------------------------------------------<br />";
						}
						jQuery("#"+result.location).html(log+jQuery("#"+result.location).html());
						if (result.error == "error") {
							jQuery("#msg").html("<div class='error'>There was an error in your request.</div>");
						} else if (result.error == "good") {
							jQuery("#msg").html("<div class='good'>Search and Replace was successful. &nbsp; <<< Make sure you de-activate this program when you are done. >>></div>");
						}
					} else {
						jQuery("#"+result.location).html(result.payload);
					}
				}
			}
		</script>
		<style>
			body { background: #F2F2F2; color: #4C4D4F; font-family: Arial,Helvetica,sans-serif; font-size: 12px; padding: 20px; }
			#logo { background: #FFFFFF url("http://cdn.netmark.com/wp-content/themes/netmark/images/logo2.png") no-repeat 4px 4px; height: 125px; }
			#logo h1 { color: #222222; border-radius: 4px; opacity: 0.75; background: #FFBA54; box-shadow: 1px 1px 2px 1px rgba(0,0,0,0.5); position: absolute; top: 88px; left: 269px; -webkit-transform: rotate(-10deg); -moz-transform: rotate(-10deg); -ms-transform: rotate(-10deg); -o-transform: rotate(-10deg); filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0); }
			#logo h2 { font-size: 50px; position: absolute; top: 20px; right: 10%; }
			.box { background-color: #FFFFFF; box-shadow: 0 0 4px 1px rgba(0,0,0,0.5); border-radius: 4px; padding: 0 10px; }
			.box h2 { text-align: center; }
			small { font-size: 10px; color: #E88F29; }
			.error { margin-top: 20px; background-color: #EEF5F1; border: 1px solid #ED541D; color: #8C2E0B; min-height: 30px; line-height: 30px; box-shadow: 0 0 4px 2px rgba(237,84,28,0.5); border-radius: 4px; padding: 0 10px; }
			.alert { margin-top: 20px; background-color: #FFFCE5; border: 1px solid #EEDD55; color: #884400; min-height: 30px; line-height: 30px; box-shadow: 0 0 4px 2px rgba(238,221,85,0.5); border-radius: 4px; padding: 0 10px; }
			.good {  margin-top: 20px; background-color: #F8FFF0; border: 1px solid #BBEE77; color: #243600; min-height: 30px; line-height: 30px; box-shadow: 0 0 4px 2px rgba(187,238,119,0.5); border-radius: 4px; padding: 0 10px; }

			#content { width: 100%; }
			option:hover { background-color: #9EBFE3; }
			#tables select { width: 100%; }
			#columns select { width: 100%; }
			#tables { float: left; margin: 20px 1% 10px 0; width: 30%; max-width: 400px; height: 600px; }
			#columns { float: left; margin: 20px 1% 10px 1%; width: 30%; max-width: 400px; height: 600px; }
			#controls { float: left; margin: 20px 0 10px 1%; width: 30%; max-width: 400px; height: 600px; }
			#results { float: left; margin-top: -34px; padding-top: 10px; width: 100%; height: 430px; }
			#table_data { overflow: auto; width: 100%; height: 540px; }
			#column_data { overflow: auto; width: 100%; height: 540px; }
			#result_data { overflow: auto; width: 100%; height: 410px; }

			#buttons { width: 100%; line-height: 26px; }
			#searchFor { float: right; width: 75%; margin-bottom: 4px; }
			#replaceWith { float: right; width: 75%; margin-bottom: 4px; }
			#searchButton { float: right; margin-bottom: 4px; }
			#buttons h4 { margin-top: 7px; }
			#specialCases { width: 186px; margin-top: -15px; line-height: 17px; }
			#priKey { float: right; }
			#foreignKey { float: right; }
			#skipSerial { float: right; }
			#specialIndex { position: relative; top: -59px; left: 200px; width: 200px; visibility: hidden; }
			#columnIndex { width: 200px; }
			.clear { clear: both; }
		</style>
	</head>
	<body>
		<div id="main">
			<div id="logo" class="box"><h1>&nbsp;web dev&nbsp;</h1><h2>Search & Replace</h2></div>
			<div id="msg">
				<?php if ($error != "") { ?>
				<div class="error"><?php echo $error; ?></div>
				<?php } else { ?>
				<div class="alert"> <<< Make sure you backup the database >>> </div>
				<?php } ?>
			</div>
			<?php if ($error == "") { ?>
			<div id="content">
				<div id="tables" class="box">
					<h2>Select a Table to Search <small>(Select One)</small></h2>
					<div id="table_data"><?php echo $tableList; ?></div>
				</div>
				<div id="columns" class="box">
					<h2>Select which Column to Search <small>(Select Multiple)</small></h2>
					<div id="column_data"></div>
				</div>
				<div id="controls">
					<div id="buttons">
						Search For:
						<input id="searchFor" name="searchFor" title="Search for:" type="text" value="" /><br />
						<div class="clear"></div>
						Replace With:
						<input id="replaceWith" name="replaceWith" title="Replace with:" type="text" value="" /><br />
						<div class="clear"></div>
						<input id="searchButton" type="button" value="Search and Replace" />
						<h4>These settings are only for special cases.</h4>
						<div id="specialCases">
							Use primary key for indexing:
							<input id="priKey" name="priKey" title="Primary Key" type="checkbox" checked /><br />
							<div class="clear"></div>
							Grey out foreign keys:
							<input id="foreignKey" name="foreignKey" title="Foreign Key" type="checkbox" checked /><br />
							<div class="clear"></div>
							Skip serialized data:
							<input id="skipSerial" name="skipSerial" title="Skip Serialized" type="checkbox" checked /><br />
							<div class="clear"></div>
							<div id="specialIndex">
								Enter name of column for indexing:<br/>
								<input id="columnIndex" name="columnIndex" title="Column Index:" type="text" value="" /><br />
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div id="results" class="box">
						<div id="result_data">
<?php /*
$tmp = 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}';
$temp = unserialize($tmp);
//print_r($temp);
var_dump($temp);
*/ ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<script>
			jQuery( document ).ready(function() {
				jQuery('#table_name').val("");
				jQuery('#priKey').each(function(){ this.checked = true; });
				jQuery('#foreignKey').each(function(){ this.checked = true; });
				jQuery('#skipSerial').each(function(){ this.checked = true; });
				jQuery('#table_name').click(function() {
					sendData("getColumns");
				});
				jQuery('#searchButton').click(function() {
					if (jQuery("#priKey").is(':checked') || jQuery('#columnIndex').val() != "") {
						sendData("searchReplace");
					} else {
						alert("No search index selected");
					}
				});
				jQuery('#priKey').click(function() {
					if (jQuery("#priKey").is(':checked')) {
						jQuery('#columnIndex').css('visibility','hidden');
					} else {
						jQuery('#columnIndex').css('visibility','visible');
					}
				});
				jQuery('#foreignKey').click(function() {
					if (jQuery('#table_name').val() != null) {
						sendData("getColumns");
					}
				});
			});
		</script>
	</body>
	</html> 
	<?php
}

if ($_POST == NULL) {
	getHTML();
} else {
	if ($_POST['task'] == "getColumns") {
		/* get the primary key and foreign keys of the table */
		$primaryKey;
		$foreignKeys = array();
		$result = queryDB("SHOW KEYS FROM ".$_POST['tableName']);
		$numRows = mysql_num_rows($result);
		for ($i = 0; $i < $numRows; $i++) {
			$row = mysql_fetch_array($result);
			if ($row['Key_name'] == "PRIMARY") {
				$primaryKey = $row['Column_name'];
			} else {
				$foreignKeys[] = $row['Column_name'];
			}
		}

		/* get the columns of the table */
		$result = queryDB('SHOW COLUMNS FROM '.$_POST['tableName']);
		$numRows = mysql_num_rows($result);
		$columnList = "<select id='column_name' name='column_name' size='31' multiple>";
		for ($i = 0; $i < $numRows; $i++) {
			$row = mysql_fetch_array($result);
			if ($row[0] == $primaryKey) {
				$columnList .= "<option value='".$row[0]."' disabled='disabled'>".$row[0]." - (Primary Key)</option>";
			} else if (in_array($row[0],$foreignKeys) && $_POST['greyForeignKeys'] == 'true') {
				$columnList .= "<option value='".$row[0]."' disabled='disabled'>".$row[0]." - (Foreign Key)</option>";
			} else if ($row[0] == 'guid') {
				$columnList .= "<option value='".$row[0]."' disabled='disabled'>".$row[0]." - (Cannot change this)</option>";
			} else {
				$columnList .= "<option value='".$row[0]."'>".$row[0]."</option>";
			}
		}
		$columnList .= "</select>";
		$returnData['location'] = "column_data";
		$returnData['payload'] = $columnList;
		echo json_encode($returnData);
		
	} else if ($_POST['task'] == "searchReplace") {
		$theTable = $_POST['tableName'];
		$theColumnArray = $_POST['columnName'];
		$theColumns = implode(",",$_POST['columnName']);
		$theSearch = $_POST['searchFor'];
		$theReplace = sanitize($_POST['replaceWith']);
		$totalCount = 0;
		$arrayCount = 0;
		$totalCellCount = 0;
		$totalRowCount = 0;
		$error = "good";

		/* Get the primary key */
		$result = queryDB("SHOW KEYS FROM ".$theTable." WHERE Key_name = 'PRIMARY'");
		if (!$result) { $error = "error"; }
		$row = mysql_fetch_array($result);
		if ($_POST['indexKey'] == "primaryKey") {
			$theKey = $row["Column_name"];
		} else {
			$theKey = $_POST['indexKey'];
		}

		/* Get data from table */
		$result = queryDB("SELECT ".$theColumns.",".$theKey." FROM ".$theTable);
		if (!$result) { $error = "error"; }
$resultList = "";
		$numRows = mysql_num_rows($result);
		for ($i = 0; $i < $numRows; $i++) {
			$inRow = false;
			$row = mysql_fetch_array($result);
			for ($j = 0; $j < sizeof($theColumnArray); $j++) {
				$unSerialized = unserialize($row[$j]);
				if ($unSerialized === false) {
					$theValue = str_replace($theSearch,$theReplace,$row[$j],$count);
				} else if ($_POST['skipSerialized'] == 'false') {
					$arrayCount = 0;
//					$unSerialized = searchReplaceArray($theSearch, $theReplace, $unSerialized);
					$theValue = serialize($unSerialized);
//$resultList .= "the notes are:<br />".$NOTES."<br />";
//$resultList .= $theValue."<br />";
				}
			
				if ($count > 0 || $arrayCount > 0) {
					$temp = queryDB("UPDATE ".$theTable." SET ".$theColumnArray[$j]."='".$theValue."' WHERE ".$theKey."=".$row[$theKey]);
//					if (!$temp) { $error = "error"; break; }
					$totalCount += $count;
					$totalCount += $arrayCount;
					$totalCellCount++;
					$inRow = true;
				}

			}
			if ($inRow) { $totalRowCount++; }
		}

		$resultList .= "Search for: ".$theSearch."<br />Replace with: ".$_POST['replaceWith']."<br />Total replaced: ".$totalCount."<br />Total cells: ".$totalCellCount."<br />Total rows: ".$totalRowCount."<br />";

		$returnData['location'] = "result_data";
		$returnData['payload'] = $resultList;
		$returnData['error'] = $error;
		echo json_encode($returnData);
	}
}

?>
