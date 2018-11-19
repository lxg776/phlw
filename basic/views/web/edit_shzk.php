
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
    <div class="aui-title">生活状况</div>

</header>


<div class="aui-content aui-margin-b-15" style="margin-top: 2.5rem;">
    <form id="regForm" action="<?php echo $baseUrl."/index.php?r=web/do-edit-shzk" ?>" method="post">

        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

        <input name="from" type="hidden" id="from" value="<?php echo $from ?>">

        <ul class="aui-list aui-form-list">

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        抽烟状况
                    </div>
                    <div class="aui-list-item-input">
                        <label><input class="aui-radio" type="radio" name="smokingStatus" value="0"  <?php  if($modle['smoking_status'] == '0'){ ?>  checked  <?php } ?> >不抽</label>
                        <label><input class="aui-radio" type="radio" name="smokingStatus" value="1"  <?php  if($modle['smoking_status'] == '1'){ ?>  checked  <?php } ?> >偶尔抽</label>
                        <label><input class="aui-radio" type="radio" name="smokingStatus" value="2"  <?php  if($modle['smoking_status'] == '2'){ ?>  checked  <?php } ?> >经常抽</label>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        饮酒状况
                    </div>
                    <div class="aui-list-item-input">
                        <label><input class="aui-radio" type="radio" value="0" name="drinkingStatus" <?php  if($modle['drinking_status'] == '0'){ ?>  checked  <?php } ?> >不喝</label>
                        <label><input class="aui-radio" type="radio" value="1" name="drinkingStatus" <?php  if($modle['drinking_status'] == '1'){ ?>  checked  <?php } ?> >偶尔喝</label>
                        <label><input class="aui-radio" type="radio" value="2" name="drinkingStatus" <?php  if($modle['drinking_status'] == '2'){ ?>  checked  <?php } ?>  >经常喝</label>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        厨艺
                    </div>
                    <div class="aui-list-item-input">
                        <select name="cooking">
                            <option value="0" <?php  if($modle['cooking'] == '0'){ ?>  selected="selected"  <?php } ?>  >不下厨</option>
                            <option value="1" <?php  if($modle['cooking'] == '1'){ ?>  selected="selected"  <?php } ?>  >厨艺有待提高</option>
                            <option value="2" <?php  if($modle['cooking'] == '2'){ ?>  selected="selected"  <?php } ?>  >上得了厅堂</option>
                            <option value="3" <?php  if($modle['cooking'] == '3'){ ?>  selected="selected"  <?php } ?>  >饭店大厨级别</option>
                        </select>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        与父母同住
                    </div>
                    <div class="aui-list-item-input">
                        <select name="liveWithParents">
                            <option value="不与父母同住" <?php  if($modle['live_with_parents'] == '不与父母同住'){ ?>  selected="selected"  <?php } ?> >不与父母同住</option>
                            <option value="与父母同住"  <?php  if($modle['live_with_parents'] == '与父母同住'){ ?>  selected="selected"  <?php } ?>   >与父母同住</option>
                            <option value="看情况"  <?php  if($modle['live_with_parents'] == '看情况'){ ?>  selected="selected"  <?php } ?>  >看情况</option>
                        </select>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        喜欢的约会
                    </div>
                    <div class="aui-list-item-input">
                        <select name="favoriteDate">
                            <option value="公园散步/爬山" <?php  if($modle['favorite_date'] == '公园散步'){ ?>  selected="selected"  <?php } ?>  >公园散步</option>
                            <option value="奶茶/咖啡厅"  <?php  if($modle['favorite_date'] == '奶茶/咖啡厅'){ ?>  selected="selected"  <?php } ?> >奶茶/咖啡厅</option>
                            <option value="电影院" <?php  if($modle['favorite_date'] == '电影院'){ ?>  selected="selected"  <?php } ?>  >电影院</option>
                            <option value="酒吧" <?php  if($modle['favorite_date'] == '酒吧'){ ?>  selected="selected"  <?php } ?>  >酒吧</option>
                        </select>
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




