
<?php


/* @var $this yii\web\View */
use app\assets\AppAsset;

AppAsset::register($this);  // $this 代表视图对象

$this->head();

$this->registerJsFile("@web/cdn/webuploader/dist/webuploader.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/webuploader/dist/upload.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_END]);

$this->registerJsFile("@web/cdn/aui/script/aui-dialog.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/js/reg_date.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/js/city_list.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);


$this->registerCssFile("@web/cdn/css/reg-upload.css",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);


//<script src="${ctx}/aui/script/aui-dialog.js"></script>
//<script src="${ctx}/js/reg_date.js"></script>
//<script src="${ctx}/js/city_list.js"></script>


$baseUrl = \Yii::$app->request->baseUrl;

?>



<header class="aui-bar aui-bar-nav">
    <a class="aui-pull-left aui-btn" id="backBtn">
        <span class="aui-iconfont aui-icon-left"></span>返回
    </a>
    <div class="aui-title">婚恋网</div>

</header>


<div class="aui-content aui-margin-b-15" style="margin-top: 1rem;">

    <form method="post" action="<?php echo $baseUrl."/index.php?r=web/do-reg" ?>" id="regForm">

        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

    <ul class="aui-list aui-form-list">

        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label">
我是
                </div>
                <div class="aui-list-item-input">
                    <label><input class="aui-radio" type="radio" name="sex" value="1" >男生</label>
                    <label><input class="aui-radio" type="radio" name="sex" value="2" >女生</label>
                </div>
            </div>
        </li>

        <li class="aui-list-item">   <label class="aui-list-item-label" style="font-size: 18px;color: #212121;">出生日期 </label></li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">


                <div class="aui-list-item-input">
                    <select style="font-size: 14px; width: 80px;" id="selYear">

                    </select>
                </div>

                <div class="aui-list-item-label" style="color: #757575; font-size: 12px; width: 30px;">
    年
                </div>
            </div>

            <div class="aui-list-item-inner">


                <div class="aui-list-item-input">
                    <select  style="font-size: 14px;width: 80px;" id="selMonth">

                    </select>
                </div>

                <div class="aui-list-item-label" style="color: #757575; font-size: 12px;width: 30px;">
    月
                </div>
            </div>

            <div class="aui-list-item-inner">


                <div class="aui-list-item-input" >
                    <select style="font-size: 14px;width: 80px;" id="selDay">

                    </select>
                </div>

                <div class="aui-list-item-label" style="color: #757575; font-size: 12px;width: 30px;">
    日
                </div>
            </div>
        </li>


        <li class="aui-list-item">   <label class="aui-list-item-label" style="font-size: 18px;color: #212121;">地区 </label></li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label" style="color: #757575; font-size: 12px; width: 30px;">
    省
                </div>

                <div class="aui-list-item-input">
                    <select style="font-size: 14px; width: 100px;" id="province" name="fProvinceId">

                    </select>
                </div>
            </div>

            <div class="aui-list-item-inner">
                <div class="aui-list-item-label" style="color: #757575; font-size: 12px;width: 30px;">
    市
                </div>

                <div class="aui-list-item-input">
                    <select name="fromCityId" style="font-size: 14px;width: 80px;" id="citys">

                    </select>
                </div>
            </div>

            <div class="aui-list-item-inner">
                <div class="aui-list-item-label" style="color: #757575; font-size: 12px;width: 30px;">
    区/县
                </div>

                <div class="aui-list-item-input" >
                    <select name="fAreasId"  style="font-size: 14px;width: 100px;" id="areas">

                    </select>
                </div>
            </div>
        </li>

        <li class="aui-list-item">
            <div class="aui-list-item-inner">

                <div class="aui-list-item-input">
                    <input type="text" name="userName" placeholder="手机号码">
                </div>

                <div class="aui-list-item-label">
                    <a href="javascript:;"  onclick="gegSms()"  id="sMSCodeBtn" >获取验证码</a>
                    <label id="showTimeLabel" style="display: none">60s</label>
                </div>
            </div>
        </li>
        <input type="hidden"  name="birthDay" value="">
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-input">
                    <input type="text" name="msgCode" placeholder="验证码">
                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-input">
                    <input type="text" name="realName" placeholder="真实姓名">
                </div>
            </div>
        </li>

        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-input">
                    <input type="text" name="idCard" placeholder="身份证号码">
                </div>
            </div>
        </li>
<!--        <input id="imgs" type="hidden" name="idCardImgs"  />-->
        <input id="imgs" type="hidden" name="idCardImgs" />
        <div class="aui-card-list">
            <div class="aui-card-list-header" style="color: #757575; font-size: 14px;">
    为保证注册的真实性需上传身份证图
            </div>
            <div id="wrapper">
                <div id="container">
                    <!--头部，相册选择和格式选择-->

                    <div id="uploader">
                        <div class="queueList">
                            <div id="dndArea" class="placeholder">
                                <div id="filePicker"></div>

                            </div>
                        </div>
                        <div class="statusBar" style="display:none;">
                            <div class="progress">
                                <span class="text">0%</span>
                                <span class="percentage"></span>
                            </div><div class="info"></div>
                            <div class="btns">
                                <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-input">
                    <input type="password" name="password" placeholder="密码">
                </div>
            </div>
        </li>


        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-input">
                    <input type="password" name="rePassword" placeholder="确认密码">
                </div>
            </div>
        </li>


        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label" style="width: 80%;">
    我同意并遵守 <a href="${ctx}/h5/agreement">《婚恋墙服务协议》</a>
                </div>
                <div class="aui-list-item-input" style="width: 80px;">
                    <input type="checkbox" class="aui-switch" name="isAgreement" value="true">
                </div>
            </div>
        </li>
    </ul>
    </form>
</div>


<div class="aui-content-padded">

    <p><div class="aui-btn aui-btn-primary aui-btn-block" style="margin-top: 1rem;" id="regBtn">完成</div></div>


</div>



<input type="hidden" name="ossUrl"  value="<?php echo $baseUrl."/index.php?r=oss/policy" ?>">






<script language="JavaScript">


    var dialog = new auiDialog();


    $("#backBtn").click(function(){
        window.history.back();
    });
    $("#regBtn").click(function(){
        tijiao();
    });




    $(document).ready(function(){
        initCityData();


        $("#uploader .placeholder").css('background-image',"url('<?php echo $baseUrl ."/cdn/aui/image/image.png" ?>')");

        $("#uploader .filelist li").css('background-image',"url('<?php echo $baseUrl ."/cdn/aui/image/bg.png" ?>')")








    });

    var  dProvinceId="450000";
    var  dcityid = "451000";
    var  dAreaid = "451025";

    ctx = "<?php echo $baseUrl."/index.php?r=city" ?>";

    //获取区县
    $("#province").change(function () {//当选择城市的下拉选的时候，区域进行联动
        getCityList($("#province").val(),"");
    });

    //获取区县
    $("#citys").change(function () {//当选择城市的下拉选的时候，区域进行联动
        getAreasList($("#citys").val(),"");
    });









    function tijiao() {


        $sexValue = $('input:radio[name="sex"]:checked').val();



        if ($sexValue == ""||$sexValue == undefined) {
            msg("请填性别");
            $("input[name='sex']").focus();
            return
        }


        if ($("input[name='userName']").val() == "") {
            msg("请填写手机号码");
            $("input[name='userName']").focus();
            return
        }

        if(!$("input[name='userName']").val().match(/^(((1[3-9][0-9]{1})|159|153)+\d{8})$/)){
            msg("手机格式不正确");
            $("input[name='userName']").focus();
            return
        }

        if ($("input[name='realName']").val() == "") {
            msg("请填写真实姓名");
            $("input[name='realName']").focus();
            return
        }

        if ($("input[name='idCard']").val() == "") {
            msg("请填写身份证号码");
            $("input[name='idCard']").focus();
            return
        }









        if(!$("input[name='idCard']").val().match(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/)){
            msg("身份证格式不正确");
            $("input[name='idCard']").focus();
            return
        }

        if ($("input[name='idCardImgs']").val() == "") {
            msg("请上传身份图片");
            $("input[name='idCard']").focus();
            return
        }


        if ($("input[name='password']").val() == "") {
            msg("请输入密码");
            $("input[name='password']").focus();
            return
        }

        if ($("input[name='password']").val().length<6) {
            msg("密码长度必须大于六位！");
            $("input[name='password']").focus();
            return
        }


        if ($("input[name='rePassword']").val() == "") {
            msg("请输入确认密码");
            $("input[name='rePassword']").focus();
            return
        }



        if ($("input[name='password']").val() != $("input[name='rePassword']").val()) {
            msg("两次密码输入不一致!");
            $("input[name='rePassword']").focus();
            return
        }


        if ($("input[name='password']").val() != $("input[name='rePassword']").val()) {
            msg("两次密码输入不一致!");
            $("input[name='rePassword']").focus();
            return
        }

        isAgreement = $("input[name='isAgreement']:checked").val();

        if(isAgreement!='true'){
            msg("请同意服务协议");
            $("input[name='isAgreement']").focus();
            return
        }


        idCard = $("input[name='idCard']").val();
        userName = $("input[name='userName']").val();
        code = $("input[name='msgCode']").val();


        year = $("#selYear").val();
        month = $("#selMonth").val();
        day = $("#selDay").val();
        brithDay = year+"-"+month+"-"+day;

        year = $("#selYear").val();
        month = $("#selMonth").val();
        day = $("#selDay").val();
        brithDay = year+"-"+month+"-"+day;


        $("input[name='birthDay']").val(brithDay);
        csrfToken = $('meta[name="csrf-token"]').attr("content");



        $.ajax({
            type: "POST",
            url: "<?php echo $baseUrl."/index.php?r=web/check-username" ?>",
            data: {
                "userName":userName,
                _csrf:csrfToken,
                'idCard':idCard,
                'code':code,

            },
            async:false,
            success: function(data){
            if(data.code==1){
                $("#regForm").submit();
            }else{
                msg(data.message);
            }
        }
        });


    }

    //获取短信验证码
    function gegSms() {

        if ($("input[name='userName']").val() == "") {
            msg("请填写手机号码");
            $("input[name='userName']").focus();
            return
        }

        if(!$("input[name='userName']").val().match(/^(((1[3-9][0-9]{1})|159|153)+\d{8})$/)){
            msg("手机格式不正确");
            $("input[name='userName']").focus();
            return
        }

        csrfToken = $('meta[name="csrf-token"]').attr("content");
        phoneNo =$("input[name='userName']").val();

        $.ajax({
            type: "POST",
            url: "<?php echo $baseUrl."/index.php?r=web/get-sms" ?>",
            data: {
                "phoneNo":phoneNo,
                _csrf:csrfToken

            },
            success: function(data){
                msg(data.message);
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){

            }
        });


    }


    //显示倒计时
    function showTime(time) {
        if(time == 0){
            $("#sMSCodeBtn").show();
            $("#showTimeLabel").hide();
        }else{
            $("#showTimeLabel").html(time+"s");
            $("#sMSCodeBtn").hide();
            $("#showTimeLabel").show();
            window.setTimeout(function(){
                showTime(time -1);
            },1000);
        }
    }

    function msg(msg) {
        dialog.alert({
            title:"提示",
            msg:msg,
            buttons:['确定']
        },function(ret){
            // console.log(ret)
        })
    }


    var selYear = window.document.getElementById("selYear");
    var selMonth = window.document.getElementById("selMonth");
    var selDay = window.document.getElementById("selDay");
    // 新建一个DateSelector类的实例，将三个select对象传进去
    new DateSelector(selYear, selMonth, selDay, 1985, 1, 1);



</script>

