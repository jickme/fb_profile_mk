<div class="col-sm-12">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30">Quản lý treo nick</h4>
        
        	<div class="table-responsive">
				  <table class="table table-bordered">
				    <thead>
				      <tr>
				      	<th>Họ tên</th>
				        <th>FBID</th>
				        <th>Còn lại</th>
				        <th>Trạng thái</th>
				        <th class="text-center">Hành động</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php
				    
					$this->load->helper('date');
				    foreach ($result_arr as $treo) {
				    	?>
				      <tr id="table_<?=$treo['id']?>">
				        <td><img src="https://graph.fb.me/<?=$treo['fb_id']?>/picture?width=20">
				        	<a href="https://fb.com/<?=$treo['fb_id']?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?=htmlentities($treo['note'])?>">
				        	<?=$treo['name']?> 
				        	<?php 
				        		if($treo['active'] == '1'){
				        			echo '<i class="fa fa-circle text-success" aria-hidden="true"></i>';
				        		}else{
				        			echo '<i class="fa fa-circle text-danger" aria-hidden="true"></i>';
				        		}
				        	?>
				        	</td>
				        	<td><?=$treo['fb_id']?></td>
				        <td><span data-toggle="tooltip" data-placement="top" title="<?=mdate('%H:%i - %d/%m/%Y', $treo['time_creat'])?> (<?=$this->m_func->timeAgo($treo['time_creat'])?>)"><?=$this->m_func->time_remaining($treo['time_use'] - time())?></span></td>
				       
				       	<td>
				       		<?php
				       			if($treo['active'] == '1'){
				       				echo '<span class="label label-success"> Đang hoạt động</span>';
				       			}else if($treo['active'] == '2'){
				       				echo '<span class="label label-warning"> Checkpoint - Die</span>';
				       			}else{
				       				echo '<span class="label label-danger"> Đã tạm dừng</span>';
				       			}

				       		?>
				       		
				       	</td>
				        <td class="text-center">
				        	<button class="btn btn-success btn-xs" onclick="edit_treo(<?=$treo['id']?>)">Sửa</button>
				        	<button class="btn btn-info btn-xs" onclick="check_live_cookie(<?=$treo['id']?>)">Check</button>
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

<!-- <div id="edit_model" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chỉnh sửa</h4>
      </div>
	  <div class="modal-body">
		    <form id="form_edit">
		        <input type="hidden" name="edit_id" value="43">
		        <div class="row">
		            <div class="col-md-6">
		                <div class="form-group">
		                    <label for="field-1" class="control-label">Tên VIP</label>
		                    <input class="form-control" type="text" disabled="" value="paste_here">
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                    <label for="field-2" class="control-label">ID cài</label>
		                    <input class="form-control" id="field-2" type="text" value="paste_here" disabled="">
		                </div>
		            </div>

		        </div>

		        <div class="row">
		            <div class="col-md-6">
		                <div class="form-group no-margin">
		                    <label for="field-7" class="control-label">Cookie</label>
		                    <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="cookie">paste_here</textarea>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group no-margin">
		                    <label for="field-7" class="control-label">Ghi chú</label>
		                    <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="note">paste_here</textarea>
		                </div>
		            </div>
		            <div class="col-md-6">
		            	
						 <div class="form-group no-margin">
						  <label for="sel1">Trạng thái:</label>
						  <select class="form-control" id="sel1"  name="active">
						    <option value="1">Hoạt động</option>
						    <option value="0">Tạm ngưng</option>
						  </select>
						</div>

		            </div>
		            <div class="col-md-6">
		            	
						 <div class="form-group no-margin">
		                    <label for="field-2" class="control-label">Gia hạn</label>
		                    <input class="form-control" id="field-2" type="number" value="paste_here" name="gia_han" placeholder="Điền 0 để ko gia hạn." value="0" min="0" step="1">
		                    <small class="text-muted">* Số ngày mua thên, điền 0 nếu ko muốn gia hạn.</small>
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
<?php
//print_r($result_arr);
//echo $pagination;
?>