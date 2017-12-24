<div class="col-sm-12">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30 text-center">Panel cài đặt</h4>
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
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cảm xúc : </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="reactions">
                                <option value="1">LIKE</option>
                                <option value="2">LOVE</option>
                                <option value="3">HAHA</option>
                                <option value="4">WOW</option>
                                <option value="5">ANGRY</option>
                                <option value="6">SAD</option>
                                <option value="7">RANDOM</option>
                            </select>
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
                    <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Tiến hành cài đặt</button>
                    <button class="btn btn-default waves-effect w-md waves-light m-b-5"><span id="tamtinh"><?=number_format($this->m_func->get_gia('bot_cx') * 30)?></span>đ</button>
                    <p id="per" style="display: none;"><?=$this->m_func->get_gia('bot_cx')?></p>
                </div>

            </form>
        </div>
        <!-- end row -->
        <div class="loader" style="display: none;"></div>
    </div>

</div>