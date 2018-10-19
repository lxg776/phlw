<?php

use app\assets\AppAsset;

AppAsset::register($this);  // $this 代表视图对象

$this->head();

$baseUrl = \Yii::$app->request->baseUrl;


$this->registerJsFile("@web/cdn/viewerjs/dist/viewer.min.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerCssFile("@web/cdn/viewerjs/dist/viewer.min.css",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);


?>
<header class="aui-bar aui-bar-nav" style="position: fixed;">

    <div class="aui-title" id="demo">用户详情</div>
    <a class="aui-pull-left aui-btn" id="backBtn">
        <span class="aui-iconfont aui-icon-left"></span>返回
    </a>

</header>




<div style="padding-top: 2.25rem;padding-bottom: 2.25rem;background: #ffffff">



    <div  id="page4" class="aui-content aui-margin-b-15">

        <ul class="aui-list aui-media-list" >
            <li class="aui-list-item">
                <div class="aui-media-list-item-inner">

                    <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;" >


                            <?php if($modle['avatar']){ ?>

                            <img src="<?php echo $imageBase.$modle['avatar'] ?>" >

                            <?php }else{
                                    if($modle['sex']==1){
                                ?>
                                        <img src="<?php echo $baseUrl ?>/cdn/image/default_man_icon.png" >

                                    <?php }else if($modle['sex']==2){ ?>
                                        <img src="<?php echo $baseUrl ?>/cdn/image/default_woman_icon.png" >
                            <?php }} ?>

                    </div>
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title"><?php echo $modle['nikename'] ?> </div>
                            <div class="aui-list-item-right"></div>
                        </div>

                        <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">
                            广西靖西市，30岁，<?php echo $modle['height'] ?>cm，<?php echo $modle['month_income']?>
                        </div>
                    </div>

                </div>
                <div class="aui-info" style="padding-top:0">
                    <div class="aui-info-item">
                        <a href="javascript:;"  onclick="sendGreetToUser(<?php echo $modle['user_id'] ?>)">打招呼</a>
                    </div>
                    <div class="aui-info-item">
                        <a href="javascript:;"
                        <?php if($userSetting['msg_send_status']==0){ ?>
                           aui-popup-for="top-left"
                        <?php } ?>

                            <?php if($userSetting['msg_send_status']==1){ ?>
                           onclick="getMsgList(<?php echo $modle['user_id'] ?>)"
                        <?php } ?>

                        >发信息</a>
                    </div>

                    <div class="aui-info-item" style="padding-right: 10px;">
                        <a href="javascript:;"  onclick="helpContact(<?php echo $modle['user_id'] ?>)" >帮我联系她</a>
                    </div>

                </div>

            </li>

            <div class="aui-card-list">
                <div class="aui-card-list-header">
                    相册

                </div>
                <div class="aui-card-list-content-padded aui-border-b aui-border-t">
                    <div class="aui-row aui-row-padded">
                        <ul id="images">

                            <?php  foreach ($userImages as $item){ ?>
                                <li class="aui-col-xs-4">
                                    <img src="<?php echo $imageBase.$item['image_path'] ?>"/>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- 个人资料-->
            <li class="aui-list-item">
                <div class="aui-media-list-item-inner">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title">个人资料</div>

                        </div>
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-left">昵称</div>
                            <div class="aui-list-item-title"><?php echo $modle['nikename'] ?></div>
                        </div>

                        <div class="aui-list-item-text">
                            <div class="aui-list-item-left">年龄</div>
                            <div class="aui-list-item-title"><?php echo $modle['age'] ?> </div>
                        </div>

                        <div class="aui-list-item-text">
                            <div class="aui-list-item-left"">学历</div>
                        <div class="aui-list-item-title"><?php echo $modle['education'] ?></div>

                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left"">身高</div>
                    <div class="aui-list-item-title"><?php echo $modle['height'] ?>cm</div>
                </div>

                <div class="aui-list-item-text">
                    <div class="aui-list-item-left"">月收入</div>
                <div class="aui-list-item-title"><?php echo $modle['month_income'] ?></div>
    </div>



    <div class="aui-list-item-text">
        <div class="aui-list-item-left"">体型</div>
    <div class="aui-list-item-title"> <?php echo $modle['shape'] ?> </div>
</div>

<div class="aui-list-item-text">
    <div class="aui-list-item-left"">婚姻状况</div>
<div class="aui-list-item-title"><?php echo $modle['marital_status'] ?> </div>
</div>

</div>
</div>
</li>
<li class="aui-list-item">
    <div class="aui-media-list-item-inner">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-text">
                <div class="aui-list-item-title">择偶条件</div>

            </div>
            <div class="aui-list-item-text">
                <div class="aui-list-item-left">年龄</div>
                <div class="aui-list-item-title"><?php echo $modle['r_age'] ?>
                    <?php if($modle['r_age']!='不限'){?>
                        岁
                    <?php  } ?>

                    </div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">身高</div>
                <div class="aui-list-item-title"><?php echo $modle['r_height'] ?>
                    <?php if($modle['r_height']!='不限'){?>
                        cm
                    <?php  } ?>

                    </div>
            </div>


            <div class="aui-list-item-text">
                <div class="aui-list-item-left">月收入</div>
                <div class="aui-list-item-title"><?php echo $modle['r_income_monthly'] ?></div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">学历</div>
                <div class="aui-list-item-title"><?php echo $modle['r_education'] ?></div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">婚姻</div>
                <div class="aui-list-item-title"><?php echo $modle['r_marital_status'] ?></div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">住房情况</div>
                <div class="aui-list-item-title"><?php echo $modle['r_house_status'] ?></div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">购车情况</div>
                <div class="aui-list-item-title"><?php echo $modle['r_car_status'] ?></div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">体型</div>
                <div class="aui-list-item-title"><?php echo $modle['r_shape'] ?></div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">有无小孩</div>
                <div class="aui-list-item-title"><?php echo $modle['r_child_status'] ?></div>
            </div>



        </div>


    </div>

</li>

<li class="aui-list-item">
    <div class="aui-media-list-item-inner">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-text">
                <div class="aui-list-item-title">生活状态</div>

            </div>
            <div class="aui-list-item-text">
                <div class="aui-list-item-left">抽烟状况</div>
                <div class="aui-list-item-title">
                    <?php if($modle['l_smoking_status']==0){ ?>
                        不抽
                    <?php } ?>

                    <?php if($modle['l_smoking_status']==1){ ?>
                        偶尔抽
                    <?php } ?>

                    <?php if($modle['l_smoking_status']==2){ ?>
                        经常抽
                    <?php } ?>

                </div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">饮酒状况</div>
                <div class="aui-list-item-title">

                    <?php if($modle['l_drinking_status']==0){ ?>
                        不喝
                    <?php } ?>

                    <?php if($modle['l_drinking_status']==1){ ?>
                        偶尔喝
                    <?php } ?>

                    <?php if($modle['l_drinking_status']==2){ ?>
                        经常喝
                    <?php } ?>
                </div>
            </div>


            <div class="aui-list-item-text">
                <div class="aui-list-item-left">厨艺</div>
                <div class="aui-list-item-title">

                    <?php if($modle['l_cooking']==0){ ?>
                        不下厨
                    <?php } ?>

                    <?php if($modle['l_cooking']==1){ ?>
                        厨艺有待提高
                    <?php } ?>

                    <?php if($modle['l_cooking']==2){ ?>
                        上得了厅堂
                    <?php } ?>

                    <?php if($modle['l_cooking']==3){ ?>
                        饭店大厨级别
                    <?php } ?>

                </div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">与父母同住</div>
                <div class="aui-list-item-title">
                    <?php echo $modle['l_live_with_parents'] ?>
                </div>
            </div>

        </div>


    </div>

</li>

<li class="aui-list-item">
    <div class="aui-media-list-item-inner">
        <div class="aui-list-item-inner">
            <div class="aui-list-item-text">
                <div class="aui-list-item-title">兴趣爱好</div>
                <div class="aui-list-item-title">
                    <?php echo $modle['l_favorite_music'] ?>
                </div>
            </div>
            <div class="aui-list-item-text">
                <div class="aui-list-item-left">喜欢的音乐</div>
                <div class="aui-list-item-title">
                    <?php echo $modle['l_favorite_music'] ?>
                </div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">喜欢的电影</div>
                <div class="aui-list-item-title">
                    <?php echo $modle['l_favorite_film'] ?>
                </div>
            </div>


            <div class="aui-list-item-text">
                <div class="aui-list-item-left">喜欢的运动</div>
                <div class="aui-list-item-title">
                    <?php echo $modle['l_favorite_sports'] ?>
                </div>
            </div>

            <div class="aui-list-item-text">
                <div class="aui-list-item-left">喜欢的宠物</div>
                <div class="aui-list-item-title">
                    <?php echo $modle['l_favorite_pet'] ?>
                </div>
            </div>
        </div>


    </div>

</li>

</ul>
</div>
</div>




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
                        <?php  foreach($greetingTempList as $item){ ?>

                            <div class="aui-list-item-input" style="margin-top: 10px;">
                                <label><input class="aui-radio" type="radio" name="greeting" value="<?php echo $item['id']?>" checked>&nbsp;&nbsp;&nbsp;<?php echo $item['content']?></label>
                            </div>

                        <?php  } ?>
                    </div>
                </li>
            </ul>

            <div class="aui-content-padded">
                <div class="aui-btn aui-btn-info aui-btn-block" id="greetingBtn" style="margin-top: 1rem;">发送</div>
            </div>
        </div>
    </div>

</div>

</body>


<?php
$this->registerJsFile("@web/cdn/aui/script/aui-dialog.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/aui/script/aui-popup.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/viewerjs/dist/viewer.min.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
?>




<script type="text/javascript">


    var popup = new auiPopup();

    $("#backBtn").click(function(){
        window.history.back();
    });




    $("#ktBtn").click(function () {
        createOrder();
    });

    $("#greetingBtn").click(function () {
        sendGreeting();
    });


    $("#greetingCloseBtn").click(function () {
        popup.hide();
    });
    $("#payCloseBtn").click(function () {
        popup.hide();
    });


    //发送问候语
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



    // function  sendMsg(toUid) {
    //
    //     backUrl = window.location.href;
    //     url = "${ctx}/m/sendMsg?uid="+toUid+"&backUrl="+backUrl;
    //     window.location.href = url;
    // }

    //获取消息列表
    // function getMsgList(fromUserId) {
    //     url = "${ctx}/m/msgList?fromUserId="+fromUserId;
    //     window.location.href= url;
    //     // console.log("wtf");
    // }

    // View a list of images
    var viewer = new Viewer(document.getElementById('images'));


</script>



