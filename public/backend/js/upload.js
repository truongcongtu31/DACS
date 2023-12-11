$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var loadImage = function (event) {
    var id = $(event.target).data('id');
    var output = $("#img_show_product_" + id);
    output.removeClass('d-none');
    output.attr('src', URL.createObjectURL(event.target.files[0]));
};

var loadSlide = function (event) {
    var output = $("#img_showslide");
    output.removeClass('d-none');
    output.attr('src', URL.createObjectURL(event.target.files[0]));
};

var loadBanner = function (event) {
    var output = $("#img_showbanner");
    output.attr('src', URL.createObjectURL(event.target.files[0]));
};

var loadBlog = function (event) {
    var output = $("#img_showblog");
    output.attr('src', URL.createObjectURL(event.target.files[0]));
};
var loadAbout = function (event) {
    var output = $("#img_showabout");
    output.attr('src', URL.createObjectURL(event.target.files[0]));
};
//
// // Upload file image product
// $('#upload_product').change(function () {
//     const form = new FormData();
//     form.append('file', $(this)[0].files[0]);
//
//     $.ajax({
//         processData: false,
//         contentType: false,
//         type: 'POST',
//         dataType: 'JSON',
//         data: form,
//         url: '/admin/upload/products',
//         success: function (result) {
//             if (result.error == false) {
//                 $('#img_show_product').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:180px;"></a>');
//                 $('#img_old_product').css('display', 'none');
//                 $('#hinhanh_product').val(result.url)
//             } else {
//                 alert('Upload file lỗi')
//             }
//         }
//     })
// });
//
//
// // Upload file image product detail 1
// $('#upload_product1').change(function () {
//     const form = new FormData();
//     form.append('file', $(this)[0].files[0]);
//
//     $.ajax({
//         processData: false,
//         contentType: false,
//         type: 'POST',
//         dataType: 'JSON',
//         data: form,
//         url: '/admin/upload/products',
//         success: function (result) {
//             if (result.error == false) {
//                 $('#img_show_product1').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:180px;"></a>');
//                 $('#img_old_product1').css('display', 'none');
//                 $('#hinhanh_product1').val(result.url)
//             } else {
//                 alert('Upload file lỗi')
//             }
//         }
//     })
// });
//
// // Upload file image product detail 2
// $('#upload_product2').change(function () {
//     const form = new FormData();
//     form.append('file', $(this)[0].files[0]);
//
//     $.ajax({
//         processData: false,
//         contentType: false,
//         type: 'POST',
//         dataType: 'JSON',
//         data: form,
//         url: '/admin/upload/products',
//         success: function (result) {
//             if (result.error == false) {
//                 $('#img_show_product2').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:180px;"></a>');
//                 $('#img_old_product2').css('display', 'none');
//                 $('#hinhanh_product2').val(result.url)
//             } else {
//                 alert('Upload file lỗi')
//             }
//         }
//     })
// });
// // Upload file image product detail3
// $('#upload_product3').change(function () {
//     const form = new FormData();
//     form.append('file', $(this)[0].files[0]);
//
//     $.ajax({
//         processData: false,
//         contentType: false,
//         type: 'POST',
//         dataType: 'JSON',
//         data: form,
//         url: '/admin/upload/products',
//         success: function (result) {
//             if (result.error == false) {
//                 $('#img_show_product3').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:180px;"></a>');
//                 $('#img_old_product3').css('display', 'none');
//                 $('#hinhanh_product3').val(result.url)
//             } else {
//                 alert('Upload file lỗi')
//             }
//         }
//     })
// });
// // Upload file image slide
$('#uploadslide').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/slides',
        success: function (result) {
            if (result.error == false) {
                $('#img_showslide').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:200px;height:110px;"></a>');
                $('#img_oldslide').css('display', 'none');
                $('#hinhanhslide').val(result.url)
            } else {
                alert('Upload file lỗi')
            }
        }
    })
});
// Upload file image banner
$('#uploadbanner').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/banners',
        success: function (result) {
            if (result.error == false) {
                $('#img_showbanner').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:200px;height:110px;"></a>');
                $('#img_oldbanner').css('display', 'none');
                $('#hinhanhbanner').val(result.url)
            } else {
                alert('Upload file lỗi')
            }
        }
    })
});

// Upload file image about
$('#uploadabout').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/abouts',
        success: function (result) {
            if (result.error == false) {
                $('#img_showabout').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:200px;height:140px;"></a>');
                $('#img_oldabout').css('display', 'none');
                $('#hinhanhabout').val(result.url)
            } else {
                alert('Upload file lỗi')
            }
        }
    })
});


// Upload file image blog
$('#uploadblog').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/blogs',
        success: function (result) {
            if (result.error == false) {
                $('#img_showblog').html('<a href="' + result.url + '" target="_blank"><img src="' + result.url + '" style="width:200px;height:110px;"></a>');
                $('#img_oldblog').css('display', 'none');
                $('#hinhanhblog').val(result.url)
            } else {
                alert('Upload file lỗi')
            }
        }
    })
});

