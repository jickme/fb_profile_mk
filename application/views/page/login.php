
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Đăng nhập quản trị </title>

        <!-- App CSS -->
        <link href="<?=base_url()?>assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>

    </head>
    <body class="background_facebook">

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <div class="">
                <a href="" class="logo"><span>Login <span>Panel</span></span></a>
                <h5 class="text-white m-t-0 font-600">Để sử dụng hệ thống vui lòng đăng nhập</h5>
            </div>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                   <!--  <h4 class="text-uppercase font-bold m-b-0">Đăng nhập với Facebook</h4> -->
                </div>
                <div class="panel-body">

                    <div class="login-with-account">

                        <form id="login_with_account">
                          <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="nguyenvana@gmail.com" id="email">
                          </div>
                          <div class="form-group">
                            <label for="pwd">Mật khẩu:</label>
                            <input type="password" class="form-control" name="password" placeholder="***********" id="password">
                          </div>
                         <!--  <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Nhớ đăng nhập</label>
                          </div> -->
                          <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>
                    </div>
                    <hr>
                    <div class="login-with-facebook">	

                        <a class="btn btn-block btn-social btn-facebook" href="<?=$login_url?>">
                   				 <span class="fa fa-facebook"></span> Đăng nhập với Facebook
                 		</a>
                    </div>

                </div>
            </div>
            <!-- end card-box-->

            
            
        </div>
        <!-- end wrapper page -->
        

        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
		<script src="<?=base_url()?>assets/plugins/toastr/toastr.min.js"></script>
		<script src="<?=base_url()?>assets/js/main.js"></script>

    	<script>
			//toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!");
            
        </script>



	</body>
</html>