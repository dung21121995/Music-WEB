
function sub1(input, thumbimage) {
    if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#thumbimage").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    else { // Sử dụng cho IE
        $("#thumbimage").attr('src', input.value);
    }
    $("#thumbimage").show();
    $('.filename').text($("#upfile1").val());
    $(".removeimg").show();
}
$(document).ready(function () {
    $(".bottomright").bind('click', function () { //Chọn file khi .Choicefile Click
        $("#upfile1").click();
    });
    $(".removeimg").click(function () {//Xóa hình  ảnh đang xem
        $("#thumbimage").attr('src', '').hide();
        $("#upfile1").html('<input type="file" id="upfile1" class="uploadfile" name="ImageUpload" onchange="sub1(this);" />');
        $(".removeimg").hide();
        $(".filename").text("");
    });
})
function sub2(input, thumbimage1) {
    if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#thumbimage1").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    else { // Sử dụng cho IE
        $("#thumbimage1").attr('src', input.value);
    }
    $("#thumbimage1").show();
    $('.filename1').text($("#upfile12").val());
    $(".removeimg1").show();
}
function getFile() {
    document.getElementById("upfile").click();
}

function sub(obj) {
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
    document.myForm.submit();
    event.preventDefault();
}

$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});


function checkall(class_name, obj) {
    // duyệt qua các check box có class= class_name (item)
    // trả về các phần tử khác ở dạng mảng, bắt đầu từ vị trí 0
    var items = document.getElementsByClassName(class_name);
    if (obj.checked == true) { // đã được chọn
        for (i = 0; i < items.length; i++) {
            items[i].checked = true;
        }

    } else {
        for (i = 0; i < items.length; i++) {
            items[i].checked = false;
        }
    }
}

