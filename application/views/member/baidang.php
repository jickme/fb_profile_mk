<div class="col-sm-12">
    <div class="card-box">
        <div class="row">
         <div class="col-sm-6">
            <form class="form-horizontal tinhtien" role="form" method="POST" id="creat_post_default">

                 <p class="text-center text-info"><b>Tạo bài đăng</b></p>

                   <!--  <select name="country" class="form-control ditmia" data-live-search="true">
                                <option value="AF">Afghanistan</option>
                     </select> -->

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Người đăng :</label>
                        <div class="col-md-10">
                                <select name="nguoi_dang" class="form-control ditmia" data-live-search="true">
                                    <?php

                                        foreach ($list_user as $user) {
                                            echo '<option value="'.$user['idfb'].'">'.$user['name'].' ['.$user['idfb'].']</option>';
                                        }
                                    ?>
                                         
                                </select><br>
                                <span class="text-muted">* Hãy chọn người đăng trước tiên.</span>
                                <p style="display: none;" id="token"><?=$list_user[0]['token']?></p>
                        </div>
                    </div>
                </div> 

                <hr>
                <div id="profile">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nội dung bài đăng </label>
                                <div class="col-md-10">
                                    <textarea class="form-control" placeholder="Nội dung đăng bài vào đây..." name="noidung" id="noidung"></textarea>

                                          <ul class="nav nav-pills m-t-10">
                                                    <li>
                                                        <a data-toggle="modal" data-target="#tag_fr" href="#"><i class="fa fa-tag"></i></a>
                                                    </li>
                                                    <li>
                                                        <a onclick="click_file()" href="#"><i class=" fa fa-camera"></i></a>
                                                    </li>
                                                    <li>
                                                        <a onclick="rand_icon_post()" href="#"><i class="fa fa-smile-o"></i></a>
                                                    </li>
                                            </ul>

                                       <!--  <span class="text-muted"><code>{{r}}</code> : sử dụng để random icon. <br>
                                        <code>{{tag_rand}}</code> : tag bất kì bạn bè nào. <br>
                                        </span> -->

                                </div>
                            </div>
                        </div>  

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Ảnh kèm theo</label>
                                <div class="col-md-10">
                                    <input type="file" name="image" class="form-control" id="chose_img"> 
                                </div>
                            </div>
                        </div> 
                </div>
                <div id="group" style="display: none;">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-md-2 control-label">ID Nhóm</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" placeholder="Dán id nhóm vào đây..." name="group_list" id="id_gr_ins"></textarea>  
                                    <span class="text-muted">* Click <a href="#" data-toggle="modal" data-target="#group_search">vào đây</a> để tìm kiếm và lấy id nhóm.</span>
                                </div>
                            </div>
                        </div>  
                </div>
                <div id="copy" style="display: none;">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-md-2 control-label">List UID Copy</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" placeholder="List UID copy bài viết, cách nhau bằng dấu xuống dòng." name="list_copy" id="list_copy" rows="8"></textarea>  
                                    <span class="text-muted">* Copy được trang cá nhân, page, nhóm.</span>
                                </div>
                            </div>
                        </div>   
                </div>
            </div>
                <!-- end col -->
                <div class="col-sm-6">
                   <p class="text-center text-info"><b>Cài đặt lịch</b></p>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Giờ post bài</label>
                                <div class="col-md-12">
                                    <input id="timepicker2" type="text" class="form-control">
                                            
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-12 control-label">Ngày post bài</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                            
                                </div>
                            </div>
                        </div> 
                        
                        <div class="col-lg-12">
                            <br> 
                            <div class="form-group">
                                <label class="col-md-12 control-label">Đăng lại sau (phút): </label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" value="60" name="repeat">
                                            
                                </div>
                            </div>
                           
                        </div> 
                        
                        
                        <div class="col-lg-12">
                             <hr>
                            <h5 class="text-center text-info"><b>Nơi đăng bài</b></h5>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <select class="form-control" name="where_post" id="where_post">
                                            <option value="profile">Đăng lên tường</option>
                                            <option value="group">Nhóm tùy chỉnh</option>
                                            <option value="copy">Lấy bài đăng từ người khác</option>
                                    </select>
                                </div>
                            </div>

                        </div><br>
                </div>


                <div class="col-md-12 text-center">
                    
                

                    <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Tiến hành cài đặt</button>
                </div>

            </form>
        </div>
        <!-- end row -->
        <div class="loader" style="display: none;"></div>
    </div>

</div>

<div id="tag_fr" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tag bạn bè</h4>
      </div>
      <div class="modal-body">
        
       <div class="input-group col-md-12">
              <input type="text" class="search-query form-control" placeholder="Tìm kiếm bạn bè" id="key_search" onchange="search_tag()">
                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" onclick="search_tag()">
                                        <i class="fa fa-search"></i>
                                    </button>
                </span>

         </div>
         <div class="input-group col-md-12">

            <div id="loader" style="display: none;"><br><br><center><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><br><br></center></div>

                <div id="view_tag" style="margin-top: 10px" class="row">
                                  
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>

  </div>
</div>

</div>

<div id="group_search" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nhóm bạn tham gia</h4>
      </div>
      <div class="modal-body">
        
       <div class="input-group col-md-12">
        <button class="btn btn-block btn-primary" onclick="group_search()">Lấy danh sách các nhóm</button>
              <!-- <input type="text" class="search-query form-control" placeholder="Tìm kiếm các nhóm tham gia" id="key_group" onchange="group_search()">
                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" onclick="group_search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                </span> -->



         </div>
         <div class="input-group col-md-12">
 <br><br>
            <div id="loadergr" style="display: none;"><br><br><center><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><br><br></center></div>
                <ul class="list-group" id="view_group">
 

                
       

                </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>

  </div>
</div>