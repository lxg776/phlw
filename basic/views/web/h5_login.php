<?php

/* @var $this yii\web\View */

use yii\helpers\Html;





?>





    <!-- start: CSS -->
    <style type="text/css">
        #demo {
            background-color: #e0e0e0;
        }
    </style>






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


<script language="JavaScript">


    // $("#reg_btn").click(function(){
    //     window.location.href='${ctx}/h5/reg';
    // });


    $("#backBtn").click(function(){
        window.history.back();
    });




</script>



