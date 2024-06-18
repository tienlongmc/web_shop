$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function RemoveRow(id, url) {
  if (confirm('Xác nhận xóa')) { // Hiển thị hộp thoại xác nhận
      $.ajax({
          type: 'DELETE', // Sử dụng phương thức DELETE trong yêu cầu AJAX
          datatype: 'JSON',
          data: { id }, // Gửi chỉ mục của hàng cần xóa
          url: url, // Địa chỉ URL để gửi yêu cầu DELETE
          success: function (result) {
              if (result.error === false) { // Nếu không có lỗi
                  alert(result.message); // Hiển thị thông báo thành công
                  location.reload(); // Tải lại trang để cập nhật giao diện
              } else {
                  alert("Xóa lỗi"); // Hiển thị thông báo lỗi nếu có lỗi xảy ra
              }
          }
      })
  }
}

// Upload file
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
       
        success: function (results) {
            console.log(results)
            if (results.error === false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a>');

                $('#thumb').val(results.url);
               
            } else {
                alert('Upload File Lỗi');
            }
        }
    });
});
