<!-- 
| Code by Jickme(Trí Nguyễn) 
| FB: fb.me/jickme
| SĐT: 0971 010 421
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Block">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Bạn đã bị chặn</title>

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
    <style type="text/css">
        body{
            background-image: url(https://cdn-images-1.medium.com/max/1920/1*gQvYLKW6kiXWR7HnF6eL3A.jpeg);
            background-size: cover;
        }
    </style>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <div class="">
                <a href="" class="logo"><span>System<span> CheckPoint</span></span></a>
                <h5 class="text-white m-t-0 font-600">Bạn đã bị chặn bởi hệ thống</h5>
            </div>
            </div>
        	<div class="m-t-40 card-box card_blur">
                <div class="text-center">
                  <h4 class="text-uppercase font-bold m-b-0 text-danger">BẠN ĐÃ BỊ CHẶN</h4>
                </div>
                <div class="panel-body">
                   <div class="text-center">
                       <img src="https://graph.fb.me/<?=$info['fb_id']?>/picture?width=150" alt="user-img" title="Block User" class="img-circle img-thumbnail img-responsive">
                       <br><br>
                        <div class="alert alert-danger">
                          <strong>Cảnh báo!</strong> Bạn đã bị chặn bởi hệ thống. Vui lòng liên hệ với quản trị viên để được giúp đỡ.
                        </div>
                        <a class="btn btn-primary" href="https://m.me/jickme" target="_blank">Liên hệ quản trị viên</a>
                        <a class="btn btn-danger" href="/Member/Logout">Đăng xuất</a>
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

    	



	</body>
</html>