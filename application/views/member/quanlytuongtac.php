<script type="text/javascript">
        function check_token(token, id){
            $.get('https://graph.facebook.com/me/', {access_token: token}).done(function(){
               $('#status_' + id).html('<i class="fa fa-circle text-success" aria-hidden="true"></i>');   
              }).fail(function(){
                $('#status_' + id).html('<i class="fa fa-circle text-warning" aria-hidden="true"></i>');   
            });
         }
</script>
<div class="col-sm-12">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30">Quản lý tương tác</h4>
        
        	<div class="table-responsive">
				  <table class="table table-bordered">
				    <thead>
				      <tr>
				      	<th>Họ tên</th>
				        <th>Còn lại</th>
				        <th>Cảm xúc</th>
				        <th>Thời gian chạy</th>
				        <th>Lọc tương tác</th>
				        <th>Quá trình</th>
				        <th class="text-center">Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php
				    //print_r($result_arr);
					$this->load->helper('date');
				    foreach ($result_arr as $treo) {
				    	?>
				      <tr id="table_<?=$treo['id']?>">
				        <td><img src="https://graph.fb.me/<?=$treo['fb_id']?>/picture?width=20">
				        	<a href="https://fb.com/<?=$treo['fb_id']?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?=htmlentities($treo['note'])?>">
				        	<?=$treo['name']?> <span id="status_<?=$treo['id']?>"></span></a>
				        	<script>
				        		check_token('<?=$treo['access_token']?>', <?=$treo['id']?>)
				        	</script>
				        	</td>	
				        <td><span data-toggle="tooltip" data-placement="top" title="<?=mdate('%H:%i - %d/%m/%Y', $treo['time_creat'])?> (<?=$this->m_func->timeAgo($treo['time_creat'])?>)"><?=$this->m_func->time_remaining($treo['time_use'] - time())?></span></td>
				       <td><?=$this->m_func->name_reactions($treo['reactions'])?></td>
				       <td><?=$treo['h_start']?>h - <?=$treo['h_end']?>h</td>
				       <td>
				       	<?php
				       		if($treo['check_male'] == '1'){
				       			echo '<span class="label label-success"><i class="fa fa-male" aria-hidden="true"></i></span> ';
				       		}else{
				       			echo '<span class="label label-danger"></span> ';
				       		}
				       		if($treo['check_female'] == '1'){
				       			echo '<span class="label label-success"><i class="fa fa-female" aria-hidden="true"></i></span> ';
				       		}else{
				       			echo '<span class="label label-danger"><i class="fa fa-female" aria-hidden="true"></i></span> ';
				       		}
				       		if($treo['check_pg'] == '1'){
				       			echo '<span class="label label-success"><i class="fa fa-flag" aria-hidden="true"></i></span> <span class="label label-success"><i class="fa fa-users" aria-hidden="true"></i></span> ';
				       		}else{
				       			echo '<span class="label label-danger"><i class="fa fa-flag" aria-hidden="true"></i></span> <span class="label label-danger"><i class="fa fa-users" aria-hidden="true"></i></span> ';
				       		}	
				       	?>
				       </td>
				       	<td>
				       		<?php
				       			if($treo['active'] == '1'){
				       				echo '<span class="label label-success"> Đang hoạt động</span>';
				       			}else if($treo['active'] == '2'){
				       				echo '<span class="label label-warning"> Tạm ngưng bởi hệ thống</span>';
				       			}else{
				       				echo '<span class="label label-danger"> Đã tạm dừng</span>';
				       			}

				       		?>
				       		
				       	</td>
				        <td class="text-center">
				        	<button class="btn btn-success btn-xs" onclick="edit_tuongtac(<?=$treo['id']?>)">Sửa</button>
				        	<button class="btn btn-danger btn-xs" onclick="delete_table(<?=$treo['id']?>)">Xóa</button>
				        </td>
				      </tr>
				    	<?php
				    }
				    ?>

				      
				    </tbody>
				  </table>

        	</div>
            <center><?=$pagination?></center>

 <div class="loader" style="display: none;"></div>
    </div>
</div>

<!--  <div id="edit_model" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chỉnh sửa</h4>
      </div>
	  <div class="modal-body">
		    <form id="form_edit">
		        <input type="hidden" name="edit_id" value="paste_here">
		        <div class="row">
		        	
		        	<p class="text-center text-info"><b>Tương tác với</b></p>
                    
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
		        <div class="row">
		        	<hr> 
		        	<p class="text-center text-info"><b>Hẹn giờ</b></p>
<div class="form-group">
                        <label class="control-label col-sm-12">Thời gian thả tim</label>
                        <div class="col-sm-12">
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
                    </div>
		        </div>
		        <div class="row">
		        	<hr> 
		        	<p class="text-center text-info"><b>Thông tin chính</b></p>
		            <div class="col-md-6">
		                <div class="form-group no-margin">
		                    <label for="field-7" class="control-label">Acccess Token</label>
		                    <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="access_token">paste_here</textarea>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group no-margin">
		                    <label for="field-7" class="control-label">Ghi chú</label>
		                    <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="note">paste_here</textarea>
		                </div>
		            </div>
		            <div class="row">
		            <div class="col-md-4">
		            	
						 <div class="form-group no-margin">
						  <label for="sel1">Trạng thái:</label>
						  <select class="form-control" id="sel1"  name="active">
						    <option value="1">Hoạt động</option>
						    <option value="0">Tạm ngưng</option>
						  </select>
						</div>
		            </div>
					<did class="col-md-4">
	                    <div class="form-group">
	                        <label class="control-label">Cảm xúc : </label>
	                        <div>
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

					</did>
		            <div class="col-md-4">
		            	
						 <div class="form-group no-margin">
		                    <label for="field-2" class="control-label">Gia hạn</label>
		                    <input class="form-control" id="field-2" type="number" name="gia_han" placeholder="Điền 0 để ko gia hạn." value="0" min="0" step="1">
		                    <small class="text-muted">* Số ngày mua thên, điền 0 nếu ko muốn gia hạn.</small>
						</div>

		            </div>
		        </div>

		       </div>


		    </form>
	  </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-info waves-effect waves-light" onclick="submit_form_modal()">Save changes</button>
		</div>
	</div>
  </div>
</div> -->
<script type="text/javascript">
	//$('#test').modal('show');
</script>
<?php
//print_r($result_arr);
//echo $pagination;
?>