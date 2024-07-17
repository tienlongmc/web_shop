$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore()
{
    let page = parseInt($('#page').val());
    console.log(page)
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data : { page },
        url : '/services/load-product',
        success : function (result) {
            if (result.html != '') {
                $('#loadProduct').append(result.html);
                page++; // Tăng giá trị page lên 1 để load trang tiếp theo
                $('#page').val(page);
            } else {
                alert('Đã load xong Sản Phẩm');
                $('#button-loadMore').css('display', 'none');
            }
        }
    })
}