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
        <h4 class="header-title m-t-0 m-b-30">Quản lý auto post bài</h4>
        
        	<div class="table-responsive">
				  <table class="table table-bordered">
				    <thead>
				      <tr>
				      	<th>Họ tên</th>
				        <th>Còn lại</th>
				        <th>Đã đăng</th>
				        <th>Trạng thái</th>
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
				        <td><img src="https://graph.fb.me/<?=$treo['idfb']?>/picture?width=20">
				        	<a href="https://fb.com/<?=$treo['idfb']?>" target="_blank" data-toggle="tooltip" data-placement="top" title="<?=htmlentities($treo['note'])?>">
				        	<?=$treo['name']?> <span id="status_<?=$treo['id']?>"></span></a>
				        	<script>
				        		check_token('<?=$treo['token']?>', <?=$treo['id']?>)
				        	</script>
				        	</td>	
	  						<td><span data-toggle="tooltip" data-placement="top" title="<?=mdate('%H:%i - %d/%m/%Y', $treo['time_creat'])?> (<?=$this->m_func->timeAgo($treo['time_creat'])?>)"><?=$this->m_func->time_remaining($treo['time_use'] - time())?></span></td>
	  					<td><b class="text-info"><?=$treo['posted']?>/<?=$treo['post_max']?> bài</b></td>
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
				        	<a class="btn btn-info btn-xs" href="?edit_cmt=<?=$treo['id']?>">DS bài đăng</a>
				        	<button class="btn btn-success btn-xs" onclick="edit_post_manager(<?=$treo['id']?>)">Sửa</button>
				        	<button class="btn btn-danger btn-xs" onclick="delete_table(<?=$treo['id']?>)">Xóa</button>
				        </td>
				      </tr>
				    	<?php
				    }
				    ?>

				      
				    </tbody>
				  </table>

        	</div>
 <div class="loader" style="display: none;"></div>
    </div>
</div>

<script type="text/javascript">
	//$('#test').modal('show');
</script>
<?php
//print_r($result_arr);
//echo $pagination;
?>