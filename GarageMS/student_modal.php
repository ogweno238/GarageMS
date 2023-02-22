
<?php
 
require('conn.php');
require_once('admin_users.php');
require_once('functions.php');

?><!-- modal -->

<div id="driver" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    </div>
    <div class="modal-body">
           <?php
							include('connect.php');
							$result = $db->prepare("SELECT * FROM falied");
							$result->execute();
							for($i=0; $row = $result->fetch(); $i++){
							$gcvgvc=$row['attempt'];
							$tttt=$row['time'];
							}
							$kjkjk=date('H:i:s');
								$time1 = strtotime($kjkjk);
								$time2 = strtotime($tttt);
								$diff = $time1 - $time2;
								if($diff>59){
									$mm=0;
									$sql = "UPDATE falied 
                    SET attempt=?";
                    $q = $db->prepare($sql);
                    $q->execute(array($mm));
								}
							if($gcvgvc<=2){
							?>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Driver Login!</strong>&nbsp;Please Enter the Details Below.
        </div>
        <form class="form-horizontal" method="post" action="login.php">
        <?php
								?>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Username</label>
                <div class="controls">
                    <input type="text" name="uname" id="inputEmail" placeholder="Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>
                <div class="controls">
                    <input type="password" name="pword" id="inputPassword" placeholder="Password">
                </div>
            </div>


            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="login" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Sign in</button>
                </div>


            </div>

            



        </form>
  <?php
							}
							if($gcvgvc>=3){
							echo '<span style="color: #F00; font-weight: bold; padding-left: 40px;width: 420px;display: inline-block;">You Have Reach The Maximum Login Attempts, Pls. Try after 30mins, <a href="index.php"  role="button"  data-toggle="modal">Refresh</a> the page to try again.<span>';
							}
							?>

        <!-- teacher -->




    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign icon-large"></i>&nbsp;Close</button>

    </div>
</div

><!-- end modal -->