<?php

/* @var $this yii\web\View */
use app\assets\AppAsset;

AppAsset::register($this);  // $this 代表视图对象

$this->head();

$baseUrl = \Yii::$app->request->baseUrl;

?>

<header class="aui-bar aui-bar-nav">
    <a class="aui-pull-left aui-btn" id="backBtn">
        <span class="aui-iconfont aui-icon-left"></span>返回
    </a>
    <div class="aui-title">婚恋墙</div>



</header>



<div class="aui-content aui-margin-b-15" style="margin-top: 1rem;">
    <ul class="aui-list aui-form-list">

        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label-icon">
                    <i class="aui-iconfont aui-icon-mobile"></i>
                </div>
                <div class="aui-list-item-input">
                    <input type="text" id="username" name="username" placeholder="手机号码">
                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label-icon">
                    <i class="aui-iconfont aui-icon-lock"></i>
                </div>
                <div class="aui-list-item-input">
                    <input type="password" id="password"  name="password"  placeholder="密码">
                </div>

            </div>
        </li>
    </ul>

</div>


<div class="aui-content-padded">
    <p><div class="aui-btn aui-btn-info aui-btn-block" id="login-bt">登 录</div></p>
    <p><div class="aui-btn aui-btn-primary aui-btn-block"  id="reg_btn" style="margin-top: 1rem;">注 册</div></div>
</div>





<div class="aui-card-list-header aui-padded-t-5 aui-padded-b-5" >
    实名上墙 |  非诚勿扰  |  找到你的另一半
</div>


<script type="text/javascript" src="<?php echo $baseUrl?>/cdn/aui/script/aui-dialog.js"></script>


<script language="JavaScript">




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

    // 登录

    var dialog = new auiDialog();
    function msg(msg) {
        dialog.alert({
            title:"提示",
            msg:msg,
            buttons:['确定']
        },function(ret){
            // console.log(ret)
        })
    }

        // 登录
        function login() {
            url = "<?php echo $baseUrl?>/index.php?r=web/do-login";

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



        $("#reg_btn").click(function(){
            url = "<?php echo $baseUrl."/index.php?r=web/reg"?>";
            window.location.href = url;
        });




    // $("#login-bt").click(function(){
    //         $("#form").submit(function(e){
    //             alert("Submitted");
    //         });
    // });

    $("#backBtn").click(function(){
        window.history.back();
    });





</script>















