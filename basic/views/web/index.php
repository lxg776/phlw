

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
                <div class="aui-badge"><?php echo  $unReadCount ?></div>
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


<div id="tempUser"  style="display: none">
    <li class="aui-list-item">
        <a href="javascript:;" onclick="viewUser(#v_user_id#)">
        <div class="aui-media-list-item-inner">
            <div class="aui-list-item-media" style="width: 7rem; height: 7rem;">
                <img src="#image" >
            </div>
            <div class="aui-list-item-inner">
                <div class="aui-list-item-text">
                    <div class="aui-list-item-title">#nikename</div>

                    <div class="aui-list-item-right aui-greed">实名</div>
                </div>
                <div class="aui-list-item-text">
                    <div class="aui-list-item-text">#age岁</div>
                    <div class="aui-list-item-text">#profession</div>
                    <div class="aui-list-item-text">#heightcm</div>
                </div>

                <div class="aui-list-item-text" style="color: #0a0c0e">
                    择偶条件:我想找寻靖西#zo
                </div>
            </div>
        </div>
        </a>
        <div class="aui-info" style="padding-top:0">
            <div class="aui-info-item">
                <a href="#">打招呼</a>
            </div>
            <div class="aui-info-item">
                <a href="javascript:;"  onclick="getMsgList(#to_user_id#)"  >发信息</a>
            </div>

            <div class="aui-info-item" style="padding-right: 10px;">
                <a href="#">帮我联系她</a>
            </div>

        </div>
    </li>

</div>


<div id="tempActivity"  style="display: none">

    <div class="aui-card-list">
        <div class="aui-card-list-header">
            #title<small>活动时间:#activityTime</small>
        </div>
        <div class="aui-card-list-content">
            <img src="#img" />
        </div>
        <div class="aui-card-list-footer">
            <div>报名费用:#signCost元/人</div>
            <div>单身交友</div>
        </div>
    </div>

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

$this->registerJsFile("@web/cdn/aui/script/aui-scroll.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);

?>

<script language="JavaScript">




    apiready = function(){
        api.parseTapmode();
    }




    function changePageByUrl(url){
        if(url.endsWith("page1")){
            changePage(1);
            changeActivity(1);
        }else if(url.endsWith("page2")){
            changePage(2);
            changeActivity(2);
        }else if(url.endsWith("page3")){
            changePage(3);
            changeActivity(3);
        }else if(url.endsWith("page4")){
            changePage(4);
            changeActivity(4);
        }
    }

    function changeActivity(index) {

        $("#footer").children(".aui-bar-tab-item").removeClass("aui-active");
        $("#footer").children(".aui-bar-tab-item").eq(index-1).addClass("aui-active");
    }


    $(document).ready(function () {
            changePageByUrl(window.location.href);
        }
    );



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
        indexUrl = "<?php echo $baseUrl ?>/index.php?r=web/index";

        if(index==1){
            $("#page1").removeClass("aui-hide");
            $("#page2").addClass("aui-hide");
            $("#page3").addClass("aui-hide");
            $("#page4").addClass("aui-hide");

            $('body,html').animate({scrollTop:0},100);

            pageUrl = indexUrl+"#page1";

            if(pageUrl != window.location.href ){
                window.location.href= pageUrl;
            }




        }else if(index==2){
            $("#page1").addClass("aui-hide");
            $("#page2").removeClass("aui-hide");
            $("#page3").addClass("aui-hide");
            $("#page4").addClass("aui-hide");

            $('body,html').animate({scrollTop:0},100);

            pageUrl = indexUrl+"#page2";
            if(pageUrl != window.location.href ){
                window.location.href= pageUrl;
            }
        }else if(index==3){
            $("#page1").addClass("aui-hide");
            $("#page2").addClass("aui-hide");
            $("#page3").removeClass("aui-hide");
            $("#page4").addClass("aui-hide");
            $('body,html').animate({scrollTop:0},100);

            pageUrl = indexUrl+"#page3";
            if(pageUrl != window.location.href ){
                window.location.href= pageUrl;
            }
        }else if(index==4){
            $("#page1").addClass("aui-hide");
            $("#page2").addClass("aui-hide");
            $("#page3").addClass("aui-hide");
            $("#page4").removeClass("aui-hide");
            $('body,html').animate({scrollTop:0},100);

            pageUrl = indexUrl+"#page4";
            if(pageUrl != window.location.href ){
                window.location.href= pageUrl;
            }
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


    //活动详情
    function detailActivtiy(activityId) {
        url = "<?php echo $baseUrl."/index.php?r=web/activity-detail&activityId="?>"+activityId;
        window.location.href= url;
        // console.log("wtf");
    }


    $("#logoutBtn").click(function () {

        url = "<?php echo $baseUrl."/index.php?r=web/logout"?>";
        window.location.href = url;

    });


    $("#reg_btn").click(function(){
        url = "<?php echo $baseUrl."/index.php?r=web/reg"?>";
        window.location.href = url;
    });

    //获取消息列表
    function getMsgList(fromUserId) {
        url = "<?php echo $baseUrl."/index.php?r=web/msg-list&" ?> fromUserId="+fromUserId;
        window.location.href= url;
        // console.log("wtf");
    }


    function getActivityHtml(item) {
        tempHtml = $("#tempActivity").html().toString();
        tempHtml = tempHtml.replace("#title", item.title);
        tempHtml = tempHtml.replace("#activityTime", item.activity_time);
        tempHtml = tempHtml.replace("#img", imageBase + item.cover_image);
        tempHtml = tempHtml.replace("#signCost", item.sign_cost);
        console.log(tempHtml);
        return tempHtml;
    }

    function loadMoreActivity() {
        var activityloadFla = false;

        userCount = $("#activityList").children(".aui-card-list").length;
        //document.getElementById("demo").textContent = "滚动高度："+userCount;
        pageNum = parseInt((userCount - 1) / pageSize) + 2;

        if (!activityloadFla && (pageNum > activity_currentPage)) {
            $.ajax({
                type: "GET",
                url: "<?php echo $baseUrl . "/index.php?r=web/load-activity-list" ?>",
                data: "pageNum=" + pageNum,
                async: false,
                success: function (data) {
                    activityloadFla = true;
                    activity_currentPage = data.data.pageNum;
                    if (data.code == 1) {
                        htmlString = ""
                        $.each(data.data.dataList, function (i, value) {
                            htmlString = htmlString + getActivityHtml(value);
                        });
                        $("#activityList").append(htmlString);
                    } else {
                        msg(data.message);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    activityloadFla = true;
                }
            });
        }
    }


    var scroll = new auiScroll({
        listen:true,
        distance:200 //判断到达底部的距离，isToBottom为true
    },function(ret){
        if(ret.isToBottom){
            //  document.getElementById("demo").textContent = "已到达底部";
            url = window.location.href;

            if(url.endsWith("page1")||url.endsWith("index")){
                loadMoreUser();
            }else if(url.endsWith("page2")){
                loadMoreActivity();
            }

        }else{


        }
    });


    var pageSize =15;
    var currentPage =1;
    var activity_currentPage =1;


    var imageBase = "<?php echo $imageBase ?>";


    function loadMoreUser() {
        var userloadFla = false;
        userCount = $("#listUser").children(".aui-list-item").length;
        //document.getElementById("demo").textContent = "滚动高度："+userCount;
        pageNum = parseInt((userCount - 1) / pageSize) + 2;

        if (!userloadFla && (pageNum > currentPage)) {
            $.ajax({
                type: "GET",
                url: "<?php echo $baseUrl . "/index.php?r=web/load-recomment-user-list" ?>",
                data: "pageNum=" + pageNum,
                async: false,
                success: function (data) {
                    userloadFla = true;
                    currentPage = data.data.pageNum;
                    if (data.code == 1) {
                        htmlString = ""
                        $.each(data.data.dataList, function (i, value) {
                            htmlString = htmlString + getUserHtml(value);
                        });
                        $("#listUser").append(htmlString);
                    } else {
                        msg(data.message);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    userloadFla = true;
                }
            });
        }


        function getUserHtml(item) {
            tempHtml = $("#tempUser").html().toString();
            if (item.nikename == null) {
                item.nikename = ' ';
            }
            tempHtml = tempHtml.replace("#nikename", item.nikename);

            if (item.profession == null) {
                item.profession = ' ';
            }

            tempHtml = tempHtml.replace("#profession", item.profession);

            if (item.height == null) {
                item.height = ' ';
            }

            tempHtml = tempHtml.replace("#height", item.height);
            tempHtml = tempHtml.replace("#zo", getUserRequest(item));
            tempHtml = tempHtml.replace("#toUser", item.user_id);
            tempHtml = tempHtml.replace("#to_user_id#", item.user_id);
            tempHtml = tempHtml.replace("#v_user_id#", item.user_id);

            if (item.age == null) {
                item.age = ' ';
            }
            tempHtml = tempHtml.replace("#age", item.age);

            if (item.avatar != null) {
                tempHtml = tempHtml.replace("#image", imageBase + item.avatar);
            } else {
                if (item.sex == '1') {
                    tempHtml = tempHtml.replace("#image", '<?php echo $baseUrl ?>/cdn/image/default_man_icon.png');
                } else {
                    tempHtml = tempHtml.replace("#image", '<?php echo $baseUrl ?>/cdn/image/default_woman_icon.png');
                }
            }
            console.log(tempHtml);
            return tempHtml;
        }

        function getUserRequest(item) {
            tempHtml = "";
            if (item.zo_age) {
                tempHtml = tempHtml + "年龄在" + item.zo_age + "岁,";
            }
            if (item.zo_height) {
                tempHtml = tempHtml + "身高" + item.zo_height + "cm,";
            }
            if (item.zo_income_monthly) {
                tempHtml = tempHtml + "月收入" + item.zo_income_monthly + ",";
            }

            if (item.sex == '2') {
                tempHtml = tempHtml + "的男性";
            }
            if (item.sex == '1') {
                tempHtml = tempHtml + "的女性";
            }
            return tempHtml;
        }


        // View a list of images
        var viewer = new Viewer(document.getElementById('images'));
    }


</script>
