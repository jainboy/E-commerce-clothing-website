<?php
 include "./topbar.php";
 include './dbconnection/db.php';
?>
     <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1>New account</h1>
                <p class="lead">Not our registered customer yet?</p>
                <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="#">contact us</a>, our customer service center is working for you 24/7.</p>
                <hr>
                <form id="register-form" method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" class="form-control">
                  </div>
                  <span class="field_error" id="name_error"></span>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" class="form-control">
                  </div>
                  <span class="field_error" id="email_error"></span>
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input id="mobile"  name="mobile" type="text" class="form-control">
                  </div>
                  <span class="field_error" id="mobile_error"></span>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control">
                  </div>
                  <span class="field_error" id="password_error"></span>
                  <div class="text-center">
                    <button type="button"  onclick="user_register()" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                  </div>
                </form>
                <div class="form-output register_msg">
									<p class="form-messege field_error"></p>
								</div>
              </div>
            </div>

          <div class="col-lg-6">
              <div class="box">
                <h1>Login</h1>
                <p class="lead">Already our customer?</p>
                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <hr>
                <form id="login-form" method="post">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="login_email" name="login_email" type="text" class="form-control">
                  </div>
                  <span class="field_error" id="login_email_error"></span>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="login_password" name="login_password" type="password" class="form-control">
                  </div>
                  <span class="field_error" id="login_password_error"></span>
                  <div class="text-center">
                    <button type="button" onclick="user_login()" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </div>
                </form>
                <div class="form-output login_msg">
					<p class="form-messege field_error"></p>
				</div>
              </div>
			 
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
 include"./footer.php";
 ?>