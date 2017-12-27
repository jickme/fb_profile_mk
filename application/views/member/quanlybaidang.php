<div class="col-sm-12">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30">Tất cả bài đăng</h4> 
        
        <div class="row">

        	<?php $this->load->helper('date'); foreach ($result_arr as $post): ?>
        		<div class="col-md-6 col-sm-12" id="table_<?=$post['id']?>">
								<div class="card-box widget-user">
                                    <div>
                                        <img src="https://graph.fb.me/<?=$post['idfb']?>/picture?width=200" class="img-responsive img-circle" alt="user">
                                        <div class="wid-u-info">
                                            <h5 class="mt-0 m-b-5"><?php
                                            if($post['where_post'] == 'profile'){
                                            	echo 'Đăng lên tường</h5>';
                                            ?>
                                            <p class="text-info m-b-5 font-13"><?=$this->m_func->strMiddleReduceWordSensitive($post['message'])?></p>
                                            <?php
                                            	if($post['image'] != ''){
                                            		?>
                                            <small class="text-muted"><b>Ảnh kèm theo  :</b> <a href="<?=$post['image']?>" target="_blank"><?=$post['image']?></a></small> <br>
                                            		<?php
                                            	}
                                            ?>
                                            <?php
                                            }else if($post['where_post'] == 'group'){
                                            	echo 'Đăng lên nhóm</h5>';
                                            ?>
                                            <p class="text-info m-b-5 font-13"><?=$this->m_func->strMiddleReduceWordSensitive($post['message'])?></p>
                                            <?php
                                            	if($post['image'] != ''){
                                            		?>
                                            <small class="text-muted"><b>Ảnh kèm theo  :</b> <a href="<?=$post['image']?>" target="_blank"><?=$post['image']?></a></small> <br>
                                            		<?php
                                            	}
                                            ?>

                                            <small class="text-muted"><b>Nhóm đăng  :</b> <?=$this->m_func->strMiddleReduceWordSensitive($post['list_id_group'], 30)?></small> <br>
                                            <?php
                                            }else{
                                            	echo 'Copy bài đăng</h5>';
                                            ?>
                                            <small class="text-muted"><b>ID Copy  :</b> <?=$this->m_func->strMiddleReduceWordSensitive($post['list_id_copy'])?></small> <br>

                                            <?php
                                            }
                                            ?>
                                           
                                            <small class="text-muted"><b>Thời gian đăng : <?=mdate('%H:%i - %d/%m/%Y', $post['time_post'])?></b></small><br>
                                            <?php
                                            	if($post['posted'] == '1'){
                                            		echo '<small class="text-success">Đã đăng bài thành công</small>';
                                            	}else{
                                            		echo '<small class="text-warning">Đang chờ đăng bài</small>';
                                            	}
                                            ?>
                                            <br><br>
                                            <button class="btn btn-primary btn-xs" onclick="view_full(<?=$post['id']?>)">Xem đầy đủ</button>
                                            <button class="btn btn-danger btn-xs" onclick="delete_table(<?=$post['id']?>)">Xóa</button>
                                        </div>
                                    </div>
                                </div>
        		</div>
        	<?php endforeach ?>


        </div>
 <div class="loader" style="display: none;"></div>
    </div>
</div>
