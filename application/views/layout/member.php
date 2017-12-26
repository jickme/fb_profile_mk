<?php
if($info['active'] == '1'){
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Bot Facebook">
        <meta name="author" content="Jickme">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>/assets/images/favicon.ico">

        <!-- App title -->
        <title><?=$title?></title>

        <!-- App CSS -->
        <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <script src="<?=base_url()?>/assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/switchery/switchery.min.js"></script>
        
        <link href="<?=base_url()?>assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- Time picker -->
        <link href="<?=base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <?php
        if(isset($list_user)){
            ?>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>

            <?php
        }
        ?>
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo"><span>MARKET<span>ING</span></span><i class="zmdi zmdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title"><?=$title?></h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                              
                            </li>
                            <li class="hidden-xs">
                                <form role="search" class="app-search">
                                    <input type="text" placeholder="Tìm kiếm..."
                                           class="form-control" id="search_box">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            <img src="https://graph.fb.me/<?=$info['fb_id']?>/picture?width=150" alt="user-img" title="Avatar" class="img-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                        </div>
                        <h4 class="text-success"> <a class="text-success" href="https://fb.com/<?=$info['fb_id']?>" target="_blank"><?=$info['full_name']?></a> <i class="fa fa-check-circle" aria-hidden="true" data-toggle="tooltip" title="Tài khoản đã được xác minh bởi hệ thống"></i>
</h4>
                     <small class="text-primary"><i class="fa fa-credit-card" aria-hidden="true"></i>
<?=number_format($info['money'])?> vnđ</small> <br>
                        
<small class="text-info">Chào mừng <b><?=$this->m_func->name_admin($info['admin'])?></b></small> <br><br>
                        <ul class="list-inline">
                            <li>
                                <a href="<?=base_url()?>index.php/Member/Profile" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>

                            <li>
                                <a href="<?=base_url()?>index.php/Member/logout" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="text-muted menu-title">Menu chức năng</li>

                            <li>
                                <a href="<?=base_url()?>index.php/Member" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Tổng quan </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" aria-hidden="true"></i> <span> Treo nick </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=base_url()?>Member/TreoNick">Thêm nick treo</a></li>
                                    <li><a href="<?=base_url()?>Member/QuanLyTreoNick">Quản lý nick treo</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-database" aria-hidden="true"></i> <span> Auto tương tác</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                   <li><a href="<?=base_url()?>Member/AutoTuongTac">Cài đặt Auto tương tác</a></li>
                                    <li><a href="<?=base_url()?>Member/QuanLyAutoTuongTac">Quản lý Auto tương tác</a></li>
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-database" aria-hidden="true"></i> <span> Auto bình luận</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                   <li><a href="<?=base_url()?>Member/BotComment">Cài đặt Auto bình luận</a></li>
                                   <li><a href="<?=base_url()?>Member/QuanLyBotComment">Quản lý Auto bình luận</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-gift" aria-hidden="true"></i> <span> Auto Post bài</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=base_url()?>Member/AutoPost">Cài đặt Auto Post </a></li>
                                    <li><a href="<?=base_url()?>Member/QuanLyBaiDang">Quản lý bài đăng</a></li>
                                </ul>
                            </li>


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-clone" aria-hidden="true"></i> <span> Quản lý token </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=base_url()?>index.php/Admin/TokenManager/TrangThai">Trạng thái</a></li>
                                    <li><a href="<?=base_url()?>index.php/Admin/TokenManager">Quản lý</a></li>
                                    
                                    
                                </ul>
                            </li>



                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cogs" aria-hidden="true"></i> <span> Hệ thống </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                     <li><a href="<?=base_url()?>index.php/Admin/Sever_Status">Trạng thái server</a></li>
                                    <li><a href="<?=base_url()?>index.php/Admin/Log_ID">Quá trình chạy</a></li>
                                    <li><a href="<?=base_url()?>index.php/Admin/Cron_Jobs">Hướng dẫn</a></li>
                                </ul>
                            </li>





                            <li>
                                <a href="<?=base_url()?>index.php/Member/NapTien" class="waves-effect"><i class="fa fa-key" aria-hidden="true"></i> <span> Bản quyền </span> </a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
               
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">

                            <?php
                                 $data['list_user'] = isset($list_user) ? $list_user : '';
                                 $data['result_arr'] = isset($result_arr) ? $result_arr : '';
                                 $data['mess'] = isset($mess) ? $mess : '';
                                 $data['pagination'] = isset($pagination) ? $pagination : '';
                                 $this->load->view($load, $data);
                                 
                            ?>

                        </div>
                        <!-- End row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer">
                    Code by <i class="fa fa-heart heart" style="color: red;"></i> Jickme
                </footer>

            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

<div id="trideptrai">

</div>        

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
       




        <script src="<?=base_url()?>/assets/js/detect.js"></script>
        <script src="<?=base_url()?>/assets/js/fastclick.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.blockUI.js"></script>
        <script src="<?=base_url()?>/assets/js/waves.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.nicescroll.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?=base_url()?>/assets/js/jquery.core.js"></script>
        <script src="<?=base_url()?>/assets/js/jquery.app.js"></script>

        <script src="<?=base_url()?>assets/plugins/toastr/toastr.min.js"></script>
        
        <!-- Time picker -->
        <script src="<?=base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

        <script src="<?=base_url()?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

        <script src="<?=base_url()?>assets/js/main.js"></script>    
    </body>
</html>
<?php
}else{
    $data['idfb'] = $info['fb_id'];
    $this->load->view('page/checkpoint', $data);
}
?>
