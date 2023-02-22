
<!-- modal -->

<div id="admin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    </div>
    <div class="modal-body">

        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Login Admin!</strong>&nbsp;Please Enter the Details Below.
        </div>
        <form class="form-horizontal" action="admin/login.php" method="post" id="loginForm">
							  <div class="control-group">
									<label for="username" class="control-label">Username</label>
									<div class="controls">
									  <input type="text" class="form-control" id="username"  name="uname" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="control-group">
									<label for="password" class="control-label">Password</label>
									<div class="controls">
									  <input type="password" class="form-control" id="password" name="pword" placeholder="Password" autocomplete="off" />
									</div>
								</div>


            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-info"><i class="icon-signin icon-large"></i>&nbsp;Sign in</button>
                </div>


            </div>
        </form>


        <!-- teacher -->




    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign icon-large"></i>&nbsp;Close</button>

    </div>
</div

><!-- end modal -->
