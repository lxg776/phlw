
<?php

/* @var $this yii\web\View */
use app\assets\AppAsset;

AppAsset::register($this);  // $this 代表视图对象

$this->head();

$baseUrl = \Yii::$app->request->baseUrl;

?>


<header class="aui-bar aui-bar-nav" style="position: fixed">
    <a class="aui-pull-left aui-btn" id="backBtn">
        <span class="aui-iconfont aui-icon-left"></span>返回
    </a>
    <div class="aui-title"><?php echo $toUser['nikename'] ?> </div>

</header>


<div class="aui-content aui-margin-b-15" style="margin-top: 2.5rem;padding-bottom: 52.5px;">


    <section class="aui-chat" id="chatList">
        <?php  foreach($msgList as $item){
            if($item['show_date']){?>
            <div class="aui-chat-header"><?php echo $item['show_date'] ?> </div>
            <?php } ?>


            <div class="aui-chat-item  <?php if($item['show_fla'] == '0'){?>  aui-chat-left   <?php } ?>  <?php if($item['show_fla'] == '1'){?>  aui-chat-right   <?php } ?> ">
            <div class="aui-chat-media">


                <?php if($item['f_avatar']){

                    ?>
                    <img src="<?php echo $imageBase.$item['f_avatar'] ?>" >

                <?php } else{

                    if($item['f_sex']==1){
                        ?>
                        <img src="<?php echo $baseUrl ?>/cdn/image/default_man_icon.png" >


                        <?php
                    } else if($item['f_sex']==2){
                        ?>
                        <img src="<?php echo $baseUrl ?>/cdn/image/default_woman_icon.png" >
                        <?php
                    }
                }?>





            </div>
            <div class="aui-chat-inner">
                <div class="aui-chat-name"> <?php echo $item['f_nikename'] ?> </div>
                <div class="aui-chat-content">
                    <div class="aui-chat-arrow"></div>
                    <?php echo $item['msg_content'] ?>
                </div>

            </div>
</div>
        <?php } ?>
</section>
</div>


<div id="item"  style="display: none">
    <div class="aui-chat-header"><?php echo $currentDate ?></div>
    <div class="aui-chat-item aui-chat-right">
        <div class="aui-chat-media">
            <img src="<?php echo $imageBase.$fromUser['avatar'] ?>" />
        </div>
        <div class="aui-chat-inner">
            <div class="aui-chat-name"><?php echo $fromUser['nikename'] ?> </div>
            <div class="aui-chat-content">
                <div class="aui-chat-arrow"></div>
                #msgContent
            </div>
        </div>
    </div>
</div>

<footer class="aui-bar aui-bar-tab" id="footer">
    <p><div class="aui-btn aui-btn-info aui-btn-block" aui-popup-for="top-left" >发送消息</div></p>
</footer>



<div class="aui-popup aui-popup-top-left" style="width: 95%;display: none;" id="top-left">
    <div class="aui-popup-content">
        <div class="aui-content aui-margin-b-15" style="margin-top: 2.5rem;">


            <ul class="aui-list aui-media-list" id="listUser">


                <form id="sendForm" action="<?php echo $baseUrl."/index.php?r=web/send-msg" ?>" method="post">
                    <input name="toUserId" type="hidden" value="<?php echo $toUser['user_id'] ?> "/>

                    <li class="aui-list-item">
                        <div class="aui-list-item-input" style="padding: 1rem;">
                            <textarea placeholder="消息内容"  name="msgContent" id="msgContent" style="height: 200px;"></textarea>
                        </div>
                    </li>
                    <li class="aui-list-item" style="padding-bottom: 10px;">
                        <div class="aui-content-padded">
                            <div class="aui-btn aui-btn-info aui-btn-block" id="sendBtn" >发送</div>
                        </div>
                    </li>
                </form>
            </ul>

        </div>
    </div>
</div>


<?php
$this->registerJsFile("@web/cdn/aui/script/aui-popup.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/cdn/aui/script/aui-dialog.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);
?>

<script language="JavaScript">
    var popup = new auiPopup();

    $("#backBtn").click(function(){
        window.history.back();
    });

    $("#sendBtn").click(function(){
        tijiao();
    });


    var dialog = new auiDialog();
    function msg(msg) {
        dialog.alert({
            title:"提示",
            msg:msg,
            buttons:['确定']
        },function(ret){
            // window.history.back();


        })
    }

    //提交
    function tijiao() {

        if ($("#msgContent").val() == "") {
            msg("请填写件信息");
            $("#msgContent").focus();
            return
        }

        toUserId = $("input[name='toUserId']").val();
        //backUrl = $("input[name='backUrl']").val();
        msgContent = $("#msgContent").val();

        csrfToken = $('meta[name="csrf-token"]').attr("content");

        data = "toUserId="+toUserId+"&msgContent="+msgContent+"&_csrf="+csrfToken;
        //获取签名数据并上传图片
        url = "<?php echo $baseUrl."/index.php?r=web/send-msg" ?>";

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json", //指定服务器返回的数据类型
            data:data,
            success: function (data) {
                addMsgView(msgContent);

                //msg(data.message);
            }
        });
        popup.hide();
        $("#msgContent").val("");

        //$("#sendForm").submit();
    }

    //显示信息视图
    function addMsgView(msgContent) {
        tempHtml = $("#item").html().toString();
        tempHtml = tempHtml.replace("#msgContent",msgContent);
        $("#chatList").append(tempHtml);

        $("#chatList").scrollTop($("#chatList")[0].scrollHeight);
    }



</script>




