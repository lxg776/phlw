
$(function() {
	// 点击登录按钮
	$('#login-bt').click(function() {
		login();
	});
	// 回车事件
	$('#username, #password').keypress(function (event) {
		if (13 == event.keyCode) {
			login();
		}
	});
});

// 登录
function login() {
	url = "http://127.0.0.1/hlw/basic/web/index.php?r=web/do-login";

    var csrfToken = $('meta[name="csrf-token"]').attr("content");


	$.ajax({
		url: url,
		type: 'POST',
		data: {
			username: $('#username').val(),
			password: $('#password').val(),
            _csrf:csrfToken,

		},
		beforeSend: function() {

		},
		success: function(json){
			if (json.code == 1) {
				location.href = json.data;
			} else {

                msg(json.message);
			}
		},
		error: function(error){
			console.log(error);
		}
	});
}

