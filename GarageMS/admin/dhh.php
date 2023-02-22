<?php

require('dbconn.php');
require('canditate_fctns.php');

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
$formatdate[3] = "";
$formatdate[4] = "";
$formatdate[5] = "";
$formatdate[6] = "";
$formatdate[7] = "";
$seperatedate = array();
$seperatedate[0] = " ";
$seperatedate[1] = " ";
$seperatedate[2] = " ";
$seperatedate[3] = " ";
$seperatedate[4] = " ";
$seperatedate[5] = " ";
$seperatedate[6] = " ";
$seperatedate[7] = " ";
$sql .= " Select\n";
    $sql .= "     students.`studid`,\n";
    $sql .= "     students.`name`,\n";
    $sql .= "     students.`course`,\n";
    $sql .= "     students.`year`,\n";
    $sql .= "     students.`sec`,\n";
    $sql .= "     students.`password`,\n";
    $sql .= "     students.`sy`\n";
    $sql .= "     students.`leve`\n";
    $sql .= " From\n";
    $sql .= "     students   students\n";

//Field Related Declarations
$req_Studid          = "add_fd0";
$req_Name            = "add_fd1";
$req_Course          = "add_fd2";
$req_Year            = "add_fd3";
$req_Sec             = "add_fd4";
$req_Password        = "add_fd5";
$req_Sy              = "add_fd6";
$req_leve            = "add_fd7";

//Assign Recordset Field Index
$rs_idx_studid       = 0;
$rs_idx_name         = 1;
$rs_idx_course       = 2;
$rs_idx_year         = 3;
$rs_idx_sec          = 4;
$rs_idx_password     = 5;
$rs_idx_sy           = 6;
$rs_idx_leve         = 7;

if (isset($_POST["act"])) {
   $ProcessForm  = "Y"; 

   if ($ProcessForm  == "Y") { 
if (strpos(strtoupper($sql), " WHERE ")) {
   $sqltemp = $sql . " AND (1=0) ";
}else{
   $sqltemp = $sql . " Where (1=0) ";
}

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
$SourceFileUpload[3] = "";
$DestFileUpload[3] = "";
$NewFieldUpload[3] = "";
$SourceFileUpload[4] = "";
$DestFileUpload[4] = "";
$NewFieldUpload[4] = "";
$SourceFileUpload[5] = "";
$DestFileUpload[5] = "";
$NewFieldUpload[5] = "";
$SourceFileUpload[6] = "";
$DestFileUpload[6] = "";
$NewFieldUpload[6] = "";
$DestFileUpload[7] = "";
$NewFieldUpload[7] = "";
 
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

                    if ($insert_sql == "") {
                        $insert_sql .= $quotechar . $field_name . $quotechar;
                        $value_sql  .= $quotedate . qsconvertdate2ansi($idata,$formatdate[$i],$seperatedate[$i]) .  $quotedate;
                    } else {
                        $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                        $value_sql  .= "," . $quotedate . qsconvertdate2ansi($idata,$formatdate[$i],$seperatedate[$i]) .$quotedate;
                    }
            } elseif ($type_field == "type_integer") {
                $idata = QSConvert2EngNumber($idata); 

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

                if ($insert_sql == "") {
                    $insert_sql .= $quotechar . $field_name . $quotechar;
                    $value_sql  .= "'" . preg_replace("{'}","''",stripslashes($idata)) . "'";
                } else {
                    $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                    $value_sql  .= ",'" . preg_replace("{'}","''",stripslashes($idata)) . "'";
                }
            } else {


                if ($insert_sql == "") {
                    $insert_sql .= $quotechar . $field_name . $quotechar;
                    $value_sql  .= "'" . preg_replace("{'}","''",stripslashes($idata)) . "'";
                } else {
                    $insert_sql .= "," . $quotechar . $field_name . $quotechar;
                    $value_sql  .= ",'" . preg_replace("{'}","''",stripslashes($idata)) . "'";
                }
            }

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

    $submiturl = "index.php?";
    if ($result > 0) {mysql_free_result($result);}
    if (!$result = @mysql_query($sql)){
        $err_string .= "<strong>Error:</strong>while adding<br>" . mysql_error();

    } else { 

    }

    if ($err_string == "") { 
       for ($i = 0; $i < 8; $i++)  
       { 
          if ($SourceFileUpload[$i] <> "") { 
              if (!(move_uploaded_file($SourceFileUpload[$i], $DestFileUpload[$i]))) {    // Upload Fail 
                  $err_string = 	"Cannot upload file! There is problem occured when upload."	; 

                } 
          } //end if  
       } 
    } //end if error string  

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

<Title>Add Students</Title>

<link rel="stylesheet" href="admin.css">

<script type="text/javascript">

// Declares all constants and arrays
// for all page items used on the page

// Declare Field Indexes for all page items
var qsPageItemsCount = 7
var _Studid                                   = 0;
var _Name                                     = 1;
var _Course                                   = 2;
var _Year                                     = 3;
var _Sec                                      = 4;
var _Password                                 = 5;
var _Sy                                       = 6;
var _leve                                     = 7;

// Declare Fields Prompts
var fieldPrompts = [];
fieldPrompts[_Studid] = "Studid";
fieldPrompts[_Name] = "Name";
fieldPrompts[_Course] = "Course";
fieldPrompts[_Year] = "Year";
fieldPrompts[_Sec] = "Sec";
fieldPrompts[_Password] = "Password";
fieldPrompts[_Sy] = "Sy";
fieldPrompts[_leve] = "leve";

// Declare Fields Technical Names
var fieldTechNames = [];
fieldTechNames[_Studid] = "Studid";
fieldTechNames[_Name] = "Name";
fieldTechNames[_Course] = "Course";
fieldTechNames[_Year] = "Year";
fieldTechNames[_Sec] = "Sec";
fieldTechNames[_Password] = "Password";
fieldTechNames[_Sy] = "Sy";
fieldTechNames[_leve] = "leve";

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
  document.getElementsByName("add_fd0")[0].id = fieldTechNames[_Studid];
  document.getElementsByName("add_fd1")[0].id = fieldTechNames[_Name];
  document.getElementsByName("add_fd2")[0].id = fieldTechNames[_Course];
  document.getElementsByName("add_fd3")[0].id = fieldTechNames[_Year];
  document.getElementsByName("add_fd4")[0].id = fieldTechNames[_Sec];
  document.getElementsByName("add_fd5")[0].id = fieldTechNames[_Password];
  document.getElementsByName("add_fd6")[0].id = fieldTechNames[_Sy];
  document.getElementsByName("add_fd7")[0].id = fieldTechNames[_leve];
}

// This function defines object names for all page items used on the page.
// You can refer to these objects in your JavaScript code and avoid getElementById().
// Entry Fields (when present) are accessible via their technical names.
// The prompts of Entry Fields (when present) are accessible using SomeItemName_Prompt object names.
// 
function qsPageItemsAbstraction() {
  qs_form                                  = document.getElementsByName("qs_add_form")[0];   //Define Form Object by Name.
  pgitm_Studid                             = document.getElementsByName("add_fd0")[0];
  pgitm_Name                               = document.getElementsByName("add_fd1")[0];
  pgitm_Course                             = document.getElementsByName("add_fd2")[0];
  pgitm_Year                               = document.getElementsByName("add_fd3")[0];
  pgitm_Sec                                = document.getElementsByName("add_fd4")[0];
  pgitm_Password                           = document.getElementsByName("add_fd5")[0];
  pgitm_Sy                                 = document.getElementsByName("add_fd6")[0];
  pgitm_leve                               = document.getElementsByName("add_fd7")[0];
}

</script>



<script type="text/javascript">

// This function dynamically assigns custom events
// to page item controls on this page
function qsAssignPageItemEvents() {
}

</script>




<!-- >> START OF "Add Students ->
<style type="text/css">
<!--
.style1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
-->
</style>

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
    if (!RequiredField(frm.add_fd0.value)) {
        nIndex++;
        szAlert += "- " +"'Studid' cannot be blank\n";
    }
    if (!RequiredField(frm.add_fd1.value)) {
        nIndex++;
        szAlert += "- " +"'Name' cannot be blank\n";
    }
    if (!RequiredField(frm.add_fd2.value)) {
        nIndex++;
        szAlert += "- " +"'Course' cannot be blank\n";
    }
    if (!RequiredField(frm.add_fd3.value)) {
        nIndex++;
        szAlert += "- " +"'Year' cannot be blank\n";
    }
    if (!RequiredField(frm.add_fd4.value)) {
        nIndex++;
        szAlert += "- " +"'Sec' cannot be blank\n";
    }
    if (!RequiredField(frm.add_fd5.value)) {
        nIndex++;
        szAlert += "- " +"'Password' cannot be blank\n";
    }
    if (!RequiredField(frm.add_fd6.value)) {
        nIndex++;
        szAlert += "- " +"'Sy' cannot be blank\n";
    }
	 if (!RequiredField(frm.add_fd7.value)) {
        nIndex++;
        szAlert += "- " +"'leve' cannot be blank\n";
    }
    if(nIndex > 0) {
       	alert(szAlert) ;
      	return false ;
    }
    return true ;
}
</script>
<script>

function usrEvent__Add_Students__onload() {
  // >> START OF "Add Students -> On Load" [onload] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
  // << END OF "Add Students -> On Load" [onload] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
}



function usrEvent__Add_Students__onunload() {
  // >> START OF "Add Students -> On Unload" [onunload] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
  // << END OF "Add Students -> On Unload" [onunload] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
}



function usrEvent__Add_Students__onresize() {
  // >> START OF "Add Students -> On Resize" [onresize] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
  // << END OF "Add Students -> On Resize" [onresize] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
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
  pgitm_Studid.focus();
   return true;                                        
}                                                      


function usrEvent__Studid__onfocus(HTMLElement) {
  // >> START OF "Studid -> On Focus" [onfocus] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Focus" [onfocus] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onblur(HTMLElement) {
  // >> START OF "Studid -> On Blur (loss of focus)" [onblur] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Blur (loss of focus)" [onblur] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onclick(HTMLElement) {
  // >> START OF "Studid -> On Click" [onclick] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Click" [onclick] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__ondblclick(HTMLElement) {
  // >> START OF "Studid -> On Double Click" [ondblclick] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Double Click" [ondblclick] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onkeydown(HTMLElement) {
  // >> START OF "Studid -> On Key Down" [onkeydown] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Key Down" [onkeydown] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onkeypress(HTMLElement) {
  // >> START OF "Studid -> On Key Press" [onkeypress] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Key Press" [onkeypress] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onkeyup(HTMLElement) {
  // >> START OF "Studid -> On Key Up" [onkeyup] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Key Up" [onkeyup] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onchange(HTMLElement) {
  // >> START OF "Studid -> On Change" [onchange] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Change" [onchange] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onmousedown(HTMLElement) {
  // >> START OF "Studid -> On Mouse Down" [onmousedown] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Mouse Down" [onmousedown] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onmousemove(HTMLElement) {
  // >> START OF "Studid -> On Mouse Move" [onmousemove] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Mouse Move" [onmousemove] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onmouseout(HTMLElement) {
  // >> START OF "Studid -> On Mouse Out" [onmouseout] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Mouse Out" [onmouseout] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onmouseover(HTMLElement) {
  // >> START OF "Studid -> On Mouse Over" [onmouseover] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Mouse Over" [onmouseover] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onmouseup(HTMLElement) {
  // >> START OF "Studid -> On Mouse Up" [onmouseup] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Mouse Up" [onmouseup] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}
function usrEvent__Studid__onselect(HTMLElement) {
  // >> START OF "Studid -> On Select" [onselect] [Studid] [START] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
  // << END OF "Studid -> On Select" [onselect] [Studid] [STOP] [JS] [7182C567-D00E-4EF8-9977-C6418A55364B]
}

function usrEvent__Name__onfocus(HTMLElement) {
  // >> START OF "Name -> On Focus" [onfocus] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Focus" [onfocus] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onblur(HTMLElement) {
  // >> START OF "Name -> On Blur (loss of focus)" [onblur] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Blur (loss of focus)" [onblur] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onclick(HTMLElement) {
  // >> START OF "Name -> On Click" [onclick] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Click" [onclick] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__ondblclick(HTMLElement) {
  // >> START OF "Name -> On Double Click" [ondblclick] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Double Click" [ondblclick] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onkeydown(HTMLElement) {
  // >> START OF "Name -> On Key Down" [onkeydown] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Key Down" [onkeydown] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onkeypress(HTMLElement) {
  // >> START OF "Name -> On Key Press" [onkeypress] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Key Press" [onkeypress] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onkeyup(HTMLElement) {
  // >> START OF "Name -> On Key Up" [onkeyup] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Key Up" [onkeyup] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onchange(HTMLElement) {
  // >> START OF "Name -> On Change" [onchange] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Change" [onchange] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onmousedown(HTMLElement) {
  // >> START OF "Name -> On Mouse Down" [onmousedown] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Mouse Down" [onmousedown] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onmousemove(HTMLElement) {
  // >> START OF "Name -> On Mouse Move" [onmousemove] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Mouse Move" [onmousemove] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onmouseout(HTMLElement) {
  // >> START OF "Name -> On Mouse Out" [onmouseout] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Mouse Out" [onmouseout] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onmouseover(HTMLElement) {
  // >> START OF "Name -> On Mouse Over" [onmouseover] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Mouse Over" [onmouseover] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onmouseup(HTMLElement) {
  // >> START OF "Name -> On Mouse Up" [onmouseup] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Mouse Up" [onmouseup] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}
function usrEvent__Name__onselect(HTMLElement) {
  // >> START OF "Name -> On Select" [onselect] [Name] [START] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
  // << END OF "Name -> On Select" [onselect] [Name] [STOP] [JS] [4C1A0BF0-746B-41B3-911F-F36DEC90E985]
}

function usrEvent__Course__onfocus(HTMLElement) {
  // >> START OF "Course -> On Focus" [onfocus] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Focus" [onfocus] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onblur(HTMLElement) {
  // >> START OF "Course -> On Blur (loss of focus)" [onblur] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Blur (loss of focus)" [onblur] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onclick(HTMLElement) {
  // >> START OF "Course -> On Click" [onclick] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Click" [onclick] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__ondblclick(HTMLElement) {
  // >> START OF "Course -> On Double Click" [ondblclick] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Double Click" [ondblclick] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onkeydown(HTMLElement) {
  // >> START OF "Course -> On Key Down" [onkeydown] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Key Down" [onkeydown] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onkeypress(HTMLElement) {
  // >> START OF "Course -> On Key Press" [onkeypress] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Key Press" [onkeypress] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onkeyup(HTMLElement) {
  // >> START OF "Course -> On Key Up" [onkeyup] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Key Up" [onkeyup] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onchange(HTMLElement) {
  // >> START OF "Course -> On Change" [onchange] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Change" [onchange] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onmousedown(HTMLElement) {
  // >> START OF "Course -> On Mouse Down" [onmousedown] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Mouse Down" [onmousedown] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onmousemove(HTMLElement) {
  // >> START OF "Course -> On Mouse Move" [onmousemove] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Mouse Move" [onmousemove] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onmouseout(HTMLElement) {
  // >> START OF "Course -> On Mouse Out" [onmouseout] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Mouse Out" [onmouseout] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onmouseover(HTMLElement) {
  // >> START OF "Course -> On Mouse Over" [onmouseover] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Mouse Over" [onmouseover] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onmouseup(HTMLElement) {
  // >> START OF "Course -> On Mouse Up" [onmouseup] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Mouse Up" [onmouseup] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}
function usrEvent__Course__onselect(HTMLElement) {
  // >> START OF "Course -> On Select" [onselect] [Course] [START] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
  // << END OF "Course -> On Select" [onselect] [Course] [STOP] [JS] [D88142CB-36E9-40EB-9FD6-24777469B83C]
}

function usrEvent__Year__onfocus(HTMLElement) {
  // >> START OF "Year -> On Focus" [onfocus] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Focus" [onfocus] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onblur(HTMLElement) {
  // >> START OF "Year -> On Blur (loss of focus)" [onblur] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Blur (loss of focus)" [onblur] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onclick(HTMLElement) {
  // >> START OF "Year -> On Click" [onclick] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Click" [onclick] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__ondblclick(HTMLElement) {
  // >> START OF "Year -> On Double Click" [ondblclick] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Double Click" [ondblclick] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onkeydown(HTMLElement) {
  // >> START OF "Year -> On Key Down" [onkeydown] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Key Down" [onkeydown] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onkeypress(HTMLElement) {
  // >> START OF "Year -> On Key Press" [onkeypress] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Key Press" [onkeypress] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onkeyup(HTMLElement) {
  // >> START OF "Year -> On Key Up" [onkeyup] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Key Up" [onkeyup] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onchange(HTMLElement) {
  // >> START OF "Year -> On Change" [onchange] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Change" [onchange] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onmousedown(HTMLElement) {
  // >> START OF "Year -> On Mouse Down" [onmousedown] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Mouse Down" [onmousedown] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onmousemove(HTMLElement) {
  // >> START OF "Year -> On Mouse Move" [onmousemove] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Mouse Move" [onmousemove] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onmouseout(HTMLElement) {
  // >> START OF "Year -> On Mouse Out" [onmouseout] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Mouse Out" [onmouseout] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onmouseover(HTMLElement) {
  // >> START OF "Year -> On Mouse Over" [onmouseover] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Mouse Over" [onmouseover] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}
function usrEvent__Year__onmouseup(HTMLElement) {
  // >> START OF "Year -> On Mouse Up" [onmouseup] [Year] [START] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
  // << END OF "Year -> On Mouse Up" [onmouseup] [Year] [STOP] [JS] [DF6CBBEF-15C9-474C-A2C3-DE89B3481CB1]
}

function usrEvent__Sec__onfocus(HTMLElement) {
  // >> START OF "Sec -> On Focus" [onfocus] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Focus" [onfocus] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onblur(HTMLElement) {
  // >> START OF "Sec -> On Blur (loss of focus)" [onblur] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Blur (loss of focus)" [onblur] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onclick(HTMLElement) {
  // >> START OF "Sec -> On Click" [onclick] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Click" [onclick] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__ondblclick(HTMLElement) {
  // >> START OF "Sec -> On Double Click" [ondblclick] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Double Click" [ondblclick] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onkeydown(HTMLElement) {
  // >> START OF "Sec -> On Key Down" [onkeydown] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Key Down" [onkeydown] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onkeypress(HTMLElement) {
  // >> START OF "Sec -> On Key Press" [onkeypress] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Key Press" [onkeypress] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onkeyup(HTMLElement) {
  // >> START OF "Sec -> On Key Up" [onkeyup] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Key Up" [onkeyup] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onchange(HTMLElement) {
  // >> START OF "Sec -> On Change" [onchange] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Change" [onchange] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onmousedown(HTMLElement) {
  // >> START OF "Sec -> On Mouse Down" [onmousedown] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Down" [onmousedown] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onmousemove(HTMLElement) {
  // >> START OF "Sec -> On Mouse Move" [onmousemove] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Move" [onmousemove] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onmouseout(HTMLElement) {
  // >> START OF "Sec -> On Mouse Out" [onmouseout] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Out" [onmouseout] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onmouseover(HTMLElement) {
  // >> START OF "Sec -> On Mouse Over" [onmouseover] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Over" [onmouseover] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onmouseup(HTMLElement) {
  // >> START OF "Sec -> On Mouse Up" [onmouseup] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Up" [onmouseup] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}

function usrEvent__Password__onfocus(HTMLElement) {
  // >> START OF "Password -> On Focus" [onfocus] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Focus" [onfocus] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onblur(HTMLElement) {
  // >> START OF "Password -> On Blur (loss of focus)" [onblur] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Blur (loss of focus)" [onblur] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onclick(HTMLElement) {
  // >> START OF "Password -> On Click" [onclick] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Click" [onclick] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__ondblclick(HTMLElement) {
  // >> START OF "Password -> On Double Click" [ondblclick] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Double Click" [ondblclick] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onkeydown(HTMLElement) {
  // >> START OF "Password -> On Key Down" [onkeydown] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Key Down" [onkeydown] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onkeypress(HTMLElement) {
  // >> START OF "Password -> On Key Press" [onkeypress] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Key Press" [onkeypress] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onkeyup(HTMLElement) {
  // >> START OF "Password -> On Key Up" [onkeyup] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Key Up" [onkeyup] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onchange(HTMLElement) {
  // >> START OF "Password -> On Change" [onchange] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Change" [onchange] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onmousedown(HTMLElement) {
  // >> START OF "Password -> On Mouse Down" [onmousedown] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Mouse Down" [onmousedown] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onmousemove(HTMLElement) {
  // >> START OF "Password -> On Mouse Move" [onmousemove] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Mouse Move" [onmousemove] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onmouseout(HTMLElement) {
  // >> START OF "Password -> On Mouse Out" [onmouseout] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Mouse Out" [onmouseout] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onmouseover(HTMLElement) {
  // >> START OF "Password -> On Mouse Over" [onmouseover] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Mouse Over" [onmouseover] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onmouseup(HTMLElement) {
  // >> START OF "Password -> On Mouse Up" [onmouseup] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Mouse Up" [onmouseup] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}
function usrEvent__Password__onselect(HTMLElement) {
  // >> START OF "Password -> On Select" [onselect] [Password] [START] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
  // << END OF "Password -> On Select" [onselect] [Password] [STOP] [JS] [7C8BEAF6-A6C5-47CF-B914-355BD7E8D973]
}

function usrEvent__Sy__onfocus(HTMLElement) {
  // >> START OF "Sy -> On Focus" [onfocus] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]

  // << END OF "Sy -> On Focus" [onfocus] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onblur(HTMLElement) {
  // >> START OF "Sy -> On Blur (loss of focus)" [onblur] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Blur (loss of focus)" [onblur] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onclick(HTMLElement) {
  // >> START OF "Sy -> On Click" [onclick] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Click" [onclick] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__ondblclick(HTMLElement) {
  // >> START OF "Sy -> On Double Click" [ondblclick] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Double Click" [ondblclick] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onkeydown(HTMLElement) {
  // >> START OF "Sy -> On Key Down" [onkeydown] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Key Down" [onkeydown] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onkeypress(HTMLElement) {
  // >> START OF "Sy -> On Key Press" [onkeypress] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Key Press" [onkeypress] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onkeyup(HTMLElement) {
  // >> START OF "Sy -> On Key Up" [onkeyup] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Key Up" [onkeyup] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onchange(HTMLElement) {
  // >> START OF "Sy -> On Change" [onchange] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Change" [onchange] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onmousedown(HTMLElement) {
  // >> START OF "Sy -> On Mouse Down" [onmousedown] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Mouse Down" [onmousedown] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onmousemove(HTMLElement) {
  // >> START OF "Sy -> On Mouse Move" [onmousemove] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Mouse Move" [onmousemove] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onmouseout(HTMLElement) {
  // >> START OF "Sy -> On Mouse Out" [onmouseout] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Mouse Out" [onmouseout] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onmouseover(HTMLElement) {
  // >> START OF "Sy -> On Mouse Over" [onmouseover] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Mouse Over" [onmouseover] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onmouseup(HTMLElement) {
  // >> START OF "Sy -> On Mouse Up" [onmouseup] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Mouse Up" [onmouseup] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__Sy__onselect(HTMLElement) {
  // >> START OF "Sy -> On Select" [onselect] [Sy] [START] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
  // << END OF "Sy -> On Select" [onselect] [Sy] [STOP] [JS] [01A07E77-9C34-4029-A981-1851CEF5B520]
}
function usrEvent__leve__onfocus(HTMLElement) {
  // >> START OF "Sec -> On Focus" [onfocus] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Focus" [onfocus] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onblur(HTMLElement) {
  // >> START OF "Sec -> On Blur (loss of focus)" [onblur] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Blur (loss of focus)" [onblur] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onclick(HTMLElement) {
  // >> START OF "Sec -> On Click" [onclick] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Click" [onclick] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__ondblclick(HTMLElement) {
  // >> START OF "Sec -> On Double Click" [ondblclick] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Double Click" [ondblclick] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onkeydown(HTMLElement) {
  // >> START OF "Sec -> On Key Down" [onkeydown] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Key Down" [onkeydown] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__Sec__onkeypress(HTMLElement) {
  // >> START OF "Sec -> On Key Press" [onkeypress] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Key Press" [onkeypress] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onkeyup(HTMLElement) {
  // >> START OF "Sec -> On Key Up" [onkeyup] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Key Up" [onkeyup] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onchange(HTMLElement) {
  // >> START OF "Sec -> On Change" [onchange] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Change" [onchange] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onmousedown(HTMLElement) {
  // >> START OF "Sec -> On Mouse Down" [onmousedown] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Down" [onmousedown] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onmousemove(HTMLElement) {
  // >> START OF "Sec -> On Mouse Move" [onmousemove] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Move" [onmousemove] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onmouseout(HTMLElement) {
  // >> START OF "Sec -> On Mouse Out" [onmouseout] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Out" [onmouseout] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onmouseover(HTMLElement) {
  // >> START OF "Sec -> On Mouse Over" [onmouseover] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Over" [onmouseover] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}
function usrEvent__leve__onmouseup(HTMLElement) {
  // >> START OF "Sec -> On Mouse Up" [onmouseup] [Sec] [START] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
  // << END OF "Sec -> On Mouse Up" [onmouseup] [Sec] [STOP] [JS] [FD7F7790-78A4-458D-82F8-B6CCB4EC7420]
}



function usrEvent__Add_Students__onsubmit(frm) {
  // >> START OF "Add Students -> On Submit" [onsubmit] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
  // << END OF "Add Students -> On Submit" [onsubmit] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
}



function usrEvent__Add_Students__onreset() {
  // >> START OF "Add Students -> On Reset" [onreset] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
  // << END OF "Add Students -> On Reset" [onreset] [PAGEEVENT] [START] [JS] [CB6E9536-76BF-4C45-80AC-6CD1898FEBFC]
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

<meta name="generator" content="dbQwikSite Ecommerce"><meta name="dbQwikSitePE" content="QSFREEPE">
</HEAD>
<Center>
<center><hr />
  <span class="style1"><font size="5">
Add Students
  </font></span>
  <hr /></center><br>


<A NAME=top></A>

<table id="QS_Content_Layout_1_Table">
  <tr id="QS_Content_Layout_1_TopRow">
    <td id="QS_Content_Layout_1_NorthWest">
            <div id="QS_Content_Layout_1_NorthWestDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_North">
            <div id="QS_Content_Layout_1_NorthDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_NorthEast">
            <div id="QS_Content_Layout_1_NorthEastDiv">

        </div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_MiddleRow">
    <td id="QS_Content_Layout_1_West">
            <div id="QS_Content_Layout_1_WestDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_Center">
            <div id="QS_Content_Layout_1_CenterDiv">



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


<Form name="qs_add_form" method="post" action="addstudents.php" onSubmit="return qsFormOnSubmitController(this)"  onReset="return qsPageOnResetController(this)" >

<?php
print $hidden_tag;
?>
<Table Border="0" Cellpadding="2" Cellspacing="1" BgColor="#D4D4D4">

<?php
$css_class = "\"TrOdd\"";
?>
<tr>
<td colspan="2" class="ThRows">Add Students</td>
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
<td class="ThRows">Student ID</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd0"])) && (!isset($_POST["add_fd0"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd0");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd0\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" size=\"30\"  maxlength=\"15\" >";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Name</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd1"])) && (!isset($_POST["add_fd1"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd1");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd1\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" size=\"30\"  maxlength=\"255\" >";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Course</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd2"])) && (!isset($_POST["add_fd2"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd2");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd2\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" size=\"30\"  maxlength=\"100\" >";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Year</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd3"])) && (!isset($_POST["add_fd3"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd3");
}

    $cellvalue = "<select name=\"add_fd3\" ><option value=\"\"" . qscheckselected("",$itemvalue,"selected") . ">-- Select --</option><option value=\"1st\"" . qscheckselected("1st",$itemvalue,"selected") . ">1st</option><option value=\"2nd\"" . qscheckselected("2nd",$itemvalue,"selected") . ">2nd</option><option value=\"3rd\"" . qscheckselected("3rd",$itemvalue,"selected") . ">3rd</option><option value=\"4th\"" . qscheckselected("4th",$itemvalue,"selected") . ">4th</option></select>";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Sec/stage</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd4"])) && (!isset($_POST["add_fd4"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd4");
}

    $cellvalue = "<select name=\"add_fd4\" ><option value=\"\"" . qscheckselected("",$itemvalue,"selected") . ">-- Select --</option><option value=\"1\"" . qscheckselected("1",$itemvalue,"selected") . ">1</option><option value=\"2\"" . qscheckselected("2",$itemvalue,"selected") . ">2</option><option value=\"3\"" . qscheckselected("3",$itemvalue,"selected") . ">3</option><option value=\"4\"" . qscheckselected("4",$itemvalue,"selected") . ">4</option><option value=\"5\"" . qscheckselected("5",$itemvalue,"selected") . ">5</option><option value=\"6\"" . qscheckselected("6",$itemvalue,"selected") . ">6</option></select>";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Password</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd5"])) && (!isset($_POST["add_fd5"]))) {
	$itemvalue = substr(md5(rand()), 0, 6);


} else {
    $itemvalue = qsrequest("add_fd5");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd5\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" size=\"30\"  maxlength=\"15\" >";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Year</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd6"])) && (!isset($_POST["add_fd6"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd6");
}

    $cellvalue = "<input type=\"text\" name=\"add_fd6\" value=\"" . qsreplace_html_quote(stripslashes($itemvalue)) . "\" size=\"30\"  maxlength=\"15\" >";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }

    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<tr>
<td class="ThRows">Faculty Code</td>
<?php
$cellvalue = "";
if ((!isset($_GET["add_fd7"])) && (!isset($_POST["add_fd7"]))) {
    $itemvalue = "";
} else {
    $itemvalue = qsrequest("add_fd7");
}

    $cellvalue = "<select name=\"add_fd7\" ><option value=\"\"" . qscheckselected("",$itemvalue,"selected") . ">-- Select --</option><option value=\"1\"" . qscheckselected("4",$itemvalue,"selected") . ">4</option><option value=\"3\"" . qscheckselected("3",$itemvalue,"selected") . ">3</option><option value=\"2\"" . qscheckselected("2",$itemvalue,"selected") . ">2</option><option value=\"1\"" . qscheckselected("1",$itemvalue,"selected") . ">1</option></select>";
    if ($cellvalue == "") {
        $cellvalue = "&nbsp;";
    }


    print "<td class=" . $css_class . " align=Default >" . $cellvalue . "</td>";
?>
</tr>
<?php
#----get back url page----
  $backurl = "index.php?";
?>
<tr>
<td class="ThRows">&nbsp;</td>
<td class="TrOdd" align=Default>
<input type="hidden" name="act" value="n">
<input type="button" name="QS_Back" value="Back" OnClick="javascript:window.location='<?php print $backurl; ?>'"><br />
<input type="submit" name="QS_Submit" value="Add"><br />
<input type="reset" name="QS_Reset" value="Reset">
</td>
</tr>
</Table><br>
</Form>

<?php
if ($result > 0) {mysql_free_result($result);}
if ($link > 0) {mysql_close($link);}
?>

        </div>
    </td>
    <td id="QS_Content_Layout_1_East">
            <div id="QS_Content_Layout_1_EastDiv">

        </div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_BottomRow">
    <td id="QS_Content_Layout_1_SouthWest">
            <div id="QS_Content_Layout_1_SouthWestDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_South">
            <div id="QS_Content_Layout_1_SouthDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_SouthEast">
            <div id="QS_Content_Layout_1_SouthEastDiv">
     </div>
    </td>
  </tr>
</table>

<A NAME=bottom></A>

</Center>

</BODY>

</HTML>

