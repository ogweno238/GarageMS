<?php
require('qs_connection.php');
require('qs_functions.php');

@session_start();

$row = "";
$err_string = "";
$updateCond = "";
if (isset($_GET["page"])) {
    $current_page = $_GET["page"];
} elseif (isset($_POST["page"])) {
    $current_page = $_POST["page"];
} else {
    $current_page = 1;
}
$quotechar = "`";
$quotedate = "'";
$hidden_tag = "";
$result = "";
$sql = "";
$sql_ext = "";
$formatdate = array();
$formatdate[0] = "";
$formatdate[1] = "";
$formatdate[2] = "";
$seperatedate = array();
$seperatedate[0] = " ";
$seperatedate[1] = " ";
$seperatedate[2] = " ";
$sql .= " Select\n";
    $sql .= "     `position`.`position`,\n";
    $sql .= "     `position`.`IDNo`,\n";
	$sql .= "     `position`.`Limit`\n";
    $sql .= " From\n";
    $sql .= "     `position`   `position`\n";

//Field Related Declarations
$req_Position        = "add_fd0";
$req_IDNo   		 = "add_fd1";
$req_Limit        	 = "add_fd2";


//Assign Recordset Field Index
$rs_idx_position     = 0;
$rs_idx_IDNo 		 = 1;
$rs_idx_Limit 		 = 2;

// >> START OF "after local declaration" [LCLVARDECL001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after local declaration" [LCLVARDECL001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
if (isset($_POST["act"])) {
   $ProcessForm  = "Y"; 
// >> START OF "before server form processing" [FORMPROCESS001] [PRE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before server form processing" [FORMPROCESS001] [PRE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
   if ($ProcessForm  == "Y") { 
if (strpos(strtoupper($sql), " WHERE ")) {
   $sqltemp = $sql . " AND (1=0) ";
}else{
   $sqltemp = $sql . " Where (1=0) ";
}
// >> START OF "on create recordset object" [CRTRECSETOBJ001] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "on create recordset object" [CRTRECSETOBJ001] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
// >> START OF "on open connection" [OPENCONN001] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "on open connection" [OPENCONN001] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
$result = mysql_query($sqltemp . " " . $sql_ext . " limit 0,1")
          or die("Invalid query");
$qry_string = "";
$insert_sql = "";
$value_sql = "";
$i = 0;
$SourceFileUpload = array();
$DestFileUpload = array();
$NewFieldUpload = array();
 
//Set initial value for array
$SourceFileUpload[0] = "";
$DestFileUpload[0] = "";
$NewFieldUpload[0] = "";
$SourceFileUpload[1] = "";
$DestFileUpload[1] = "";
$NewFieldUpload[1] = "";
$SourceFileUpload[2] = "";
$DestFileUpload[2] = "";
$NewFieldUpload[2] = "";

 
$i = 0;
while ($i < mysql_num_fields($result)) {
    $meta = mysql_fetch_field($result);
    $field_name = $meta->name;
    $field_type = $meta->type;
    $type_field = "";
    $type_field = returntype($field_type);
    if (qsvalidRequest("search_fd" .$i)) {
        if ($qry_string == "") {
            $qry_string = "search_fd" . $i . "=" . urlencode(stripslashes(qsrequest("search_fd" . $i)));
        } else {
            $qry_string .= "&search_fd" .$i . "=" . urlencode(stripslashes(qsrequest("search_fd" . $i)));
        }
        $hidden_tag .= "<input type=\"hidden\" name=\"search_fd" .$i . "\" value=\"" . qsreplace_html_quote(stripslashes(qsrequest("search_fd" . $i))) . "\">\n";
        if ($qry_string == "") {
            $qry_string = "multisearch_fd" . $i . "=" . urlencode(stripslashes(qsrequest("multisearch_fd" . $i)));
        } else {
            $qry_string .= "&multisearch_fd" .$i . "=" . urlencode(stripslashes(qsrequest("multisearch_fd" . $i)));
        }
        $hidden_tag .= "<input type=\"hidden\" name=\"multisearch_fd" .$i . "\" value=\"" . qsreplace_html_quote(stripslashes(qsrequest("multisearch_fd" . $i))) . "\">\n";
    }
    if (qsvalidRequest("add_fd" .$i) 
       ) {
        $idata = qsrequest("add_fd" . $i);
        if ($meta) {
            if ($type_field == "type_datetime") {
// >> START OF "before add date/time form field to sql (php)" [ITEMBEFADDTOSQLDTM] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before add date/time form field to sql (php)" [ITEMBEFADDTOSQLDTM] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]

                    if ($insert_sql == "") {
                        $insert_sql .= $quotechar . $field_name . $quotechar;
                        $value_sql  .= $quotedate . qsconvertdate2ansi($idata,$formatdate[$i],$seperatedate[$i]) .  $quotedate;
                    } else {
                        $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                        $value_sql  .= "," . $quotedate . qsconvertdate2ansi($idata,$formatdate[$i],$seperatedate[$i]) .$quotedate;
                    }
            } elseif ($type_field == "type_integer") {
                $idata = QSConvert2EngNumber($idata); 
// >> START OF "before add integer form field to sql (php)" [ITEMBEFADDTOSQLINT] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before add integer form field to sql (php)" [ITEMBEFADDTOSQLINT] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]

                if (is_numeric($idata)) {
                    if ($insert_sql == "") {
                        $insert_sql .= $quotechar . $field_name . $quotechar;
                        $value_sql  .= $idata;
                    } else {
                        $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                        $value_sql  .= "," . $idata;
                    }
                } else {
                    $err_string .= "<strong>Error:</strong>while adding<strong>" . $field_name . "</strong>.<br>";
                    $err_string .= "Description: Type mismatch.<br>";
                }
            } elseif ($type_field == "type_string") {
// >> START OF "before add string form field to sql (php)" [ITEMBEFADDTOSQLSTRING] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before add string form field to sql (php)" [ITEMBEFADDTOSQLSTRING] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]

                if ($insert_sql == "") {
                    $insert_sql .= $quotechar . $field_name . $quotechar;
                    $value_sql  .= "'" . ereg_replace("'","''",stripslashes($idata)) . "'";
                } else {
                    $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                    $value_sql  .= ",'" . ereg_replace("'","''",stripslashes($idata)) . "'";
                }
            } else {
// >> START OF "before add other form field to sql (php)" [ITEMBEFADDTOSQLOTHER] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before add other form field to sql (php)" [ITEMBEFADDTOSQLOTHER] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]

                if ($insert_sql == "") {
                    $insert_sql .= $quotechar . $field_name . $quotechar;
                    $value_sql  .= "'" . ereg_replace("'","''",stripslashes($idata)) . "'";
                } else {
                    $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                    $value_sql  .= ",'" . ereg_replace("'","''",stripslashes($idata)) . "'";
                }
            }
// >> START OF "after add form field to sql (php)" [ITEMAFTADDTOSQL] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after add form field to sql (php)" [ITEMAFTADDTOSQL] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]

        }
    } else {
        if ((strtolower($field_type) != "int identity")
         && (strtolower($field_type) != "autoincrement")
         && (strtolower($field_type) != "counter")) {
            if ($insert_sql == "") {
                $insert_sql .= $quotechar . $field_name . $quotechar;
                $value_sql  .= "null";
            } else {
                $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                $value_sql  .= ", null";
            }
        }
    }
$i++;
}

$sql  = "";
$sql  = "insert into " . $quotechar. mysql_field_table($result,0) . $quotechar;
$sql .= " (" . $insert_sql . ")";
$sql .= " values";
$sql .= " (" . $value_sql . ")";

#----get submit url page----
    $submiturl = "./position.php?";
    if ($result > 0) {mysql_free_result($result);}
    if (!$result = @mysql_query($sql)){
        $err_string .= "<strong>Error:</strong>while adding<br>" . mysql_error();
// >> START OF "on add data error" [ADDDATAERR001] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "on add data error" [ADDDATAERR001] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
    } else { 
// >> START OF "on add data success" [ADDDATASUCCESS001] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "on add data success" [ADDDATASUCCESS001] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
    }
// >> START OF "before upload file" [UPLOAD001] [PRE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before upload file" [UPLOAD001] [PRE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
    if ($err_string == "") { 
       for ($i = 0; $i < 2; $i++)  
       { 
          if ($SourceFileUpload[$i] <> "") { 
              if (!(move_uploaded_file($SourceFileUpload[$i], $DestFileUpload[$i]))) {    // Upload Fail 
                  $err_string = 	"Cannot upload file! There is problem occured when upload."	; 
// >> START OF "on upload file error" [UPLOADERR001] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "on upload file error" [UPLOADERR001] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
                } 
          } //end if  
       } 
    } //end if error string  
// >> START OF "after upload file" [UPLOAD001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after upload file" [UPLOAD001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
    if ($err_string == "") {
        if ($qry_string != "") {
            $URL= $submiturl . "&" . $qry_string;
        } else {
            $URL= $submiturl;
        }
        header ("Location: $URL");
        exit;
    }
  } //end if ProcessForm

} //end if act
?>
<HTML>

<HEAD>

<Title>Add Position</Title>

<link rel="stylesheet" type="text/css" href="position_add.css">



<!-- Load the YUI Loader scripts needed by dbQwikSite -->   
<script type="text/javascript" src="./js/yahoo-min.js" ></script>
<script type="text/javascript" src="./js/dom-min.js" ></script>
<script type="text/javascript" src="./js/event-min.js" ></script>

<script type="text/javascript">

  // Invoke dbQwikSite Page OnLoad controller as soon as the page is ready 
  // This should always happen first, any user custom-code should run after
  YAHOO.util.Event.onDOMReady( function() { qsPageOnLoadController(); } );  

</script>


	<link rel="stylesheet" type="text/css" href="./css/ContentLayout.css"></link>


<!-- END OF STD-Loader.txt -->


<script type="text/javascript">

// Declares all constants and arrays
// for all page items used on the page

// Declare Field Indexes for all page items
var qsPageItemsCount = 2
var _Position                                 = 0;
var _Noparticipant                            = 1;

// Declare Fields Prompts
var fieldPrompts = [];
fieldPrompts[_Position] = "Position";
fieldPrompts[_IDNo] = "IDNo";
fieldPrompts[_Limit] = "Limit";

// Declare Fields Technical Names
var fieldTechNames = [];
fieldTechNames[_Position] = "Position";
fieldTechNames[_IDNo] = "IDNo";
fieldTechNames[_Limit] = "Limit";

// This function dynamically assigns element 'ID' attributes to all relevant elements
function qsAssignElementIDs() {

  // STEP 1: Assign an ID to all field PROMPTS (TD captions)
  // Scan all table TD tags for those that match field prompts
  var TDs = document.getElementsByTagName("td");
  for (var i=0; i < TDs.length; i++) {
    var element = TDs[i];
    // Check if the TD found is one of the Page Items header
    // This can only be an approximation as some TDs other than the actual field prompts
    // may contain the same caption. In that case all TDs found will carry the same ID.
    if (element.className == "ThRows" || element.className == "TrOdd") {
      for (var f=0; f < qsPageItemsCount; f++) {
        if (element.innerHTML == fieldPrompts[f]) {
            element.id = fieldTechNames[f] + "_caption_cell";
          element.innerHTML = "<div id='" + fieldTechNames[f] + "_caption_div'>" + element.innerHTML + "</div>";
        }
      }
    }
  }

  // STEP 2: Assign an ID to all Input controls on the form
  document.getElementsByName("edit_fd0")[0].id = fieldTechNames[_Position];
  document.getElementsByName("edit_fd1")[0].id = fieldTechNames[_IDNo];
  document.getElementsByName("edit_fd2")[0].id = fieldTechNames[_Limit];
}

// This function defines object names for all page items used on the page.
// You can refer to these objects in your JavaScript code and avoid getElementById().
// Entry Fields (when present) are accessible via their technical names.
// The prompts of Entry Fields (when present) are accessible using SomeItemName_Prompt object names.
// 
function qsPageItemsAbstraction() {
  qs_form                                  = document.getElementsByName("qs_edit_form")[0];   //Define Form Object by Name.
  pgitm_Position                           = document.getElementsByName("edit_fd0")[0];
  pgitm_IDNo		                       = document.getElementsByName("edit_fd1")[0];
  pgitm_Limit 		                       = document.getElementsByName("edit_fd2")[0];
}

</script>



<script type="text/javascript">

// This function dynamically assigns custom events
// to page item controls on this page
function qsAssignPageItemEvents() {
}

</script>




<!-- >> START OF "Add Position ->
<style type="text/css">
<!--
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
-->
</style>
 Client Includes" [clientincludes] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]-->
<!-- << END OF "Add Position -> Client Includes" [clientincludes] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]-->




<script language="javascript">
function Trim(s){
    var temp = " ";
    var i = 0;
    while ((temp == " ") && (i <= s.length)) {
        temp = s.charAt(i);
        i++;
    }
    s = s.substring(i - 1, s.length);
    return(s);
}
function check(frm) {
    var szAlert = "Invalid\n";
    var nIndex = 0;
    if (!RequiredField(frm.edit_fd0.value)) {
        nIndex++;
        szAlert += "- " +"'Position' cannot be blank\n";
    }
    if (!RequiredField(frm.edit_fd1.value)) {
        nIndex++;
        szAlert += "- " +"'IDNo' cannot be blank\n";
    }
    if (!NumberValidate(frm.edit_fd1.value)) {
        nIndex++;
        szAlert += "- " +"'IDNo' invalid numeric format\n";
    }
	if (!RequiredField(frm.edit_fd2.value)) {
        nIndex++;
        szAlert += "- " +"'Limit' cannot be blank\n";
    }
    if (!NumberValidate(frm.edit_fd2.value)) {
        nIndex++;
        szAlert += "- " +"'Limitt' invalid numeric format\n";
    }
    if(nIndex > 0) {
       	alert(szAlert) ;
      	return false ;
    }
    return true ;
}
</script>
<script src="validate.js"></script>

<script>

function usrEvent__Add_Position__onload() {
  // >> START OF "Add Position -> On Load" [onload] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
  // << END OF "Add Position -> On Load" [onload] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
}



function usrEvent__Add_Position__onunload() {
  // >> START OF "Add Position -> On Unload" [onunload] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
  // << END OF "Add Position -> On Unload" [onunload] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
}



function usrEvent__Add_Position__onresize() {
  // >> START OF "Add Position -> On Resize" [onresize] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
  // << END OF "Add Position -> On Resize" [onresize] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
}



// This function controls the OnUnload event dispatching
function qsPageOnUnloadController() {   
}



// This function controls the OnResize event dispatching
function qsPageOnResizeController() {   
   var lastResult = false                              
   return true;                                        
}                                                      



// This function controls the OnLoad events dispatching
function qsPageOnLoadController() {   
   var lastResult = false                              

   // Invoke the technical field names abstraction initialization
   qsPageItemsAbstraction();


   // Invoke the Element IDs assignment function
   qsAssignElementIDs();

   // Invoke the Page Items custom events assignments
   qsAssignPageItemEvents();
   // Assign Event Handlers for page-level events
   YAHOO.util.Event.addListener(window, "beforeunload", qsPageOnUnloadController);
   YAHOO.util.Event.addListener(window, "resize", qsPageOnResizeController);
   // Set focus on first enterable page item available
  pgitm_Position.focus();
   return true;                                        
}                                                      


function usrEvent__Position__onfocus(HTMLElement) {
  // >> START OF "Position -> On Focus" [onfocus] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Focus" [onfocus] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onblur(HTMLElement) {
  // >> START OF "Position -> On Blur (loss of focus)" [onblur] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Blur (loss of focus)" [onblur] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onclick(HTMLElement) {
  // >> START OF "Position -> On Click" [onclick] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Click" [onclick] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__ondblclick(HTMLElement) {
  // >> START OF "Position -> On Double Click" [ondblclick] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Double Click" [ondblclick] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onkeydown(HTMLElement) {
  // >> START OF "Position -> On Key Down" [onkeydown] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Key Down" [onkeydown] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onkeypress(HTMLElement) {
  // >> START OF "Position -> On Key Press" [onkeypress] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Key Press" [onkeypress] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onkeyup(HTMLElement) {
  // >> START OF "Position -> On Key Up" [onkeyup] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Key Up" [onkeyup] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onchange(HTMLElement) {
  // >> START OF "Position -> On Change" [onchange] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Change" [onchange] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onmousedown(HTMLElement) {
  // >> START OF "Position -> On Mouse Down" [onmousedown] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Mouse Down" [onmousedown] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onmousemove(HTMLElement) {
  // >> START OF "Position -> On Mouse Move" [onmousemove] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Mouse Move" [onmousemove] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onmouseout(HTMLElement) {
  // >> START OF "Position -> On Mouse Out" [onmouseout] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Mouse Out" [onmouseout] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onmouseover(HTMLElement) {
  // >> START OF "Position -> On Mouse Over" [onmouseover] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Mouse Over" [onmouseover] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onmouseup(HTMLElement) {
  // >> START OF "Position -> On Mouse Up" [onmouseup] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Mouse Up" [onmouseup] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}
function usrEvent__Position__onselect(HTMLElement) {
  // >> START OF "Position -> On Select" [onselect] [Position] [START] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
  // << END OF "Position -> On Select" [onselect] [Position] [STOP] [JS] [8907314B-B002-40E8-A4BA-5F25C2256272]
}

function usrEvent__Noparticipant__onfocus(HTMLElement) {
  // >> START OF "Noparticipant -> On Focus" [onfocus] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Focus" [onfocus] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onblur(HTMLElement) {
  // >> START OF "Noparticipant -> On Blur (loss of focus)" [onblur] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Blur (loss of focus)" [onblur] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onclick(HTMLElement) {
  // >> START OF "Noparticipant -> On Click" [onclick] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Click" [onclick] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__ondblclick(HTMLElement) {
  // >> START OF "Noparticipant -> On Double Click" [ondblclick] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Double Click" [ondblclick] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onkeydown(HTMLElement) {
  // >> START OF "Noparticipant -> On Key Down" [onkeydown] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Key Down" [onkeydown] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onkeypress(HTMLElement) {
  // >> START OF "Noparticipant -> On Key Press" [onkeypress] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Key Press" [onkeypress] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onkeyup(HTMLElement) {
  // >> START OF "Noparticipant -> On Key Up" [onkeyup] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Key Up" [onkeyup] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onchange(HTMLElement) {
  // >> START OF "Noparticipant -> On Change" [onchange] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Change" [onchange] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onmousedown(HTMLElement) {
  // >> START OF "Noparticipant -> On Mouse Down" [onmousedown] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Mouse Down" [onmousedown] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onmousemove(HTMLElement) {
  // >> START OF "Noparticipant -> On Mouse Move" [onmousemove] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Mouse Move" [onmousemove] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onmouseout(HTMLElement) {
  // >> START OF "Noparticipant -> On Mouse Out" [onmouseout] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Mouse Out" [onmouseout] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onmouseover(HTMLElement) {
  // >> START OF "Noparticipant -> On Mouse Over" [onmouseover] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Mouse Over" [onmouseover] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onmouseup(HTMLElement) {
  // >> START OF "Noparticipant -> On Mouse Up" [onmouseup] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Mouse Up" [onmouseup] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}
function usrEvent__Noparticipant__onselect(HTMLElement) {
  // >> START OF "Noparticipant -> On Select" [onselect] [Noparticipant] [START] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
  // << END OF "Noparticipant -> On Select" [onselect] [Noparticipant] [STOP] [JS] [359AD800-3FF3-4FBB-A662-7F85BBB60A80]
}


function usrEvent__Add_Position__onsubmit(frm) {
  // >> START OF "Add Position -> On Submit" [onsubmit] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
  // << END OF "Add Position -> On Submit" [onsubmit] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
}



function usrEvent__Add_Position__onreset() {
  // >> START OF "Add Position -> On Reset" [onreset] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
  // << END OF "Add Position -> On Reset" [onreset] [PAGEEVENT] [START] [JS] [A264334D-AA43-44B0-B687-0E046636F006]
}



// This function controls the OnSubmit event dispatching
function qsFormOnSubmitController(frm) {                 
   var lastResult = false                              
   // Call the standard dbQwikSite form validation rules
   lastResult = check(frm);                            
   if (lastResult == false) {                          
      return false;                                    
   }                                                   
   return true;                                        
}                                                      



// This function controls the OnReset event dispatching
function qsPageOnResetController() {   
   var lastResult = false                              
   return true;                                        
}                                                      


</script>

<script language='javascript' src='qwikcalendar.js'></script>

<meta name="generator" content="dbQwikSite Ecommerce"><meta name="dbQwikSitePE" content="QSFREEPE">
</HEAD>

<BODY>

<Center>
<center><hr />
  <span class="style1"><font size="5">
Add Position
  </font></span>
  <hr /></center><br>

<?php
// >> START OF "after page header" [HEADER001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after page header" [HEADER001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
<A NAME=top></A>

<table id="QS_Content_Layout_1_Table">
  <tr id="QS_Content_Layout_1_TopRow">
    <td id="QS_Content_Layout_1_NorthWest">
        <div id="QS_Content_Layout_1_NorthWestDiv"></div>
    </td>
    <td id="QS_Content_Layout_1_North">
            <div id="QS_Content_Layout_1_NorthDiv">
<?php
// >> START OF "content layout 1 - north" [CONTENTLAYOUT_1_N] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "content layout 1 - north" [CONTENTLAYOUT_1_N] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
        </div>
    </td>
    <td id="QS_Content_Layout_1_NorthEast">
        <div id="QS_Content_Layout_1_NorthEastDiv"></div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_MiddleRow">
    <td id="QS_Content_Layout_1_West">
        <div id="QS_Content_Layout_1_WestDiv"></div>
    </td>
    <td id="QS_Content_Layout_1_Center">
            <div id="QS_Content_Layout_1_CenterDiv">
<?php
// >> START OF "content layout 1 - center (before contents)" [CONTENTLAYOUT_1_C] [PRE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "content layout 1 - center (before contents)" [CONTENTLAYOUT_1_C] [PRE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>


<script>
function getURLParam(strParamName){
var strReturn = "";
var strHref = window.location.href;
if ( strHref.indexOf("?") > -1 ){
  var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
  var aQueryString = strQueryString.split("&");
  for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
    if (
	aQueryString[iParam].indexOf(strParamName + "=") > -1 ){
      var aParam = aQueryString[iParam].split("=");
      strReturn = aParam[1];
      break;
    }
  }
}
return strReturn;
}
</script>


<Form name="qs_add_form" method="post" action="./position_add.php" onSubmit="return qsFormOnSubmitController(this)"  onReset="return qsPageOnResetController(this)" >
<?php
// >> START OF "before add data form" [ADDFRM001] [PRE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before add data form" [ADDFRM001] [PRE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
<?php
print $hidden_tag;
?>
<Table Border="0" Cellpadding="2" Cellspacing="1" BgColor="#D4D4D4">

<?php
$css_class = "\"TrOdd\"";
?>
<tr>
<td colspan="2" class="ThRows">Add Position</td>
</tr>
<?php
if ($err_string != "") {
    print "<tr>";
    print "<td class=\"ThRows\"><Strong>Error:</Strong></td>";
    print "<td class=" . $css_class . " align=Default>" . $err_string . "</td>";
    print "</tr>";
}
?>

<tr>
<td class="ThRows">ID</td>
<?php

$autoID = mysql_query("SELECT * FROM position order by IDNo Desc");
$IDRes = mysql_fetch_array($autoID);

$cellvalue = "";
if ((!isset($_GET["add_fd1"])) && (!isset($_POST["add_fd1"]))) {
    $itemvalue =  $IDRes['IDNo'] + 1;
} else {
    $itemvalue = qsrequest("add_fd1");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd1\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" readonly=\"true\">";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }
// >> START OF "Noparticipant -> on write tags" [PGITMPREDENDER001] [INLINE] [START] [SRVITEM] [359AD800-3FF3-4FBB-A662-7F85BBB60A80] [Noparticipant]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "Noparticipant -> on write tags" [PGITMPREDENDER001] [INLINE] [STOP] [SRVITEM] [359AD800-3FF3-4FBB-A662-7F85BBB60A80] [Noparticipant]

    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Position</td>
<?php


$cellvalue ="";
if ((!isset($_GET["add_fd0"])) && (!isset($_POST["add_fd0"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd0");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd0\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" size=\"30\"  maxlength=\"50\" >";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }
// >> START OF "Position -> on write tags" [PGITMPREDENDER001] [INLINE] [START] [SRVITEM] [8907314B-B002-40E8-A4BA-5F25C2256272] [Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "Position -> on write tags" [PGITMPREDENDER001] [INLINE] [STOP] [SRVITEM] [8907314B-B002-40E8-A4BA-5F25C2256272] [Position]

    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Limit</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd2"])) && (!isset($_POST["add_fd2"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd2");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd2\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\">";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }
// >> START OF "Noparticipant -> on write tags" [PGITMPREDENDER001] [INLINE] [START] [SRVITEM] [359AD800-3FF3-4FBB-A662-7F85BBB60A80] [Noparticipant]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "Noparticipant -> on write tags" [PGITMPREDENDER001] [INLINE] [STOP] [SRVITEM] [359AD800-3FF3-4FBB-A662-7F85BBB60A80] [Noparticipant]

    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<?php
#----get back url page----
  $backurl = "./position.php?";
?>
<tr>
<td class="ThRows">&nbsp;</td>
<td class="TrOdd" align=Default>
<input type="hidden" name="act" value="n">
<input type="button" name="QS_Back" value="Back" OnClick="javascript:window.location='<?php print $backurl; ?>'">&nbsp;&nbsp;
<input type="submit" name="QS_Submit" value="Add">&nbsp;&nbsp;
<input type="reset" name="QS_Reset" value="Reset">
</td>
</tr>
</Table><br>
</Form>
<?php
// >> START OF "after add data form" [ADDFRM001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after add data form" [ADDFRM001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
<?php
if ($result > 0) {mysql_free_result($result);}
if ($link > 0) {mysql_close($link);}
?>
<?php
// >> START OF "content layout 1 - center (after contents)" [CONTENTLAYOUT_1_C] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "content layout 1 - center (after contents)" [CONTENTLAYOUT_1_C] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
        </div>
    </td>
    <td id="QS_Content_Layout_1_East">
        <div id="QS_Content_Layout_1_EastDiv"></div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_BottomRow">
    <td id="QS_Content_Layout_1_SouthWest">
        <div id="QS_Content_Layout_1_SouthWestDiv"></div>
    </td>
    <td id="QS_Content_Layout_1_South">
            <div id="QS_Content_Layout_1_SouthDiv">
<?php
// >> START OF "content layout 1 - south" [CONTENTLAYOUT_1_S] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "content layout 1 - south" [CONTENTLAYOUT_1_S] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
        </div>
    </td>
    <td id="QS_Content_Layout_1_SouthEast">
        <div id="QS_Content_Layout_1_SouthEastDiv"></div>
    </td>
  </tr>
</table>

<A NAME=bottom></A>
<?php
// >> START OF "before page footer" [FOOTER001] [PRE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "before page footer" [FOOTER001] [PRE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
</Center>

<?php
// >> START OF "after page footer" [FOOTER001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after page footer" [FOOTER001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
<?php
// >> START OF "after page body" [BODY001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after page body" [BODY001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
</BODY>
<?php
// >> START OF "after page html" [HTML001] [POST] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "after page html" [HTML001] [POST] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
</HTML>
<?php
// >> START OF "on end of page" [EOF001] [INLINE] [START] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
//-- Your custom code starts here --
//-- Your custom code ends here --
// << END OF "on end of page" [EOF001] [INLINE] [STOP] [SRV] [A264334D-AA43-44B0-B687-0E046636F006] [Add Position]
?>
