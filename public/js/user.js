const pageContext = $('meta[name=context-path]').attr('content');
const CSRF = $("meta[name='csrf-token']").attr('content');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function phoneNumberEdit() {
    $('.edit_phone').hide();
    $('.phone-change').removeAttr('disabled');
    $('.phone-change').val('');
    $('.phone-change').attr('placeholder', 'Enter your new mobile number');
    $('#phoneNumber').removeClass('d-none');
}
function updatePhoneNumber() {
    if ($('.phone-change').val().length < 9) {
        $('#phoneChangeSuccessMsg').text("Please Enter Valid Phone Number");
        $('#phoneChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
        setTimeout(function () {
            $('#phoneChangeSuccessMsg').fadeOut(1000);
        }, 3000);
        return false;
    }
    $('#phoneNumber').hide();
    // $.ajax({
    //     type: "POST",
    //     url: pageContext + "/my-section/phone/change/request",
    //     data: "phone=" + $('.phone-change').val() + "&_tk=" + CSRF,
    //     success: function(response) {
    //         if (response.result == true) {
    //             $('#phoneSection').hide();
    //             $('#otpSection').removeClass('d-none');
    //             $('#phoneNumberViaOtp').removeClass('d-none');
    //             $('#phoneChangeSuccessMsg').text(response.message);
    //             $('#phoneChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').show();
    //             setTimeout(function() {
    //                 $('#phoneChangeSuccessMsg').fadeOut(1000)
    //             }, 2000)
    //         } else {
    //             $('#phoneChangeSuccessMsg').text(response.message);
    //             $('#phoneChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
    //             setTimeout(function() {
    //                 $('#phoneChangeSuccessMsg').fadeOut(1000)
    //             }, 2000)
    //             $('#phoneNumber').show();
    //         }
    //     },
    //     error: function(error) {},
    //     complete: function() {}
    // });
}
// function updatePhoneNumberViaOtp() {
//     $('#phoneNumberViaOtp').hide();
//     $.ajax({
//         type: "POST",
//         url: pageContext + "/my-section/phone/change",
//         data: "phone=" + $('.phone-change').val() + "&code=" + $('.otpCode').val() + "&_tk=" + CSRF,
//         success: function(response) {
//             if (response.result == true) {
//                 $('#phoneChangeSuccessMsg').text(response.message);
//                 $('#phoneChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').show();
//                 setTimeout(function() {
//                     $('#phoneChangeSuccessMsg').fadeOut(1000)
//                 }, 2000)
//             } else {
//                 $('#phoneChangeSuccessMsg').text(response.message);
//                 $('#phoneChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
//                 setTimeout(function() {
//                     $('#phoneChangeSuccessMsg').fadeOut(1000)
//                 }, 2000)
//                 $('#phoneNumberViaOtp').show();
//             }
//         },
//         error: function(error) {},
//         complete: function() {}
//     });
// }


function emailAddressEdit() {
    $('.edit_email').hide();
    $('.email-change').removeAttr('disabled');
    $('.email-change').val('');
    $('.email-change').attr('placeholder', 'Enter your new email address');
    $('#emailAddress').removeClass('d-none');
}
function updateEmailAddress() {
    if (!isEmail($('.email-change').val())) {
        $('#emailChangeSuccessMsg').text("Please Enter Valid Email Address");
        $('#emailChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
        setTimeout(function () {
            $('#emailChangeSuccessMsg').fadeOut(1000);
        }, 3000);
        return false;
    }
    $('#emailAddress').hide();
    $.ajax({
        type: "POST",
        url: "/my-section/email/change/request",
        data: {
            email: $('.email-change').val(),
        },
        success: function (response) {
            if (response.result == true) {
                $('#emailSection').hide();
                $('#otpSection2').removeClass('d-none');
                $('#emailAddressViaOtp').removeClass('d-none');
                $('#emailChangeSuccessMsg').text(response.message);
                $('#emailChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').show();
                setTimeout(function () {
                    $('#emailChangeSuccessMsg').fadeOut(1000);
                }, 2000);
            } else {
                $('#emailChangeSuccessMsg').text(response.message);
                $('#emailChangeSuccessMsg').removeAttr('class').removeClass('text-success').addClass('ml-4').addClass('text-danger').show();
                setTimeout(function () {
                    $('#emailChangeSuccessMsg').fadeOut(1000);
                }, 2000);
                $('#emailAddress').show();
            }
        },
        error: function (error) { },
        complete: function () { }
    });
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function updateEmailAddressViaOtp() {
    $('#emailAddressViaOtp').hide();
    $.ajax({
        type: "POST",
        url: "/my-section/email/change",
        data: {
            email: $('.email-change').val(),
            user_opt: $('.otpCode2').val(),
        },
        success: function (response) {
            if (response.result == true) {
                $('#emailChangeSuccessMsg').text(response.message);
                $('#emailChangeSuccessMsg').removeAttr('class').addClass('text-success').addClass('ml-4').show();
                setTimeout(function () {
                    $('#emailChangeSuccessMsg').fadeOut(1000);
                }, 2000);
            } else {
                $('#emailChangeSuccessMsg').text(response.message);
                $('#emailChangeSuccessMsg').removeAttr('class').removeClass('text-success').addClass('ml-4').addClass('text-danger').show();
                setTimeout(function () {
                    $('#emailChangeSuccessMsg').fadeOut(1000);
                }, 2000);
                $('#emailAddressViaOtp').show();
            }
        },
        error: function (error) { },
        complete: function () { }
    });
}

function personalInfoEdit() {
    $('.my_info_edit').hide();
    $('.personal').removeAttr('disabled');
    $('#personalInfo').removeClass('d-none');
}
function updateUserInfo() {
    var name = $('.name').val();
    var gender = $("input[type='radio'][name='gender']:checked").val();

    if (name.length == 0) {
        $('#userInfoChangeMsg').text("Please Enter Valid Name");
        $('#userInfoChangeMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
        setTimeout(function () {
            $('#userInfoChangeMsg').fadeOut(1000);
        }, 3000);
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/my-section/profile-update",
        data: {
            name: name,
            gender: gender,
        },
        success: function (response) {
            if (response.result == true) {
                $('#userInfoChangeMsg').text(response.message);
                $('#userInfoChangeMsg').removeAttr('class').addClass('text-success').addClass('ml-4').show();
                setTimeout(function () {
                    $('#userInfoChangeMsg').fadeOut(1000);
                }, 3000);
            } else {
                $('#userInfoChangeMsg').text(response.message);
                $('#userInfoChangeMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
                setTimeout(function () {
                    $('#userInfoChangeMsg').fadeOut(1000);
                }, 3000);
            }
        },
        error: function (error) {
            $('#userInfoChangeMsg').text("Oops! something went wrong");
            $('#userInfoChangeMsg').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
            setTimeout(function () {
                $('#userInfoChangeMsg').fadeOut(1000);
            }, 3000);
        },
    });
}
function imageEdit() {
    $('.edit_image').hide();
    $('.image').removeClass('d-none');
    $('#imageInfo').removeClass('d-none');
}
function uploadProfileImage(e) {
    var profileImage = $('#change-profile-image')[0];
    var data = new FormData(profileImage);

    if ((document.getElementById('photo').files.length == 0)) {
        $('#imageChangeMsg').text('Please Choose An Image First');
        $('#imageChangeMsg').removeAttr('class').addClass('text-danger').addClass('msg2').addClass('ml-4').show();
        setTimeout(function () {
            $('#imageChangeMsg').fadeOut(1000);
        }, 3000);
        return false;
    }
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/my-section/profile-photo-update',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            if (response.result == true) {
                $('#imageChangeMsg').text(response.message);
                $('#imageChangeMsg').removeAttr('class').addClass('text-success').addClass('msg2').addClass('ml-4').show();
                setTimeout(function () {
                    $('#imageChangeMsg').fadeOut(1000);
                }, 3000);
            } else {
                $('#imageChangeMsg').text(response.message);
                $('#imageChangeMsg').removeAttr('class').addClass('text-danger').addClass('msg2').addClass('ml-4').show();
                setTimeout(function () {
                    $('#imageChangeMsg').fadeOut(1000);
                }, 3000);
            }
        },
        error: function (error) {
            $('#imageChangeMsg').text("Oops! something went wrong");
            $('#imageChangeMsg').removeAttr('class').addClass('text-danger').addClass('msg2').addClass('ml-4').show();
            setTimeout(function () {
                $('#imageChangeMsg').fadeOut(1000);
            }, 3000);
        }
    });
}
function previewImage() {
    var imgpath = document.getElementById('photo');
    if (!imgpath.value == "") {
        var img = imgpath.files[0].size;
        var imgsize = img / 1024;
        if (imgsize > 3072) {
            $('#imageChangeMsg').text('Can Not Save Image. Maximum 3 MB!');
            $('#imageChangeMsg').removeAttr('class').addClass('text-danger').addClass('msg2').addClass('ml-4').show();
            setTimeout(function () {
                $('#imageChangeMsg').fadeOut(1000);
            }, 3000);
            imgpath.value = '';
            return false;
        }
    } else {
        $('#imageChangeMsg').text('Please Choose An Image First');
        $('#imageChangeMsg').removeAttr('class').addClass('text-danger').addClass('msg2').addClass('ml-4').show();
        setTimeout(function () {
            $('#imageChangeMsg').fadeOut(1000);
        }, 3000);
        imgpath.value = '';
        return false;
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("photo").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadImage").hidden = false;
        document.getElementById("uploadImage").src = oFREvent.target.result;
    };
}

function passwordEdit() {
    $('.pass_change').hide();
    $('.password').removeAttr('disabled');
    $('.reset').removeClass('d-none');
    $('#passwordInfo').removeClass('d-none');
    $('#oldPwd').val('');
}
function changePass() {
    var oldPwd = $('#oldPwd').val();
    var newPwd = $('#newPwd').val();
    if (newPwd.length < 8) {
        if (newPwd.length == 0) {
            $('#editPassword').text("Please Enter New Password!");
            $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
            setTimeout(function () {
                $('#editPassword').fadeOut(1000);
            }, 3000);
            return false;
        }
        $('#editPassword').text("New Password length can't be less than 8 characters!");
        $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
        setTimeout(function () {
            $('#editPassword').fadeOut(1000);
        }, 3000);
        return false;
    } else
        $('#editPassword').hide();
    var renewPwd = $('#renewPwd').val();
    if (newPwd != renewPwd) {
        if (renewPwd.length == 0) {
            $('#editPassword').text("Please Re-Type New Password!");
            $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
            setTimeout(function () {
                $('#editPassword').fadeOut(1000);
            }, 3000);
            return false;
        }
        $('#editPassword').text("New Password and Re-Type Password Doesn't Matched!");
        $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
        setTimeout(function () {
            $('#editPassword').fadeOut(1000);
        }, 3000);
        return false;
    } else
        $('#editPassword').next('p').hide();
    $.ajax({
        type: "POST",
        url: '/my-section/changePassword',
        data: {
            'old_pass': oldPwd,
            'new_pass': newPwd,
            'renew_pass': renewPwd
        },
        success: function (response) {
            if (response.result == true) {
                $('#editPassword').text(response.message);
                $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').show();
                setTimeout(function () {
                    $('#editPassword').fadeOut(1000);
                }, 3000);
            } else {
                $('#editPassword').text(response.message);
                $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
                setTimeout(function () {
                    $('#editPassword').fadeOut(1000);
                }, 3000);
            }
        },
        error: function (error) {
            $('#editPassword').text(error.responseJSON.message);
            $('#editPassword').removeAttr('class').addClass('text-success').addClass('ml-4').addClass('text-danger').show();
            setTimeout(function () {
                $('#editPassword').fadeOut(1000);
            }, 3000);
        },
        complete: function () {
            $('#oldPwd').val('');
            $('#newPwd').val('');
            $('#renewPwd').val('');
        }
    });
}

$('.bx_user_order_list button[name="cancelOrder"]').click(function () {
    const phone = $(this).data("phone");
    const orderId = $(this).data("order-id");
    const productCount = $(this).data("item");
    const payable = $(this).data("payable");
    $('#bx_book_order_id').text(orderId);
    $('#bx_book_order_item').text(productCount + ' items');
    $('#bx_book_order_payable').text('TK. ' + payable);
    $('.bx_book_order_submit_btn').attr('data-phone', phone);

    $('#js--cancel-popup').fadeIn();
});
$('.bx_book_cancel_success_msg, .bx_book_cancel_fail_msg').hide();
$('.bx_book_order_submit_btn').click(function () {
    let orderId = $('#bx_book_order_id').text();
    let phone = $('.bx_book_order_submit_btn').data('phone');
    let reason = $('#bx_book_order_reason option:selected').val();
    $('#bx_book_order_reason').change(function () {
        $(this).css('borderColor', '#E2E2E2');
        $('.bx_book_order_submit_btn').removeAttr('disabled').css('cursor', 'pointer');
    });
    if (reason === '') {
        $('#bx_book_order_reason').css('borderColor', '#D64541');
        $('.bx_book_order_submit_btn').attr('disabled', 'true').css('cursor', 'not-allowed');
        return false;
    } else {
        $('#bx_book_order_reason').css('borderColor', '#E2E2E2');
        $('.bx_book_order_submit_btn').removeAttr('disabled').css('cursor', 'pointer');
        $.ajax({
            type: "POST",
            url: "/order/cancel",
            data: {
                order_id: orderId,
                phone: phone,
                reason: reason,
            },
            success: function (response) {
                if (response.result == true) {
                    $('.bx_book_content').slideUp();
                    toastr.success(response.success, '');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.error, '');
                    $('.bx_book_content').slideUp();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            },
            error: function (error) {

                location.reload();

            },
        });
    }
});
