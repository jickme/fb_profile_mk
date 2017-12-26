<div class="col-sm-8">
    <div class="card-box">
        <div class="row">
            <form class="form-horizontal tinhtien" role="form" method="POST" id="auto_tuong_tac_submit">

                <div class="col-lg-12">
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
                            <input type="number" class="form-control" value="30" name="ngay_cai" id="cai_ngay" required="" minlength="3">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Số lượng post/ ngày:</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" value="5" name="post_max" id="post_max" required="" minlength="3">

                            <span class="text-muted">* Mặc định số post sẽ là 5, nếu bạn muốn mua thêm post thì mỗi post giá <?=number_format($this->m_func->get_gia('them_post'))?> xu.</span>
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
            
                <!-- end col -->

                <div class="col-md-12 text-center">
                    
                    <p id="per" style="display: none;"><?=$this->m_func->get_gia('auto_post')?></p>
                    <p id="per_post" style="display: none;"><?=$this->m_func->get_gia('them_post')?></p>

                    <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Tiến hành cài đặt</button>
                </div>

            </form>
        </div>
        <!-- end row -->
        <div class="loader" style="display: none;"></div>
    </div>

</div>

<div class="col-sm-4">
    <div class="card-box">
        <p class="text-center text-info"><b>Thanh toán</b></p>

            <ul class="list-group">
              <li class="list-group-item">Giá tạm tính : <b><span id="tamtinh"><?=number_format($this->m_func->get_gia('auto_post') * 30)?></span>đ</b><p id="tamtinh_no" style="display: none;"><?=$this->m_func->get_gia('auto_post') * 30?></p></li>

              <li class="list-group-item">Giá post mua thêm : <b><span id="muathem">0</span>đ</b></li>
              <li class="list-group-item">Thành tiền : <b><span id="thanh_tien"><?=number_format($this->m_func->get_gia('auto_post') * 30)?></span>đ</b></li>
            </ul>

    </div>
</div>

<div class="col-sm-4">
    <div class="card-box">
        <p class="text-center text-info"><b>Hướng dẫn</b></p>

        <div class="alert alert-info">
            Sau khi cài đặt khách hàng vui lòng cài đặt post ở phần<b> Menu -> Auto Post bài ->   Quản lý Post bài</b>
        </div>

    </div>
</div>