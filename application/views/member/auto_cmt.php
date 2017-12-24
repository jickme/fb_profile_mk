<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li <?php if(!isset($_SESSION['step_botcmt'])){echo 'class="active"';}?>><a href="#">
                    <h4 class="list-group-item-heading text-success">Bước 1</h4>
                    <p class="list-group-item-text">Cài đặt cơ bản</p>
                </a></li>

                <li <?php if(!isset($_SESSION['step_botcmt'])){echo '';}else{if($_SESSION['step_botcmt'] == '2'){echo 'class="active"';}}?>><a href="#">
                    <h4 class="list-group-item-heading text-success">Bước 2</h4>
                    <p class="list-group-item-text">Thêm bình luận</p>
                </a></li>
                <li <?php if(!isset($_SESSION['step_botcmt'])){echo '';}else{if($_SESSION['step_botcmt'] == '3'){echo 'class="active"';}}?>><a href="#">
                    <h4 class="list-group-item-heading text-success">Bước 3</h4>
                    <p class="list-group-item-text">Hoàn tất</p>
                </a></li>
            </ul>
        </div>
    </div>
</div>
<?php
if(isset($_SESSION['step_botcmt'])){
?>
<?php
if($_SESSION['step_botcmt'] == '2'){
?>

<div class="container">




<input type="hidden" id="where_img" value="0">

    <center>
        <button class="btn btn-warning" id="add_cmt"><i class="fa fa-plus"></i> Thêm bình luận </button><br><br>
        <input type="hidden" id="num_cmt" value="0">
    </center>
    


    <form id="trideptraivaidai">
        <div id="cmt_list">
        <div id="cmt_0">
        <div class="card-box" >
             <span class="input-icon icon-right">
                 <textarea rows="2" class="form-control" placeholder="Nội dung bình luận" name="noidung[]" id="noidung_0" required=""></textarea>
            </span>
            <span class="input-icon icon-left">
                    <br>
                    <div id="img_link_0"><input type="hidden" name="img_link[]" class="form-control" value=""></input><p class="text-info">* Chưa có ảnh được chọn</p></div>
                   
            </span>                    
                <ul class="nav nav-pills m-t-10">
                    <li>
                        <a onclick="tag_me(0)" href="#"><i class="fa fa-user"></i></a>
                    </li>
                    <li>
                        <a onclick="add_img(0)" href="#"><i class=" fa fa-camera"></i></a>
                    </li>
                    <li>
                        <a onclick="rand_icon(0)" href="#"><i class="fa fa-smile-o"></i></a>
                    </li>
                    <li>
                        <a onclick="delete_add_cmt(0)" class="text-danger" href="#"><i class=" fa fa-trash"></i></a>
                    </li>
                </ul>
        </div>
    </div>
</div>
<button class="btn btn-info btn-block" type="submit" name="submit_cmt" value="cmt">Bước tiếp theo</button>
</form>
 <div class="loader" style="display: none;"></div>
<div style="display: none;">
    <form action="" enctype="multipart/form-data" id="upload_file"> 
            <input type="hidden" name="id" value="1">
             <input name="img" size="35" type="file" id="upload_img_hi"/><br/> 
     <input type="submit" name="upload_img" value="Upload"/> 
    </form> 
</div>

    
</div>
<?php
}else{
?>
<div class="container">
    <div class="panel panel-default">

    <div class="panel-body">

    <?php

    $qb = $this->db->query("SELECT * FROM comments WHERE idbot = '{$_SESSION['fbid_addcmt']}'");
    foreach ($qb->result_array() as $cmt) {
     ?>

    <ul class="media-list">
        <li class="media">
            <a class="pull-left" href="#">
                <img class="media-object img-circle" src="https://graph.fb.me/<?=$cmt['idbot']?>/picture?width=100" alt="profile">
            </a>
            <div class="media-body">
                <div class="well well-lg">
                    <p><?=htmlentities($cmt['message'])?></p>
                    <?php
                        if($cmt['image'] != ''){
                            echo '<img src="'.$cmt['image'].'" width="200" alt="Ảnh bị lỗi !">';
                        }
                    ?>
                    
                </div>
            </div>
            
        </li>
    </ul>

     <?php
    }
    ?>
<form method="POST" action="">
    <input type="hidden" name="done_hihi" value="hihi">
<button class="btn btn-block btn-success" type="submit">HOÀN TẤT</button>
</form>
</div>
</div>
</div>
<?php
}
?>
<?php
}else{
    ?>

<div class="col-sm-12">
    <div class="card-box">
        <div class="row">
            <form class="form-horizontal" role="form" method="POST" id="auto_tuong_tac_submit">

                <div class="col-lg-6">
                    <p class="text-center text-info"><b>Thông tin cài đặt</b></p>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Access Token :</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="access_token" required="" placeholder="Dán token vào đây..." rows="5"></textarea>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Thời gian cài (ngày):</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" value="30" name="ngay_cai" id="ngay_cai" required="" minlength="3">

                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ghi chú :</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="note" placeholder="Nhập 1 chút ghi chú" rows="5"></textarea>

                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <p class="text-center text-info"><b>Hẹn giờ</b></p>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Thời gian thả tim</label>
                        <div class="col-sm-10">
                            <div class="input-daterange input-group" id="date-range">
                                <div class="bootstrap-timepicker">
                                                <input type="text" class="form-control" name="h_start"  type="number" value="6" required="" min="0" max="23">
                                </div>
                                <span class="input-group-addon bg-primary b-0 text-white">đến</span>
                                 <div class="bootstrap-timepicker">
                                                <input type="text" class="form-control" name="h_end" type="number" value="23" required="" min="0" max="23">
                                </div>
                            </div>
                        </div>
                    </div><p class="text-center text-info"><b>Tương tác với</b></p>
                    <hr> 
                    <div class="container">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giới tính Nam: </label>
                                <div>
                                    <select class="form-control" name="check_male">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giới tính Nữ: </label>
                                <div>
                                    <select class="form-control" name="check_female">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Trang & Nhóm: </label>
                                <div>
                                    <select class="form-control" name="check_pg">
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <p class="text-center text-info"><b>Không tương tác</b></p>
                    <hr>

                    <div class="form-group">
                        <label class="col-md-2 control-label">UID không tương tác :</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="check_uid" placeholder="Dán list id không tương tác vào đây...Cách nhau bằng dấu xuống dòng" rows="3"></textarea>

                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-md-12 text-center">
                    
                    <button class="btn btn-default waves-effect w-md waves-light m-b-5"><span id="tamtinh"><?=number_format($this->m_func->get_gia('bot_cmt') * 30)?></span>đ</button>
                    <p id="per" style="display: none;"><?=$this->m_func->get_gia('bot_cmt')?></p>

                    <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Bước tiếp theo</button>
                </div>

            </form>
        </div>
        <!-- end row -->
        <div class="loader" style="display: none;"></div>
    </div>

</div>
    <?php
}
?>
