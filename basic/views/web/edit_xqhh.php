

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
    <div class="aui-title">兴趣爱好</div>

</header>


<div class="aui-content aui-margin-b-15" style="margin-top: 2.5rem;">

    <form id="regForm" action="<?php echo $baseUrl."/index.php?r=web/do-edit-xqhh" ?>" method="post">

        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

        <input name="from" type="hidden" id="from" value="<?php echo $from ?>">

        <ul class="aui-list aui-form-list">

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        喜欢的音乐
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="填写"  name="favoriteMusic" value="<?php echo $modle['favorite_music'] ?>" >
                    </div>


                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        喜欢的电影
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="填写"  name="favoriteFilm" value="<?php echo $modle['favorite_film'] ?>" >
                    </div>


                </div>
            </li>

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        喜欢的运动
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="填写"  name="favoriteSports" value="<?php echo $modle['favorite_sports'] ?>" >
                    </div>


                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        喜欢的宠物
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="填写"  name="favoritePet" value="<?php echo $modle['favorite_pet'] ?>" >
                    </div>


                </div>
            </li>



        </ul>
    </form>
</div>


<div class="aui-content-padded">

    <div class="aui-btn aui-btn-info  aui-btn-block" style="margin-top: 1rem;" id="regBtn">完成</div>


</div>








<?php




$this->registerJsFile("@web/cdn/aui/script/aui-dialog.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);



?>



<script language="JavaScript">


    var dialog = new auiDialog();


    $("#backBtn").click(function(){
        window.history.back();
    });
    $("#regBtn").click(function(){
        tijiao();
    });


    function tijiao() {

        $("#regForm").submit();
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
</script>


