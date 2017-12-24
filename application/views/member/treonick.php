<div class="col-sm-8">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30 text-center">Panel cài đặt</h4>
        <div class="row">
            <form class="form-horizontal" role="form" method="POST" id="treo_nick_submit">
            <div class="col-lg-12">                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Cookie :</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="cookie" required="" placeholder="Dán cooke vào đây..." rows="5"></textarea>
                            <small class="text-danger"><?=form_error('cookie')?></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Thời gian cài (ngày):</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" value="30" name="ngay_cai" id="ngay_cai" required="" minlength="3">
                            <small class="text-danger"><?=form_error('ngay_cai')?></small>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label">Trình duyệt : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="browser">
                                    <option value="1">Mặc định</option>
                            	   <option value="1">Chorme</option>
                                   <option value="2">Internet Explorer 10</option>
                                   <option value="3">Opera</option>
                                   <option value="4">Safari</option>
                            </select>
                       <small class="text-danger"><?=form_error('browser')?></small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ghi chú :</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="note" placeholder="Nhập 1 chút ghi chú" rows="3"></textarea>
                            <small class="text-danger"><?=form_error('note')?></small>
                        </div>
                    </div>
                 
            </div>
            <!-- end col -->

         
              <div class="col-md-12 text-center">
              	<button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Tiến hành cài đặt</button>
            
              	
              </div>
                    
                </form>
        </div>
        <!-- end row -->

    </div>
</div>

<div class="col-sm-4">

    <div class="row">

        <div class="col-md-12">
            <div class="card-box">
                 <h4 class="header-title m-t-0 m-b-30 text-center">Thanh toán</h4>
                    <h3 class="text-info text-center"><span id="tamtinh"><?=number_format($this->m_func->get_gia('treo_nick') * 30)?></span>đ</h3>
                    <p id="per" style="display: none;"><?=$this->m_func->get_gia('treo_nick')?></p>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30 text-center">Lưu ý</h4>
                <div class="alert alert-warning">
                  <li> Có thể bị dính checkpoint cho lần đầu đăng nhập.</li>  
                </div>
                <div class="alert alert-warning">
                  <li> Nếu bị dính checkpoint nhiều lần trong ngày hãy xem hướng dẫn tại đây.</li>  
                </div>
                <div class="alert alert-info">
                  <li> Không tắt tab trong quá trình cài đặt.</li>  
                </div>
            </div>
        </div>


    </div>

</div>



