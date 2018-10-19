

<?php

/* @var $this yii\web\View */
use app\assets\AppAsset;

AppAsset::register($this);  // $this 代表视图对象

$this->head();

?>

<header class="aui-bar aui-bar-nav" style="position: fixed;">

    <div class="aui-title" id="demo">婚恋墙</div>




</header>

<div style="padding-top: 2.25rem;padding-bottom: 2.25rem;background:#ffffff">


            <?php

                /* @var $this yii\web\View */
                $baseUrl = \Yii::$app->request->baseUrl;
                echo $this->renderFile('@app/views/part/page1.php',['recommendUser'=>$recommendUser,'userSetting'=>$userSetting,'imageBase'=>$imageBase,'baseUrl'=>$baseUrl]);
            ?>


    <!--    page2-->
    <div  id="page2" class="aui-content aui-margin-b-15 aui-hide">

        <section class="aui-content" id="activityList">
            <?php  foreach($fActivityList as $item){ ?>
                <a href="javascript:;" onclick="detailActivtiy(<?php echo $item['activity_id'] ?>)">
                    <div class="aui-card-list">
                        <div class="aui-card-list-header">
                            <?php echo $item['title'] ?> <small>活动时间:<?php echo $item['activity_time'] ?> </small>
                        </div>
                        <div class="aui-card-list-content">
                            <img src="<?php echo $imageBase ?><?php echo $item['cover_image'] ?>" />
                        </div>
                        <div class="aui-card-list-footer">
                            <div>报名费用:<?php echo $item['sign_cost'] ?>元/人</div>
                            <div>单身交友</div>
                        </div>
                    </div>
                </a>
                <?php } ?>
        </section>
    </div>

    <?php
    $baseUrl = \Yii::$app->request->baseUrl;
    echo $this->renderFile('@app/views/part/page3.php',['userSetting'=>$userSetting,'imageBase'=>$imageBase,'baseUrl'=>$baseUrl,'viewRecordList'=>$viewRecordList,'msgList'=>$msgList]);
    ?>



    <?php
    $baseUrl = \Yii::$app->request->baseUrl;
    echo $this->renderFile('@app/views/part/page4.php',['userSetting'=>$userSetting,'imageBase'=>$imageBase,'baseUrl'=>$baseUrl,'modle'=>$modle,'userImages'=>$userImages]);
    ?>


    <footer class="aui-bar aui-bar-tab" id="footer">
        <div class="aui-bar-tab-item aui-active" tapmode>
            <i class="aui-iconfont aui-icon-home"></i>
            <div class="aui-bar-tab-label">首页</div>
        </div>
        <div class="aui-bar-tab-item" tapmode>
            <i class="aui-iconfont aui-icon-star"></i>
            <div class="aui-bar-tab-label">活动</div>
        </div>
        <div class="aui-bar-tab-item" tapmode>
            <?php if($unReadCount>0){ ?>
                <div class="aui-badge">${unReadCount}</div>
            <?php } ?>
            <i class="aui-iconfont aui-icon-comment"></i>
            <div class="aui-bar-tab-label">消息</div>
        </div>
        <div class="aui-bar-tab-item" tapmode>
            <div class="aui-dot"></div>
            <i class="aui-iconfont aui-icon-my"></i>
            <div class="aui-bar-tab-label">我的</div>
        </div>
    </footer>
        </ul>

    </div>




<!--会员弹出框-->
<div class="aui-popup aui-popup-bottom-left" style="width: 95%;display: none;" id="top-buttom">

    <div class="aui-popup-content">
        <div class="aui-content aui-margin-b-15" style="margin-top: 0.5rem;">

            <ul class="aui-list aui-media-list">

                <li class="aui-list-item">
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-title">问候语</div>

                        <div class="aui-list-item-right" style="padding-right: 16px;"><i class="aui-iconfont aui-icon-close"  id="greetingCloseBtn"></i></div>
                    </div>
                    <div class="aui-list-item-inner">

                        <input type="hidden" id="gtoUserId" />

                        <?php foreach ( $greetingTempList as $item){ ?>
                            <div class="aui-list-item-input" style="margin-top: 10px;">
                                <label><input class="aui-radio" type="radio" name="greeting" value="<?php echo $item['id'] ?>" checked>&nbsp;&nbsp;&nbsp;<?php echo $item['content'] ?> </label>
                            </div>
                        <?php } ?>

                    </div>
                </li>
            </ul>

            <div class="aui-content-padded">
                <div class="aui-btn aui-btn-info aui-btn-block" id="greetingBtn" style="margin-top: 1rem;">发送</div>
            </div>
        </div>
    </div>

</div>



<?php

$this->registerJsFile("@web/cdn/aui/script/aui-tab.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/aui/script/aui-popup.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);

$this->registerJsFile("@web/cdn/aui/script/aui-dialog.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/viewerjs/dist/viewer.min.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerCssFile("@web/cdn/viewerjs/dist/viewer.min.css",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);

?>

<script language="JavaScript">
    apiready = function(){
        api.parseTapmode();
    }


    $("#greetingCloseBtn").click(function () {
        popup.hide();
    });

    var popup = new auiPopup();

    var tab = new auiTab({
        element:document.getElementById("footer")
    },function(ret){
        changePage(ret.index);
    });


    function  sendGreetToUser(toUid) {
        $("#gtoUserId").val(toUid);
        showPopDiv = document.getElementById("top-buttom");
        if(showPopDiv){
            if(showPopDiv.className.indexOf("aui-popup-in") > -1 || document.querySelector(".aui-popup-in")){
                popup.hide(showPopDiv);
            }else{
                popup.show(showPopDiv);
            }
        }else{
            return;
        }


    }



    //发送问候语
    function sendGreeting() {
        var greetingId = $("input[name='greeting']").val();
        var friendId = $("#gtoUserId").val();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        popup.hide();
        $.ajax({
            type: "POST",
            url: "<?php echo $baseUrl."/index.php?r=web/send-greeting" ?>",
            data: {
                "greetingId": greetingId,
                "friendId":friendId,
                _csrf:csrfToken

            },
            success: function(data){
                msg(data.message);
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                popup.hide();
            }
        });


    }

    $("#greetingBtn").click(function () {
        sendGreeting();
    });






    function helpContact(userId) {

        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            type: "POST",
            url: "<?php echo $baseUrl."/index.php?r=web/help-contact" ?>",
            data: {
                "tUserId":userId,
                _csrf:csrfToken
            },
            async:false,
            success: function(data){
                msg(data.message);
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){

            }
        });

    }






    function changePage(index) {
        indexUrl = "http://127.0.0.1/hlw/basic/web/index.php?r=web/index";

        if(index==1){
            $("#page1").removeClass("aui-hide");
            $("#page2").addClass("aui-hide");
            $("#page3").addClass("aui-hide");
            $("#page4").addClass("aui-hide");

            $('body,html').animate({scrollTop:0},100);

            window.location.href=indexUrl+"#page1"

        }else if(index==2){
            $("#page1").addClass("aui-hide");
            $("#page2").removeClass("aui-hide");
            $("#page3").addClass("aui-hide");
            $("#page4").addClass("aui-hide");

            $('body,html').animate({scrollTop:0},100);

            window.location.href=indexUrl+"#page2"
        }else if(index==3){
            $("#page1").addClass("aui-hide");
            $("#page2").addClass("aui-hide");
            $("#page3").removeClass("aui-hide");
            $("#page4").addClass("aui-hide");
            $('body,html').animate({scrollTop:0},100);

            window.location.href=indexUrl+"#page3"
        }else if(index==4){
            $("#page1").addClass("aui-hide");
            $("#page2").addClass("aui-hide");
            $("#page3").addClass("aui-hide");
            $("#page4").removeClass("aui-hide");
            $('body,html').animate({scrollTop:0},100);

            window.location.href=indexUrl+"#page4"
        }
    }


    var tab02 = new auiTab({
        element:document.getElementById("tab"),
    },function(ret){
        if(ret.index==1){
            $("#page3_p1").removeClass("aui-hide");
            $("#page3_p2").addClass("aui-hide");
        }else if(ret.index==2){
            $("#page3_p1").addClass("aui-hide");
            $("#page3_p2").removeClass("aui-hide");
        }


    });

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

    function  viewUser(uid) {

        url = "<?php echo $baseUrl."/index.php?r=web/user-detail&uid="?>" +uid;
        window.location.href = url;

    }


    $("#logoutBtn").click(function () {

        url = "<?php echo $baseUrl."/index.php?r=web/logout"?>";
        window.location.href = url;

    });


    $("#reg_btn").click(function(){
        url = "<?php echo $baseUrl."/index.php?r=web/reg"?>";
        window.location.href = url;
    });

    // View a list of images
    var viewer = new Viewer(document.getElementById('images'));


</script>
