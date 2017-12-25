<?php
//print_r($result_arr);
?>
<div class="container">
    <div class="panel panel-default">

    <div class="panel-body">

    <?php

    foreach ($result_arr as $cmt) {
     ?>

    <ul class="media-list" id="cmt_<?=$cmt['id']?>">
        <li class="media">
            <a class="pull-left" href="#">
                <img class="media-object img-circle" src="https://graph.fb.me/<?=$cmt['idbot']?>/picture?width=100" alt="profile">
            </a>
            <div class="media-body">
                <div class="well well-lg">
                    <p><?=htmlentities($cmt['message'])?></p>
                    <?php
                        if($cmt['image'] != ''){
                            echo '<img src="'.$cmt['image'].'" width="100" alt="Ảnh bị lỗi !"> <a href="'.$cmt['image'].'" target="_blank">Xem ảnh</a>';
                        }
                    ?>

                </div>
                <a class="btn btn-info btn-circle text-uppercase btn-xs" onclick="edit_comment(<?=$cmt['id']?>)"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
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
