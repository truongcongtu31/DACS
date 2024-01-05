<script src="{{ asset('frontend/vendor/animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick-custom.js') }}"></script>
<script src="{{ asset('frontend/vendor/parallax100/parallax100.js') }}"></script>
<script src="{{ asset('frontend/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script>
    $(document).ready(function () {
        box();
        handleActiveMenu();
        handleActiveCategory();
        $('.parallax100').parallax100();
    });

    $(document).ready(function () {
        $('.gallery-lb').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    });

    $(document).ready(function () {
        $('.js-pscroll').each(function () {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function () {
                ps.update();
            })
        });
    });

    function box() {
        $(".js-select2").each(function () {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    }

    function handleActiveCategory() {
        var urlCurent = window.location.href;
        $('.category button a').each(function () {
            var urlMenu = $(this).attr("href");
            if (urlMenu === urlCurent) {
                $(this).closest('button').addClass('how-active1')
            }
        })
    }

    function handleActiveMenu() {
        var urlCurent = window.location.href;
        $(".main-menu li a").each(function () {
            var urlMenu = $(this).attr("href");
            if (urlCurent === urlMenu) {
                $(this).closest('li').addClass('active-menu')
            }
        })
    }

    //Cart
    $('.js-show-cart').on('click', function () {
        $.ajax({
            type: 'GET',
            url: "{{ route('get-modal-cart') }}",
            success: function (data) {
                $('#modal-cart').html(data.html);
                $('.js-panel-cart').addClass('show-header-cart');
                $('.js-hide-cart').on('click', function () {
                    $('.js-panel-cart').removeClass('show-header-cart');
                });
            }
        })
    });
    $(document).on('click', '.add-to-cart', function () {
        var id = $(this).data('id');
        addToCart(addToCartUrl, id);
    });
    $(document).on('click', '.add-to-cart-detail', function () {
        var id = $(this).data('id');
        var url = $(this).data('url-cart');
        addToCart(url, id)
    });

    $(document).on('click', '.update-cart', function () {
        var url = $(this).data('url');
        updateCart(url)

    });
    $(document).on('click', '.delete-cart', function (e) {
        var url = $(this).data('url');
        var id = $(this).data('id');
        deleteCart(url, id);
        $('.js-show-cart').trigger('click')

    });
    $(document).on('click', '.delete-cart-detail', function (e) {
        var url = $(this).data('url');
        var id = $(this).data('id');
        deleteCart(url, id)
    });

    $(document).on('click', '#checkout', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        checkOutOrder(url);
    });

    let addToCartUrl;

    function addToCart(addToCartUrl, id) {
        if (addToCartUrl) {
            let url = addToCartUrl;
            var input = $('.quantity-product-' + id);
            var quantity = input.val();
            console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    'quantity': quantity
                },
                success: function (data) {
                    console.log(data);
                    if (data.status === 200) {
                        $('#num').attr('data-notify', data.num);
                        input.val(1);
                        $('.js-show-cart').attr('data-notify', data.num);
                        swal('Success', 'Added to cart', 'success')
                    } else if (data.status === 400) {
                        input.val(1);
                        swal('Error', 'Add to cart failed', 'error')
                    }
                    //$('.js-show-cart').trigger('click');
                }
            })
        } else {
            console.error("Data-url is not set.");
        }
    }

    function updateCart(url) {
        var data = [];
        $('.quantity-product').each(function () {
            var id = $(this).data('id');
            var quantity = $(this).val();
            data.push({
                id: id,
                quantity: quantity
            });
        });
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                data: JSON.stringify(data)
            },
            contentType: 'JSON',
            success: function (data) {
                if (data.status === 0) {
                    alertify.error('Update error!')
                }
                if (data.status === 200) {
                    $('#product-cart').html(data.html);
                    quantityProduct();
                    box();
                    alertify.success('Update success')
                } else if (data.status === 400) {
                    $('#product-cart').html(data.html);
                    quantityProduct();
                    box();
                    alertify.error('Update error!')
                }
            }
        })
    }

    function deleteCart(url, id) {
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                id: id
            },
            success: function (data) {
                if (data.status === 200) {
                    $('#product-cart').html(data.html);
                    $('#num').attr('data-notify', data.num);
                    quantityProduct();
                    box();
                    alertify.success('Delete success')


                } else if (data.status === 400) {

                    $('#product-cart').html(data.html);
                    quantityProduct();
                    box();
                    alertify.error('Delete error!')
                }
            }
        })
    }

    function checkOutOrder(url) {
        var payment = $('#payment').val();
        var address = $('.address').val();
        var phone = $('.phone').val();
        var note = $('.note').val();
        var total = $('.total').data('total');

        // Show the confirmation dialog
        swal({
            title: "Confirm",
            text: "Payment confirmation?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((userConfirmed) => {
            if (userConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        payment: payment,
                        address: address,
                        phone: phone,
                        note: note,
                        total: total
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 0) {
                            swal('Error', 'Check your delivery information again', 'error');
                        } else if (data.status === 404) {
                            swal('Error', data.msg, 'error');
                        } else if (data.status === 400) {
                            window.location = data.route;
                        } else {
                            swal("Success", 'You have successfully paid', 'success');
                            window.location = "{{route('cart')}}";
                        }
                    },
                    error: function (data) {
                        window.location = "{{route('verification.notice')}}";
                    }

                });
            } else {

            }
        });
    }


    //Search
    $(document).ready(function () {
        handleSearch();
    });

    function handleSearch() {
        $('#search-product').on('keyup', function () {
            var value = $(this).val();
            if (value.length === 0) {
                return;
            }
            $.ajax({
                type: 'GET',
                url: '{{route('shop.search')}}',
                data: {
                    'search': value
                },
                success: function (data) {
                    console.log(data);
                    $('#product').html(data.html);
                    $('.js-show-modal1').on('click', function (e) {
                        e.preventDefault();
                        $('.js-modal1').addClass('show-modal1');
                    });
                }
            })
        })
    }

    //Quick View Modal
    $(document).on('click', '.quick-view-btn', function (e) {
        e.preventDefault();
        var productURL = $(this).data('url');
        console.log(productURL);
        quickView(productURL);
    });

    function quickView(productUrl) {
        $.ajax({
            type: 'GET',
            url: productUrl,
        })
            .done(function (data) {
                console.log(data);
                if (data) {
                    var wrapSlick3Dots = $(".wrap-modal").find('img');
                    wrapSlick3Dots.eq(0).attr('src', data.image_detail_1);
                    wrapSlick3Dots.eq(1).attr('src', data.image_detail_2);
                    wrapSlick3Dots.eq(2).attr('src', data.image_detail_3);
                    $('#name_product_modal').text(data.name);
                    $('#tag').text("TAG: " + data.tag);
                    $('#price').text(data.price);
                    $('#description_product_modal').html(data.description);
                    var imageDetails = [$("#image-detail-1"), $("#image-detail-2"), $("#image-detail-3")];
                    var details = [$("#detail-1"), $("#detail-2"), $("#detail-3")];
                    var imageDetailsSrc = [data.image_detail_1, data.image_detail_2, data.image_detail_3];
                    for (var i = 0; i < 3; i++) {
                        imageDetails[i].attr("src", imageDetailsSrc[i]);
                        details[i].attr("href", imageDetailsSrc[i]);
                    }
                    $('.add-to-cart').attr('data-id', data.id);
                    $('#quantity').addClass('quantity-product-' + data.id);
                    $('.quantity-product-' + data.id).val(1);
                    $('.wrap-num-product').find('div').attr('data-id', data.id);
                    addToCartUrl = "{{route('add-to-cart')}}" + '/' + data.id;
                } else {
                    console.error("Data is not set.");
                }
            })
    }


    //Quantity Product
    $(document).ready(function () {
        quantityProduct();
    });

    function quantityProduct() {
        $('.btn-num-product-up').on('click', function () {
            var id = $(this).data('id');
            increaseValue(id);
        });
        $('.btn-num-product-down').on('click', function () {
            var id = $(this).data('id');
            decreaseValue(id);
        })
    }

    function increaseValue(id) {
        if (id) {
            var input = $('.quantity-product-' + id);
            var quantity = parseInt(input.val(), 10);
            if (!isNaN(quantity) && quantity >= 1) {
                input.val(quantity + 1)
            }
        }
    }

    function decreaseValue(id) {
        if (id) {
            var input = $('.quantity-product-' + id);
            var quantity = parseInt(input.val(), 10);
            if (!isNaN(quantity) && quantity > 1) {
                input.val(quantity - 1)
            }
        }
    }


    //Feedback Product

    $('#review-feedback').click(function () {
        var page = $(this).attr('href').split('page=')[1];
        var id = $('#product_id').val();
        paginateFeedback(page, id);
    });

    $(document).on('click', '#feedback-pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var id = $('#product_id').val();
        paginateFeedback(page, id);
    });

    $(document).on('click', '.btn-submit-feedback', function () {
        var data = {
            'star': $('#rating').val(),
            'content': $('#review').val(),
            'name': $('#name').val(),
            'email': $('#email').val(),
            'product_id': $('#product_id').val()
        };

        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '{{route('feedback.add')}}',
            data: data,
            dataType: 'json',
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (response) {
                console.log(response);
                if (response.status === 403) {
                    window.location = "{{route('login')}}";
                } else if (response.status === 400) {
                    swal('Error', 'Purchase is required to comment', 'error')
                } else if (response.status === 0) {
                    $.each(response.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    })
                } else {
                    $('#rating').val('');
                    $('#review').val('');
                    $('#name').val('');
                    $('#email').val('');
                    $('#review-feedback').trigger('click');
                    alertify.success("Thank you for your feedback!")
                }
            }
        })
    });

    function paginateFeedback(page, id) {
        $.ajax({
            type: 'GET',
            url: '{{ route('feedback.show') }}' + '?id=' + id + '&page=' + page,
            success: function (data) {
                $('#feedback-ajax').html(data.html);
                console.log(data.html)
            }
        });
    }

    //Add comment
    $(document).on('click', '.post_comment', function (e) {
        e.preventDefault();
        var data = $('#form-comment').serialize();
        var url = $(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            dataType: 'json',
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (data) {
                console.log(data);
                if (data.status === 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error1').text(val[0])
                    });
                } else if (data.status == 1) {
                    $('#show_comment').html(data.html);
                    $('.name-comment').val('');
                    $('.email-comment').val('');
                    $('.content-comment').val('');
                    alertify.success("Thank you for your comment!")
                }
            }
        })
    });

    $(document).on('click', '#comment-pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var id = $('.post_comment').data('id');
        paginateComment(page, id);
    });

    function paginateComment(page, id) {
        $.ajax({
            type: 'GET',
            url: '{{ route('show-comment-ajax') }}' + '?id=' + id + '&page=' + page,
            success: function (data) {
                $('#show_comment').html(data.html);
                console.log(data.html)
            }
        });
    }


    //Order
    $(document).on('click', '.modal-detail-order', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: "{{route('order.detail.show')}}" + "/" + $(this).data('id'),
            data: $(this).data('id'),
            success: function (data) {
                console.log(data);
                $('#modal-order').html(data.html);
                $("#exampleModalCenter").modal("show");
            }
        });
    })
</script>
