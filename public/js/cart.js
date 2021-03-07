
(function ($) {
    "use strict";
    $('.bx_book_info_quantity_field .bx_number').on('mouseup keyup', function () {
        $(this).val(Math.min(100, Math.max(1, $(this).val())));
    });
    var $quantityArrowMinus = $(".quantity-arrow-minus");
    var $quantityArrowPlus = $(".quantity-arrow-plus");
    var $quantityNum = $(".bx_cart_page .bx_number");
    $quantityArrowPlus.each(function () {
        $(this).click(function () {
            $(this).parent().siblings('.bx_number').val(+$(this).parent().siblings('.bx_number').val() + 1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $This = $(this);
            $.ajax({
                type: 'GET',
                url: 'cart/' + $(this).parent().data('id') + '/update',
                data: {
                    qty: $(this).parent().siblings('.bx_number').val(),
                },
                success: function (data) {
                    if (data.error) {
                        toastr.error(data.error, '');
                    } else {
                        $This.parent().parent().parent().siblings().find('.bx_cart_item_total_price').find('span').html("Tk. "+data.item_total);
                        $This.parent().parent().parent().siblings().find('.bx_cart_item_total_price').attr('data-item-total-price', data.item_total);
                        $('#bx_cart_subtotal_number').attr('data-subtotal', data.subtotal).find('span').html("Tk. "+data.subtotal);
                        $('#bx_book_total').html("Tk. "+data.gettotal);
                    }
                }
            });
        });
    });
    $quantityArrowMinus.each(function () {
        $(this).click(function () {
            if ($(this).parent().siblings('.bx_number').val() > 1) {
                $(this).parent().siblings('.bx_number').val(+$(this).parent().siblings('.bx_number').val() - 1);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var $This = $(this);
                $.ajax({
                    type: 'GET',
                    url: 'cart/' + $(this).parent().data('id') + '/update',
                    data: {
                        qty: $(this).parent().siblings('.bx_number').val(),
                    },
                    success: function (data) {
                        if (data.error) {
                            toastr.error(data.error, '');
                        } else {
                            $This.parent().parent().parent().siblings().find('.bx_cart_item_total_price').find('span').html("Tk. "+data.item_total);
                            $This.parent().parent().parent().siblings().find('.bx_cart_item_total_price').attr('data-item-total-price', data.item_total);
                            $('#bx_cart_subtotal_number').attr('data-subtotal', data.subtotal).find('span').html(data.subtotal);
                            $('#bx_book_total').html(data.gettotal);
                        }
                    }
                });
            }
        });
    });
    $('.bx_cart_remove_btn').each(function () {
        $(this).click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $This = $(this);
            $.ajax({
                type: 'DELETE',
                url: 'cart/' + $(this).data('id') + '/delete',
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.success, '');
                        $This.parent().parent('.bx_cart_body_content').remove();
                        if (data.total) {
                            $('.bx_header_total_cart').html("Tk. "+data.total);

                        }
                        $('#bx_cart_subtotal_number').attr('data-subtotal', data.subtotal).find('span').html("Tk. "+data.subtotal);
                        $('#bx_book_total').html("Tk. "+data.gettotal);
                        if (data.total == 0) {
                            $('.bx_book_continue_shopping').removeClass('d-none').addClass('d-block');
                            $('#bx_book_shipping').html('Tk. 0');
                            $('#bx_book_total').html('Tk. 0');
                            $('#coupon_dicount').html('Tk. 0');
                        }
                    } else {
                        toastr.error(data.error, '');
                    }
                }
            });
        });
    });



    $("#bx_cart_coupon_btn").click(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var code = $("#bx_cart_coupon_field").val();

        if (code == "") {
            $('#bx_coupon_message').html("This coupon field is Required");
        } else {
            $('#bx_coupon_message').html("");
            $.ajax({
                type: 'POST',
                url: '/cart/coupon/' + code,
                data: { code: code },
                success: function (data) {
                    if (data.error) {
                        $('#bx_coupon_message').removeClass('text-success').addClass('text-danger').html(data.error);
                    } else {
                        $('#coupon_view').html(data.coupon_view);
                        $('#bx_book_total').html("Tk. "+data.gettotal);
                        $('#bx_coupon_message').removeClass('text-danger').addClass('text-success').html("You Get A " + data.discount + "% Discount");
                    }
                }
            });
        }
    });
})(jQuery);
