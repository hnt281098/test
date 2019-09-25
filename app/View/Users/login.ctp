<br/>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                	<?php echo $this->Session->flash('auth'); ?>
                    <form id="loginform" role="form" accept-charset="utf-8" method="post" action="/users/login">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="user[email]" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="user[password]" type="password" value="">
                            </div>
                            <div class="clearfix"></div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-success" type="submit">Login!........</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

