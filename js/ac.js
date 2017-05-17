(function ($) {

    var capsLockState = "unknown";

    var methods = {
        init: function (options) {

            // Create some defaults, extending them with any options that were provided
            var settings = $.extend({
                // No defaults, because there are no options
            }, options);

            // Some systems will always return uppercase characters if Caps Lock is on. 
            var capsLockForcedUppercase = /MacPPC|MacIntel/.test(window.navigator.platform) === true;

            var helpers = {
                isCapslockOn: function (event) {

                    var shiftOn = false;
                    if (event.shiftKey) { // determines whether or not the shift key was held
                        shiftOn = event.shiftKey; // stores shiftOn as true or false
                    } else if (event.modifiers) { // determines whether or not shift, alt or ctrl were held
                        shiftOn = !!(event.modifiers & 4);
                    }

                    var keyString = String.fromCharCode(event.which); // logs which key was pressed
                    if (keyString.toUpperCase() === keyString.toLowerCase()) {
                        // We can't determine the state for these keys
                    } else if (keyString.toUpperCase() === keyString) {
                        if (capsLockForcedUppercase === true && shiftOn) {
                            // We can't determine the state for these keys
                        } else {
                            capsLockState = !shiftOn;
                        }
                    } else if (keyString.toLowerCase() === keyString) {
                        capsLockState = shiftOn;
                    }

                    return capsLockState;

                },

                isCapslockKey: function (event) {

                    var keyCode = event.which; // logs which key was pressed
                    if (keyCode === 20) {
                        if (capsLockState !== "unknown") {
                            capsLockState = !capsLockState;
                        }
                    }

                    return capsLockState;

                },

                hasStateChange: function (previousState, currentState) {

                    if (previousState !== currentState) {
                        $('body').trigger("capsChanged");

                        if (currentState === true) {
                            $('body').trigger("capsOn");
                        } else if (currentState === false) {
                            $('body').trigger("capsOff");
                        } else if (currentState === "unknown") {
                            $('body').trigger("capsUnknown");
                        }
                    }
                }
            };

            // Check all keys
            $('body').bind("keypress.capslockstate", function (event) {
                var previousState = capsLockState;
                capsLockState = helpers.isCapslockOn(event);
                helpers.hasStateChange(previousState, capsLockState);
            });

            // Check if key was Caps Lock key
            $('body').bind("keydown.capslockstate", function (event) {
                var previousState = capsLockState;
                capsLockState = helpers.isCapslockKey(event);
                helpers.hasStateChange(previousState, capsLockState);
            });

            // If the window loses focus then we no longer know the state
            $(window).bind("focus.capslockstate", function () {
                var previousState = capsLockState;
                capsLockState = "unknown";
                helpers.hasStateChange(previousState, capsLockState);
            });

            // Trigger events on initial load of plugin
            helpers.hasStateChange(null, "unknown");

            // Maintain chainability
            return this.each(function () { });

        },
        state: function () {
            return capsLockState;
        },
        destroy: function () {
            return this.each(function () {
                $('body').unbind('.capslockstate');
                $(window).unbind('.capslockstate');
            })
        }
    }

    jQuery.fn.capslockstate = function (method) {

        // Method calling logic
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.capslockstate');
        }

    };
})(jQuery);

$(document).ready(function () {
    _si_load();
    $(window).capslockstate();
});
$(function () {
    $(document).on('submit._si_', 'form[name="_si_"]', function (e) { e.preventDefault(); _si_submit($(this)); });
    $(document).on('submit._su_', 'form[name="_su_"]', function (e) { e.preventDefault(); _su_submit($(this)); });
    _si_load();
});

function CheckUsername(item) {
    var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
    var stringstrinput = $(item).val();
    var stringTemp = "";
    for (var i = 0; i < stringstrinput.length; i++) {
        if (specialChars.indexOf(stringstrinput[i]) < 0 && stringstrinput[i] != " ") {
            stringTemp += stringstrinput[i];
        }
    }
    $(item).val(stringTemp);
    return;
}

function DisableCopyPaste(e) {
    var kCode = e.keyCode || e.charCode;
    if (kCode == 17 || kCode == 2) {
        return false;
    }
}

function isCapslock(e) {
    e = (e) ? e : window.event;
    var charCode = false;
    if (e.which) {
        charCode = e.which;
    } else if (e.keyCode) {
        charCode = e.keyCode;
    }
    var shifton = false;
    if (e.shiftKey) {
        shifton = e.shiftKey;
    } else if (e.modifiers) {
        shifton = !!(e.modifiers & 4);
    }
    if (charCode >= 97 && charCode <= 122 && shifton) {
        return true;
    }
    if (charCode >= 65 && charCode <= 90 && !shifton) {
        return true;
    }
    return false;
}

function _si_load() {
    $.ajax({
        url: '/ajax/account/load',
        beforeSend: function () {
            $('.usrLgBox').html('<a>Đang tải ...</a>');
        },
        success: function (d) {
            $('.usrLgBox').html(d);
        },
        error: function (e) {
        }
    });
}


function _si_out(o) {
    $.ajax({
        url: '/ajax/account/signout',
        beforeSend: function () {
            $('.usrLgBox').html('Đang tải ...');
        },
        success: function (d) {
            window.location.reload();

        },
        error: function (e) { }
    });
}

function UpdateInfo()
{
    $('.msg').html('');
    $.ajax({
        url: '/ajax/account/updateinfo',
        data: { FullName: $("#Fullname").val(), IDCard: $("#IDCard").val(), Email: $("#Email").val(), Mobile: $("#PhoneNumber").val(), Birthday: $("#Birthday").val(), Address: $("#Address").val() },
        beforeSend: function () {
            changePwd_Before();
        },
        success: function (d) {
            changePwd_Finish(d);
        },
        error: function (e) {
            changePwd_Error(e);
        }
    });
}

function AddUserCRM()
{
    $('.msg').html('');
    $.ajax({
        url: '/ajax/account/AddUserCRM',
        data: { Username: $("#UsernameCRM").val(), Password: $("#passCRM").val() },
        beforeSend: function () {
            AddUser_Before();
        },
        success: function (d) {
            AddUser_Finish(d);
        },
        error: function (e) {
            AddUser_Error(e);
        }
    });
}

function AddUser_Before() {
    $('.adderpuser input').attr('disabled', true);
    $('.adderpuser button#AddCRM').text('Đang gởi ...');
}

function AddUser_Finish(d) {
    $('.adderpuser input').attr('disabled', false);
    $('.adderpuser input').val('');
    $('.adderpuser button#AddCRM').text('Thêm');
    $('.adderpuser .msg').text(d.result);
}


function AddUser_Error(e) {
    $('.adderpuser input').attr('disabled', false);
    $('.adderpuser button#AddCRM').text('Thêm');
    $('.adderpuser .msg').text(e.result);
}

function AgencyBuy() {
    $.ajax({
        url: '/ajax/account/Agency',
        data: {},
        beforeSend: function () {
        },
        success: function (d) {
            if (d.IsOk) {
                window.location = "/";
            }
        },
        error: function (e) {

        }
    });
}

function UpdatePassword()
{
    $('.msg').html('');
    $.ajax({
        url: '/ajax/account/UpdatePwd',
        data: { CurrentPwd: $("#crrPass").val(), NewPwd: $("#newPass").val(), ConfirmPwd: $("#reNewPass").val() },
        beforeSend: function () {
            changePwd_Before();
        },
        success: function (d) {
            changePwd_Finish(d);
        },
        error: function (e) {
            changePwd_Error(e);
        }
    });
}

function _si_submit(o) {
    if (!$(o).attr('isrunning')) {
        $(o).attr('isrunning', true);
        var $atc = $(o).attr('action'), $mtd = $(o).attr('method'), $dtd = genFormD(o);
        if ($dtd.Username == '' || $dtd.Username.length < 3 || $dtd.Username.length > 30) {
            $('.pp .c1 .r .c.e').html('Tên đăng nhập phải chứa ít nhất <br> 3 ký tự & tối đa 30 ký tự.');
            $(o).removeAttr('isrunning');
            return;
        }

        if ($dtd.Password.length < 6) {
            $('.pp .c1 .r .c.e').html('Mật khẩu phải chứa ít nhất <br> 6 ký tự');
            $(o).removeAttr('isrunning');
            return;
        }

        var $is_store = $(o).find('input[type="checkbox"]').is(':checked');

        $.ajax({
            url: $atc,
            type: $mtd,
            data: $dtd,
            beforeSend: function () {
                $('.pp .c1 .r .c.e').html('');
                $(o).find('button').text('Đang gởi...');
                $(o).find('input').attr('disabled', true);
            },
            success: function (d) {
                if (d) {
                    $('.pp').remove();
                    $('html, body').css('overflow', 'hidden');
                    $('body').append($(d).show());
                }
                else {
                    $(o).removeAttr('isrunning');
                    closePopup('.pp');
                    _si_load();
                    if ($is_store) {
                        $.cookie('usr', $dtd.Username, { path: '/', expires: 30 });
                        $.cookie('pwd', $dtd.Password, { path: '/', expires: 30 });
                        window.location.reload();
                    }
                    else {
                        $.removeCookie('usr');
                        $.removeCookie('pwd');
                    }
                }
            },
            error: function (e) { }
        });
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function _su_submit(frm) {
    var $frm = $(frm),
        $at = $frm.attr('action'),
        $mt = $frm.attr('method'),
        $data = genFormD($frm);

    $.ajax({
        url: $at,
        type: $mt,
        data: $data,
        beforeSend: function () {
            $('#_sign_up_msg_').html('Đang gởi dữ liệu ...');
        },
        success: function (d) {
            $('.pp').remove();
            $('html, body').css('overflow', 'hidden');
            if (d == null || d == '') {
                alert('Đăng ký thành công!\nVui lòng vào địa chỉ email bạn đã đăng ký để hoàn tất quá trình đăng ký');
            }
            else {
                $('body').append($(d).show());
            }
        },
        error: function (e) {
            $('#_sign_up_msg_').html("Hệ thống đang bảo trì, xin quý khách vui lòng quay lại sau.");
        }
    });
}

function ResetPass(e, item)
{
    if (e.keyCode == 13)
        GetLostPwd();
}

function GetLostPwd() {
    var txtEmail = document.getElementById("txtEmailReset");
    var btn = document.getElementById("btnSubmit");
    var Email = txtEmail.value;
    $.ajax({
        url: "/ajax/Account/GetLostPwd",
        data: { strEmail: Email },
        beforeSend: function () {
            btn.disabled = true;
            txtEmail.disabled = true;
        },
        success: function (d) {
            btn.disabled = false;
            txtEmail.disabled = false;
            if (d == "") {
                alert("Bạn đã đổi mật khẩu thành công. Vui lòng kiểm tra email để biết được mật khẩu mới");
                closePopup('.pp.dk');
            }
            else
                alert(d);
            return;
        },
        error: function (d) {
            btn.disabled = false;
            txtEmail.disabled = false;
            alert(d);
        }
    });
}
