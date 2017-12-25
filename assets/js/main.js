
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
function formatCurrency(num){
    num = num.toString().replace(/\$|\,/g,'');
    if(isNaN(num))
    num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    num = Math.floor(num/100).toString();
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
    num = num.substring(0,num.length-(4*i+3))+','+
    num.substring(num.length-(4*i+3));
    return (((sign)?'':'-') + num);
}
$('#ngay_cai').change(function(){
  var thang = $(this).val();
  var per = parseInt($('#per').html());
  $('#tamtinh').html(formatCurrency(thang*per));
});

//Submit login form
$('#login_with_account').submit(function(){
  var e = $('#email').val();
  var p = $('#password').val();
  if(p == '' || e == ''){
     toastr["warning"]("<b>Vui lòng điền đầy đủ thông tin đăng nhập</b>");
     return false;
  }
  $(':input[type="submit"]').prop('disabled', true);
  $.post('', {e: e, p: p}).done(function(data){
    var a = jQuery.parseJSON(data);
    toastr[a.type](a.mess);
    $(':input[type="submit"]').prop('disabled', false);
    if(a.type == 'success'){
      location.reload();
    }
  }).fail(function(){
    toastr["warning"]("<b>Lỗi</b>");
  });
  return false;

});

/*Treo nick */
$('#treo_nick_submit').submit(function(){
  var cookie = $(':input[name="cookie"]').val();
  var ngay_cai = $(':input[name="ngay_cai"]').val();
  var browser = $(':input[name="browser"]').val();
  var note = $(':input[name="note"]').val();
  if(cookie == '' || ngay_cai == '' ||browser == '' ){
     toastr["warning"]("<b>Vui lòng điền đầy đủ thông tin đăng nhập</b>");
     return false;
  }
  $(':input[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Đang tiến hành cài đặt...');

  $.post('', {cookie: cookie, ngay_cai: ngay_cai, browser: browser, note: note}).done(function(data){
    console.log(data);
    var a = jQuery.parseJSON(data);
    toastr[a.type](a.mess);
    $(':input[type="submit"]').prop('disabled', false).html('Tiến hành cài');
    if(a.type == 'success'){
      setTimeout(function() {
          location.reload();
      }, 4000);
     
    }
  });
  return false;
});
//Delete Table
function delete_table(id){
  if(confirm("Bạn có chắc muỗn xóa ?")){
    $.post('', {delete_table: id}).done(function(data){
      console.log(data);
      var a = jQuery.parseJSON(data);
      toastr[a.type](a.mess);
      if(a.type == 'success'){
        $('#table_'+id).html('');
      }
    }).fail(function(){
        toastr["warning"]("<b>Lỗi</b>");
    });
  }
}
function check_live_cookie(id){
  $('.loader').show();
  $(':input[onclick="check_live_cookie('+id+')"]').prop('disabled', true);
  $.post('', {check_live_cookie: id}).done(function(data){
      var a = jQuery.parseJSON(data);
      toastr[a.type](a.mess);
      if(a.type == 'success'){
         $('.loader').hide();
      }
    }).fail(function(){
       $('.loader').hide();
        toastr["warning"]("<b>Lỗi</b>");
  }).always(function(){
    $(':input[onclick="check_live_cookie('+id+')"]').prop('disabled', false);
  });
}
function edit_treo(id){
  $('.loader').show();
  $(':input[onclick="edit_treo('+id+')"]').prop('disabled', true);
  $.post('', {get_json_edit: id}).done(function(data){
      var a = jQuery.parseJSON(data);
      console.log(a);
      if(a.active == 1){
        var active = '<option value="1" selected>Hoạt động</option> <option value="0">Tạm ngưng</option>';
      }else{
        var active = '<option value="1">Hoạt động</option> <option value="0" selected>Tạm ngưng</option>';
      }
      $('#trideptrai').html('<div id="edit_model" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Chỉnh sửa</h4> </div><div class="modal-body"> <form id="form_edit"> <input type="hidden" name="edit_id" value="'+a.id+'"> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label for="field-1" class="control-label">Tên VIP</label> <input class="form-control" type="text" disabled="" value="'+a.name+'"> </div></div><div class="col-md-6"> <div class="form-group"> <label for="field-2" class="control-label">ID cài</label> <input class="form-control" id="field-2" type="text" value="'+a.fb_id+'" disabled=""> </div></div></div><div class="row"> <div class="col-md-6"> <div class="form-group no-margin"> <label for="field-7" class="control-label">Cookie</label> <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="cookie">'+a.cookie+'</textarea> </div></div><div class="col-md-6"> <div class="form-group no-margin"> <label for="field-7" class="control-label">Ghi chú</label> <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="note">'+a.note+'</textarea> </div></div><div class="col-md-6"> <div class="form-group no-margin"> <label for="sel1">Trạng thái:</label> <select class="form-control" id="sel1" name="active"> '+active+' </select></div></div><div class="col-md-6"> <div class="form-group no-margin"> <label for="field-2" class="control-label">Gia hạn</label> <input class="form-control" id="field-2" type="number" value="0" name="gia_han" placeholder="Điền 0 để ko gia hạn." min="0" step="1"> <small class="text-muted">* Số ngày mua thên, điền 0 nếu ko muốn gia hạn.</small></div></div></div></form> </div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button><button type="submit" class="btn btn-info waves-effect waves-light" onclick="submit_form_modal()">Lưu thay đổi</button></div></div></div></div>');
      $('#edit_model').modal('show');
      $('.loader').hide();
    }).fail(function(){
       $('.loader').hide();
       toastr["warning"]("<b>Lỗi không thể xem</b>");
  }).always(function(){
    $(':input[onclick="edit_treo('+id+')"]').prop('disabled', false);
  });
}
function edit_tuongtac(id){
  $('.loader').show();
  $(':input[onclick="edit_tuongtac('+id+')"]').prop('disabled', true);
  $.post('', {get_json_edit: id}).done(function(data){
      var a = jQuery.parseJSON(data);
     // console.log(a);
     //Auto Complete
      if(a.active == 1){
        var active = '<option value="1" selected>Hoạt động</option> <option value="0">Tạm ngưng</option>';
      }else{
        var active = '<option value="1">Hoạt động</option> <option value="0" selected>Tạm ngưng</option>';
      }
      if(a.check_male == 1){
        var male = '<option value="1" selected>Có</option> <option value="0">Không</option>';
      }else{
        var male = '<option value="1">Có</option> <option value="0" selected>Không</option>';
      }

      if(a.check_female == 1){
        var female = '<option value="1" selected>Có</option> <option value="0">Không</option>';
      }else{
        var female = '<option value="1">Có</option> <option value="0" selected>Không</option>';
      }
      if(a.check_pg == 1){
        var pg = '<option value="1" selected>Có</option> <option value="0">Không</option>';
      }else{
        var pg = '<option value="1">Có</option> <option value="0" selected>Không</option>';
      }
      if(a.reactions){
        switch(a.reactions) {
            case '1':
                var reactions = '<option value="1" selected>LIKE</option> <option value="2">LOVE</option> <option value="3">HAHA</option> <option value="4">WOW</option> <option value="5">ANGRY</option> <option value="6">SAD</option> <option value="7">RANDOM</option>';
                break;
            case '2':
                var reactions = '<option value="1">LIKE</option> <option value="2" selected>LOVE</option> <option value="3">HAHA</option> <option value="4">WOW</option> <option value="5">ANGRY</option> <option value="6">SAD</option> <option value="7">RANDOM</option>';
                break;
            case '3':
                var reactions = '<option value="1">LIKE</option> <option value="2">LOVE</option> <option value="3" selected>HAHA</option> <option value="4">WOW</option> <option value="5">ANGRY</option> <option value="6">SAD</option> <option value="7">RANDOM</option>';
                break;
            case '4':
                var reactions = '<option value="1">LIKE</option> <option value="2">LOVE</option> <option value="3">HAHA</option> <option value="4" selected>WOW</option> <option value="5">ANGRY</option> <option value="6">SAD</option> <option value="7">RANDOM</option>';
                break;
            case '5':
                var reactions = '<option value="1">LIKE</option> <option value="2">LOVE</option> <option value="3">HAHA</option> <option value="4">WOW</option> <option value="5" selected>ANGRY</option> <option value="6">SAD</option> <option value="7">RANDOM</option>';
                break;
            case '6':
                var reactions = '<option value="1">LIKE</option> <option value="2">LOVE</option> <option value="3">HAHA</option> <option value="4">WOW</option> <option value="5">ANGRY</option> <option value="6" selected>SAD</option> <option value="7">RANDOM</option>';
                break;
            default:
                 var reactions = '<option value="1">LIKE</option> <option value="2">LOVE</option> <option value="3">HAHA</option> <option value="4">WOW</option> <option value="5">ANGRY</option> <option value="6">SAD</option> <option value="7" selected>RANDOM</option>';
        }
      }else{
        var reactions = '<option>Không khả dụng</option>';
      }


      $('#trideptrai').html(' <div id="edit_model" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Chỉnh sửa</h4> </div><div class="modal-body"> <form id="form_edit"> <input type="hidden" name="edit_id" value="'+a.id+'"> <div class="row"> <p class="text-center text-info"><b>Tương tác với</b></p><div class="col-md-4"> <div class="form-group"> <label class="control-label">Giới tính Nam: </label> <div> <select class="form-control" name="check_male">'+male+'</select> </div></div></div><div class="col-md-4"> <div class="form-group"> <label class="control-label">Giới tính Nữ: </label> <div> <select class="form-control" name="check_female">'+female+'</select> </div></div></div><div class="col-md-4"> <div class="form-group"> <label class="control-label">Trang & Nhóm: </label> <div> <select class="form-control" name="check_pg">'+pg+'</select> </div></div></div></div><div class="row"> <hr> <p class="text-center text-info"><b>Hẹn giờ</b></p><div class="form-group"> <label class="control-label col-sm-12">Thời gian thả tim</label> <div class="col-sm-12"> <div class="input-daterange input-group" id="date-range"> <div class="bootstrap-timepicker"> <input type="text" class="form-control" name="h_start" type="number" value="'+a.h_start+'" required="" min="0" max="23"> </div><span class="input-group-addon bg-primary b-0 text-white">đến</span> <div class="bootstrap-timepicker"> <input type="text" class="form-control" name="h_end" type="number" value="'+a.h_end+'" required="" min="0" max="23"> </div></div></div></div></div><div class="row"> <hr> <p class="text-center text-info"><b>Thông tin chính</b></p><div class="col-md-6"> <div class="form-group no-margin"> <label for="field-7" class="control-label">Acccess Token</label> <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="access_token">'+a.access_token+'</textarea> </div></div><div class="col-md-6"> <div class="form-group no-margin"> <label for="field-7" class="control-label">Ghi chú</label> <textarea class="form-control autogrow" id="field-7" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 80px;" name="note">'+a.note+'</textarea> </div></div><div class="row"> <div class="col-md-4"> <div class="form-group no-margin"> <label for="sel1">Trạng thái:</label> <select class="form-control" id="sel1" name="active">'+active+'</select></div></div><did class="col-md-4"> <div class="form-group"> <label class="control-label">Cảm xúc : </label> <div> <select class="form-control" name="reactions"> '+reactions+'</select> </div></div></did> <div class="col-md-4"> <div class="form-group no-margin"> <label for="field-2" class="control-label">Gia hạn</label> <input class="form-control" id="field-2" type="number" name="gia_han" placeholder="Điền 0 để ko gia hạn." value="0" min="0" step="1"> <small class="text-muted">* Số ngày mua thên, điền 0 nếu ko muốn gia hạn.</small></div></div></div></div></form> </div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button><button type="submit" class="btn btn-info waves-effect waves-light" onclick="submit_form_modal()">Lưu thay đổi</button></div></div></div></div>');
      $('#edit_model').modal('show');
      $('.loader').hide();
    }).fail(function(){
       $('.loader').hide();
       toastr["warning"]("<b>Lỗi không thể xem</b>");
  }).always(function(){
    $(':input[onclick="edit_tuongtac('+id+')"]').prop('disabled', false);
  });
}
function submit_form_modal(){
  $(':input[onclick="submit_form_modal()"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Đang xử lý');
  $.post('', $('#form_edit').serialize()).done(function(data){
      console.log(data);
      var a = jQuery.parseJSON(data);
      toastr[a.type](a.mess);
      if(a.type == 'success'){
        $('#edit_model').modal('hide');
      }
    }).fail(function(){
        toastr["warning"]("<b>Lỗi</b>");
    }).always(function(){
      $(':input[onclick="submit_form_modal()"]').prop('disabled', false).html('Lưu thay đổi');
    });
}
/*Auto tương tác*/

$('#auto_tuong_tac_submit').submit(function(){
  $(':input[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Đang tiến hành cài đặt...');
  $('.loader').show();
  $.post('', $(this).serialize()).done(function(data){
    console.log(data);
    var a = jQuery.parseJSON(data);
    toastr[a.type](a.mess);
    $(':input[type="submit"]').prop('disabled', false).html('Tiến hành cài');
    if(a.type == 'success'){
      setTimeout(function() {
          location.reload();
      }, 4000);
    }
  }).fail(function(){
    toastr["warning"]("<b>Lỗi không biết</b>");
  }).always(function(){
     $('.loader').hide();
  });
  return false;
});
/*Bot comment*/
$('#add_cmt').click(function(){
  var a = parseInt($('#num_cmt').val()) + 1;
  if(a >= 5){
    toastr["info"]("<b>Bạn chỉ có thể sử dụng tối đa 5 bình luận</b>");
    return true;
  }
  $('#cmt_list').append(' <div id="cmt_'+a+'"> <div class="card-box" > <span class="input-icon icon-right"> <textarea rows="2" class="form-control" placeholder="Nội dung bình luận" name="noidung[]" id="noidung_'+a+'" required=""></textarea> </span> <span class="input-icon icon-left"> <br><div id="img_link_'+a+'"> <div id="img_link_0"><input type="hidden" name="img_link[]" class="form-control" value=""></input><p class="text-info">* Chưa có ảnh được chọn</p></div></div></span> <ul class="nav nav-pills m-t-10"> <li> <a onclick="tag_me('+a+')" href="#"><i class="fa fa-user"></i></a> </li><li> <a onclick="add_img('+a+')" href="#"><i class=" fa fa-camera"></i></a> </li><li> <a onclick="rand_icon('+a+')" href="#"><i class="fa fa-smile-o"></i></a> </li><li> <a onclick="delete_add_cmt('+a+')" class="text-danger" href="#"><i class=" fa fa-trash"></i></a> </li></ul> </div>');
  $('#num_cmt').val(a);
});
function tag_me(id){
    var nd = $('#noidung_'+id).val();
    $('#noidung_'+id).val(nd+'{{tag}}');
}
function rand_icon(id){
    var nd = $('#noidung_'+id).val();
    $('#noidung_'+id).val(nd+'{{ri}}');
}
function delete_add_cmt(id){
    $('#cmt_'+id).html('');
    var a = parseInt($('#num_cmt').val()) - 1;
    $('#num_cmt').val(a);
}
function add_img(id){
  $('#upload_img_hi').click();
  $('#where_img').val(id);
  $("#upload_img_hi").change(function(){
  });
}

$("#upload_img_hi").change(function(){
    var a = $(this).val();
    if(a!= ''){
        console.log(a);
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            toastr["warning"]("<b>Bạn chỉ có thể tải lên hình ảnh.</b>");
            return false;
        } else {
            var b = $('#where_img').val();
            $('#img_link_'+b).html('<i class="fa fa-spinner fa-pulse"></i> Đang tiến hành upload file...');
            $("#upload_file").submit();
        }
    }
});

$("#upload_file").on('submit',(function(e){
    e.preventDefault();
    $.ajax({
      url: "",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
          if(data == 'error') {
             toastr["warning"]("<b>Lỗi khi tải lên. Thử lại sau!</b>");
             var b = $('#where_img').val();
             $('#img_link_'+b).html('<p class="text-info">* Chưa có ảnh được chọn</p>');
          }else{
            var b = $('#where_img').val();
            $('#img_link_'+b).html('<div class="form-group has-success has-feedback"><input type="text" name="img_link[]" class="form-control" value="'+data+'"></input><span class="glyphicon glyphicon-ok form-control-feedback"></span></div>');
             console.log(data);
          }
      },
      error: function(){
        console.log('Loi');
      }           
    });
}));

$('#trideptraivaidai').submit(function(){
 
  $(':input[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-pulse"></i> Đang xử lý...Vui lòng đợi....');
  $('.loader').show();

  $.post('', $(this).serialize()).done(function(data){

    var a = jQuery.parseJSON(data);
    //console.log(a);

    toastr[a.type](a.mess);
   
    if(a.type == 'success'){
      setTimeout(function(){
        location.reload();
         $(':input[type="submit"]').prop('disabled', true).html('Đang đợi chuyển hướng');
      }, 2000);
    }else{
       $(':input[type="submit"]').prop('disabled', false);
         $('.loader').hide();
    }
  }).fail(function(){
    toastr["warning"]("<b>Lỗi</b>");
  });
  return false;

});

//Delete Comment 
function delete_comment(id){
  if(confirm("Bạn có chắc chắn muốn xóa comment này ?")){
      $.post('', {delete_comment: id}).done(function(data){
        //console.log(data);
        var a = jQuery.parseJSON(data);
        toastr[a.type](a.mess);
       
        if(a.type == 'success'){
            $('#cmt_'+id).html('');
        }
      }).fail(function(){
        toastr["warning"]("<b>Lỗi</b>");
      });
      return false;
  }
}
//Edit Comment
function edit_comment(id){

  $(':button[onclick="edit_comment('+id+')"]').prop('disabled', true);
  $.post('', {get_json_oki: id}).done(function(data){
    var a = jQuery.parseJSON(data);
    console.log(a);
    if(a.image == ''){
      var lol = '<div id="anh_modal"> <p class="text-muted">Không có ảnh</p></div><br><a onclick="change_img()" id="change_img" href="#">Thêm ảnh</a> <div id="delete_bt" style="display: none;"><a href="#" class="text-danger" onclick="delete_img()">Xóa ảnh</a></div><input type="hidden" name="image" value="" id="paste_here">';
    }else{
      var lol = '<div id="anh_modal"> <label>* Ảnh kèm theo: </label><br><img src="'+a.image+'" width="100px"> </div><br><a onclick="change_img()" id="change_img" href="#">Thay đổi ảnh</a> <div id="delete_bt"><a href="#" class="text-danger" onclick="delete_img()">Xóa ảnh</a></div><input type="hidden" name="image" value="'+a.image+'" id="paste_here"> ';
    }
    $('#trideptrai').html('<div id="edit_cmt_modal" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Chỉnh sửa comment</h4> </div><div class="modal-body"> <form id="nd_cmt"> <div class="form-group"> <label>* Nội dung comment: </label> <textarea class="form-control" rows="3" placeholder="Điền nội dung comment vào đây..." name="message">'+a.message+'</textarea> </div><center> <div class="form-group"> '+lol+' <input type="hidden" name="trideptraiid" value="'+a.id+'"> </div></center> </form> </div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" onclick="submit_cmt()">Lưu thay đổi</button> </div></div></div></div>');
    $('#edit_cmt_modal').modal('show');
      $(':button[onclick="edit_comment('+id+')"]').prop('disabled', false);
  }).fail(function(){
     toastr["warning"]("<b>Lỗi hệ thống !</b>");
     $(':button[onclick="edit_comment('+id+')"]').prop('disabled', false);
  });
  //  

}
function change_img(){
   $('#change_img_hi').click();
}

$("#change_img_hi").change(function(){
    var a = $(this).val();
    if(a!= ''){
        console.log(a);
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            toastr["warning"]("<b>Bạn chỉ có thể tải lên hình ảnh.</b>");
            return false;
        } else {
            $("#change_photo_submit").submit();
            $("#change_img").html('<i class="fa fa-spinner fa-pulse"></i> Đang tải lên...').prop('disabled', true);
        }
    }
});

$("#change_photo_submit").on('submit',(function(e){
    e.preventDefault();
    $.ajax({
      url: "",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data){
          if(data == 'error') {
             toastr["warning"]("<b>Lỗi khi tải lên. Thử lại sau!</b>");
          }else{
            $("#anh_modal").html('<label>* Ảnh kèm theo: </label><br><img src="'+data+'" width="100px"> ');
            $("#change_img").html('Thay đổi ảnh');
            $(':input[name="image"]').val(data);
            $('#delete_bt').show();
          }
      },
      error: function(){
        console.log('Loi');
      }           
    });
}));
function delete_img(){
  $('#anh_modal').html('<p class="text-muted">Không có ảnh</p>');
  $('#linkanh').val('');
  $('#delete_bt').hide();
  $('#change_img').html('Thêm ảnh');
}
function submit_cmt(){

  $(':input[onclick="submit_cmt()"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Đang xử lý');
  $.post('', $('#nd_cmt').serialize()).done(function(data){
      console.log(data);
      var a = jQuery.parseJSON(data);
      toastr[a.type](a.mess);
      if(a.type == 'success'){
        $('#edit_model').modal('toggle');
        setTimeout(function(){
          location.reload();
        }, 1000);
      }
    }).fail(function(){
        toastr["warning"]("<b>Lỗi</b>");
    }).always(function(){
      $(':input[onclick="submit_cmt()"]').prop('disabled', false).html('Lưu thay đổi');
    });

}
function add_cmt_submit(){
  
  $(':input[onclick="add_cmt_submit()"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Đang xử lý');
  $.post('', $('#add_cmt_form').serialize()).done(function(data){
      console.log(data);
      var a = jQuery.parseJSON(data);
      toastr[a.type](a.mess);
      if(a.type == 'success'){
        $('#edit_model').modal('toggle');
        setTimeout(function(){
          location.reload();
        }, 1000);
      }
    }).fail(function(){
        toastr["warning"]("<b>Lỗi</b>");
    }).always(function(){
      $(':input[onclick="add_cmt_submit()"]').prop('disabled', false).html('Lưu thay đổi');
    });

}