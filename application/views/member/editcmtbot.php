<?php
//print_r($result_arr);
?>
<div class="container">
    <div class="panel panel-default">
<button class="btn btn-block btn-info" data-toggle="modal" data-target="#add_cmt"><i class="fa fa-plus"></i> Thêm bình luận </button> 
    <div class="panel-body">

    <?php

    foreach ($result_arr as $cmt) {
     ?>

    <ul class="media-list" id="cmt_<?=$cmt['id']?>">
        <li class="media">
            <!-- <a class="pull-left" href="#">
                <img class="media-object img-circle" src="https://graph.fb.me/<php //$cmt['idbot']?>/picture?width=100" alt="profile">
            </a> -->
            <div class="media-body">
                <div class="well well-lg">
                    <div class="alert alert-default"><p><?=htmlentities($cmt['message'])?></p></div>
                    <?php
                        if($cmt['image'] != ''){
                            echo '<img src="'.$cmt['image'].'" width="100" alt="Ảnh bị lỗi !"> <a href="'.$cmt['image'].'" target="_blank">Xem ảnh</a>';
                        }
                    ?>
                </div>
                <button class="btn btn-info btn-circle text-uppercase btn-xs" onclick="edit_comment(<?=$cmt['id']?>)"><span class="glyphicon glyphicon-pencil"></span> Sửa</button>
<button class="btn btn-danger btn-circle text-uppercase btn-xs" onclick="delete_comment(<?=$cmt['id']?>)"><span class="glyphicon glyphicon-trash" on></span> Xóa</button>

            </div>
            
        </li>
    </ul>

     <?php
    }
    ?>

</div>
</div>
</div>


<div style="display: none;">
    <form action="" enctype="multipart/form-data" id="change_photo_submit"> 
            <input type="hidden" name="id" value="1">
             <input name="img" size="35" type="file" id="change_img_hi"/><br/> 
     <input type="submit" name="upload_img" value="Upload"/> 
    </form> 
</div>

<div id="add_cmt" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thêm Comment </h4>
      </div>
      <div class="modal-body">
      	<form id="add_cmt_form">
      	<div class="form-group"> <label>* Nội dung comment: </label> <textarea class="form-control" rows="3" placeholder="Điền nội dung comment vào đây..." name="message"></textarea> </div>
      	<input type="hidden" name="add_cmt_submit" value="asdjsdhgusadgsaj">
      	<center><div id="anh_modal"> <p class="text-muted">Không có ảnh</p></div><br><a onclick="change_img()" id="change_img" href="#">Thêm ảnh</a> <div id="delete_bt" style="display: none;"><a href="#" class="text-danger" onclick="delete_img()">Xóa ảnh</a></div><input type="hidden" name="image" value="" id="paste_here"></center>
        
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_cmt_submit()">Lưu thay đổi</button>
      </div>
    </div>

  </div>
</div>


