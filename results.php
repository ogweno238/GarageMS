
<?php
 

require_once('admin_users.php');
require_once('functions.php');
$
$err_string = "";

@session_start();
$_SESSION["Admin_UserLogon"] = ""
?>
<HTML>

<HEAD>

<Title>SAKU DOCKETS</Title>
<meta http-equiv="" content="3" >

<script type="text/javascript">

var qsPageItemsCount = 3
var _Studid                                   = 0;
var _Password                                 = 1;
var _Leve                                     = 2;

// Declare Fields Prompts
var fieldPrompts = [];
fieldPrompts[_Studid] = "Studid";
fieldPrompts[_Password] = "Password";
fieldPrompts[_Leve] = "Leve";

// Declare Fields Technical Names
var fieldTechNames = [];
fieldTechNames[_Studid] = "Studid";
fieldTechNames[_Password] = "Password";
fieldTechNames[_Leve] = "Leve";

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
  document.getElementsByName("4")[0].id = fieldTechNames[_Studid];
  document.getElementsByName("5")[0].id = fieldTechNames[_Password];
}

function qsPageItemsAbstraction() {
  qs_form                                  = document.getElementsByName("qs_login_form")[0];   //Define Form Object by Name.



}

</script>



<script type="text/javascript">

// This function dynamically assigns custom events
// to page item controls on this page
function qsAssignPageItemEvents() {
}

</script>


</style>
 
<script>

function usrEvent__Login_To_Admin__onload() { }
function usrEvent__Login_To_Admin__onunload() { }
function usrEvent__Login_To_Admin__onresize() { }

// This function controls the OnUnload event dispatching
function qsPageOnUnloadController() { }

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
  document.getElementsByName("User")[0].focus(); 
   return true;                                        
}                                                      

function usrEvent__Login_To_Admin__onsubmit(frm) { }
function usrEvent__Login_To_Admin__onreset() { }

// This function controls the OnSubmit event dispatching
function qsFormOnSubmitController(frm) {                 
   var lastResult = false                              
   return true;                                        
}                                                      

// This function controls the OnReset event dispatching
function qsPageOnResetController() {   
   var lastResult = false                              
   return true;                                        
}                                                      


</script>

<style type="text/css">
<!--
.style1 {font-size: 16px}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="icon" type="image/png" href="pictures/KCA.png" /></HEAD>
<style type="text/css">
<!-- DIV.scrambledGenWarning {display:block;text-align:center;width:320px;position:absolute;top:130px;right:10px;border:1px solid #cc9911;background:#FEFFCE;padding:2px 0 8px 8px;font-weight: bold;font-family:Arial;font-size: 12px;font-weight: normal; color: black} .style6 {font-size: 24px}
.style12 {
	color: #6600FF;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
--> 
</style><BODY>
<center>
KCA UNIVERSITY ELECTION<span>&nbsp;ONGOING RESULTS</span>
<p align="center"><table width="100%" border="0" style="position:absolute;left:320px;">
  <tr>
    <td width="634">
    <Table width="622" height="85" border="1">
        <?php 

$sqlcandi = mysql_query("select * from position order by IDNo");
while($rowcandi=mysql_fetch_array($sqlcandi))
{
?>
        <tr>
          <td colspan="3" align="center" class="ThRows style1"><span class="style6"><?php echo $rowcandi['position']; ?></span> </td>
        </tr>
        <?php
  $sqlvote6 = mysql_query("select * from candidate where position = '".$rowcandi['position']."' order by position, votecount desc");
	$stud_query=mysql_query("SELECT * FROM students");
	$tot_stud = mysql_num_rows($stud_query);
while($row16 = mysql_fetch_array($sqlvote6)) {
$percent = ($row16[votecount]/$tot_stud)*100;

?>
        <tr>
          <td width="249" class="TrOdd"><span class="style6"><?php echo $row16['name']; ?></span></td>
          <td width="204" class="TrOdd"><span class="style6"><?php echo $row16['votecount']." - ".number_format ($percent, 2, '.', ' ')." %"; ?></span></td>
          <td width="147" class="TrOdd"><TABLE bgColor=red
 height=20 width=<?php echo number_format ($percent, 2, '.', ' ')." %";  ?>
 cellSpacing=0 cellPadding=0 border= 0>
              <TR>
                <TD></TD>
              </TR>
          </TABLE></td>
        </tr>
        <?php
}
?>
        <tr>
          <td colspan="3" align="center" class="TrHover style6">&nbsp;</td>
        </tr>
        <?php
}
?>
      </Table></td>
    <td width="359" valign="top" nowrap>
      </td>
  </tr>
</table></p>
</Center>
</BODY>

</HTML>

