

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
    <div class="aui-title">择偶条件</div>

</header>


<div class="aui-content aui-margin-b-15" style="margin-top: 2.5rem;">
    <form  id="regForm" action="<?php echo $baseUrl."/index.php?r=web/do-edit-zobz" ?>" method="post" >


        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

        <input name="from" type="hidden" id="from" value="<?php echo $from ?>">

        <ul class="aui-list aui-form-list">

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        性别
                    </div>
                    <div class="aui-list-item-input">
                        <label><input class="aui-radio" type="radio" name="sex" value="1" <?php  if($modle['sex'] =="1"){?> checked <?php } ?> >男</label>
                        <label><input class="aui-radio" type="radio" name="sex" value="2" <?php  if($modle['sex'] =="2"){?> checked <?php } ?> >女</label>
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
                        <select name="fromProvinceId"  style="font-size: 14px; width: 100px;" id="province">

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
                        <select name="fromAreaId"  style="font-size: 14px;width: 100px;" id="areas">

                        </select>
                    </div>
                </div>
            </li>





            <li class="aui-list-item">   <label class="aui-list-item-label" style="font-size: 18px;color: #212121;">年龄（岁） </label></li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label" style="color: #757575; font-size: 12px; width: 110px;">
                        年龄（以上）
                    </div>

                    <div class="aui-list-item-input">
                        <select name="age_min">

                            <option value="不限" >不限</option>

                            <?php  for($i=20;$i<40;$i++){ ?>

                                <option value="<?php echo $i ?>"  <?php  if($i == $age_min){?> selected <?php } ?>   ><?php echo $i ?></option>

                            <?php } ?>

                        </select>
                    </div>
                </div>

                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label" style="color: #757575; font-size: 12px;width: 110px;">
                        年龄（以下）
                    </div>

                    <div class="aui-list-item-input">
                        <select name="age_max">
                            <option value="不限">不限</option>

                            <?php  for($i2=20;$i2<40;$i2++){ ?>

                                <option value="<?php echo $i2 ?>"  <?php  if($i2 == $age_max){?> selected <?php } ?>   ><?php echo $i2 ?></option>

                            <?php } ?>

                        </select>
                    </div>
                </div>
            </li>



            <li class="aui-list-item">   <label class="aui-list-item-label" style="font-size: 18px;color: #212121;">身高（cm） </label></li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label" style="color: #757575; font-size: 12px; width: 110px;">
                        身高（以上）
                    </div>

                    <div class="aui-list-item-input">
                        <input type="number" placeholder="不限" name="height_min" value="<?php echo $height_min ?>">
                    </div>
                </div>

                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label" style="color: #757575; font-size: 12px;width: 110px;">
                        身高（以下）
                    </div>

                    <div class="aui-list-item-input">
                        <input type="number" placeholder="不限" name="height_max" value="<?php echo $height_max ?>">
                    </div>
                </div>
            </li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        婚姻
                    </div>

                    <div class="aui-list-item-input">
                        <label><input class="aui-radio" type="radio" name="maritalStatus"  value="不限"  <?php  if($modle['marital_status'] == '不限'){?> checked <?php } ?> >不限</label>
                        <label><input class="aui-radio" type="radio" name="maritalStatus"  value="未婚"  <?php  if($modle['marital_status'] == '未婚'){?> checked <?php } ?> >未婚</label>
                        <label><input class="aui-radio" type="radio" name="maritalStatus"  value="离异"  <?php  if($modle['marital_status'] == '离异'){?> checked <?php } ?> >离异</label>
                        <label><input class="aui-radio" type="radio" name="maritalStatus"  value="丧偶"  <?php  if($modle['marital_status'] == '丧偶'){?> checked <?php } ?> >丧偶</label>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        体型
                    </div>

                    <div class="aui-list-item-input">
                        <select name="shape">
                            <option value="不限"  <?php  if($modle['shape'] == '不限'){?> selected="selected" <?php } ?>  >不限</option>
                            <option value="偏瘦"  <?php  if($modle['shape'] == '偏瘦'){?> selected="selected" <?php } ?>  >偏瘦</option>
                            <option value="一般"  <?php  if($modle['shape'] == '一般'){?> selected="selected" <?php } ?>  >一般</option>
                            <option value="偏胖"  <?php  if($modle['shape'] == '偏胖'){?> selected="selected" <?php } ?>  >偏胖</option>
                            <option value="强壮"  <?php  if($modle['shape'] == '强壮'){?> selected="selected" <?php } ?>  >强壮</option>
                        </select>
                    </div>
                </div>
            </li>

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        学历
                    </div>

                    <div class="aui-list-item-input">
                        <select name="education">
                            <option value="不限"   <?php  if($modle['education'] == '不限'){?> selected="selected" <?php } ?>  >不限</option>
                            <option value="高中以上"  <?php  if($modle['education'] == '高中以上'){?> selected="selected" <?php } ?> >高中以上</option>
                            <option value="大专以上"  <?php  if($modle['education'] == '大专以上'){?> selected="selected" <?php } ?> >大专以上</option>
                            <option value="本科以上" <?php  if($modle['education'] == '本科以上'){?> selected="selected" <?php } ?>  >本科以上</option>
                            <option value="研究生"  <?php  if($modle['education'] == '研究生'){?> selected="selected" <?php } ?>  >研究生</option>
                        </select>
                    </div>
                </div>
            </li>



            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        月收入（元）
                    </div>

                    <div class="aui-list-item-input">
                        <select id="ysr" name="incomeMonthly">
                            <option value="3000元以下" <?php  if($modle['income_monthly'] == '3000元以下'){?> selected="selected" <?php } ?>  >3000元以下</option>
                            <option value="3000元~5000元"  <?php  if($modle['income_monthly'] == '3000元~5000元'){?> selected="selected" <?php } ?> >3000元~5000元</option>
                            <option value="5000元~8000元" <?php  if($modle['income_monthly'] == '5000元~8000元'){?> selected="selected" <?php } ?>  >5000元~8000元</option>
                            <option value="8000元~12000元" <?php  if($modle['income_monthly'] == '8000元~12000元'){?> selected="selected" <?php } ?> >8000元~12000元</option>
                            <option value="12000元以上" <?php  if($modle['income_monthly'] == '12000元以上'){?> selected="selected" <?php } ?> >12000元以上</option>
                        </select>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        单位性质
                    </div>
                    <div class="aui-list-item-input">

                        <select id="zy" name="job">
                            <option value="不限" <?php  if($modle['job'] == '不限'){?> selected="selected" <?php } ?> >不限</option>
                            <option value="事业单位" <?php  if($modle['job'] == '事业单位'){?> selected="selected" <?php } ?> >事业单位</option>
                            <option value="国有企业" <?php  if($modle['job'] == '国有企业'){?> selected="selected" <?php } ?> >国有企业</option>
                            <option value="公务员/政府机关" <?php  if($modle['job'] == '公务员/政府机关'){?> selected="selected" <?php } ?> >公务员/政府机关</option>
                            <option value="个体经营" <?php  if($modle['job'] == '个体经营'){?> selected="selected" <?php } ?> >个体经营</option>
                        </select>
                    </div>
                </div>
            </li>




            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        是否有孩子
                    </div>

                    <div class="aui-list-item-input">
                        <label><input class="aui-radio" type="radio" name="childStatus" value="不限" <?php  if($modle['child_status'] == '不限'){?> checked <?php } ?>  >不限</label>
                        <label><input class="aui-radio" type="radio" name="childStatus" value="没有" <?php  if($modle['child_status'] == '没有'){?> checked <?php } ?>  >没有</label>
                        <label><input class="aui-radio" type="radio" name="childStatus" value="有" <?php  if($modle['child_status'] == '有'){?> checked <?php } ?>  >有</label>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        与对方父母同住
                    </div>

                    <div class="aui-list-item-input">
                        <select id="lving" name="livingStatus">
                            <option value="看情况" <?php  if($modle['living_status'] == '看情况'){?> selected="selected" <?php } ?>  >看情况</option>
                            <option value="不介意与对方父母同住"   <?php  if($modle['living_status'] == '不介意与对方父母同住'){?> selected="selected" <?php } ?> >不介意与对方父母同住</option>
                            <option value="不希望与对方父母同住" <?php  if($modle['living_status'] == '不希望与对方父母同住'){?> selected="selected" <?php } ?> >不希望与对方父母同住</option>
                        </select>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        要求对方购房情况
                    </div>

                    <div class="aui-list-item-input" style="padding-left: 16px;">
                        <select id="gfqk" name="houseStatus">
                            <option value="不限" <?php  if($modle['house_status'] == '不限'){?> selected="selected" <?php } ?> >不限</option>
                            <option value="购有房屋" <?php  if($modle['house_status'] == '购有房屋'){?> selected="selected" <?php } ?> >购有房屋</option>
                        </select>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        要求对方购车情况
                    </div>

                    <div class="aui-list-item-input" style="padding-left: 16px;">
                        <select id="rw" name="carStatus">
                            <option value="不限"  <?php  if($modle['car_status'] == '不限'){?> selected="selected" <?php } ?>  >不限</option>
                            <option value="购有车辆" <?php  if($modle['car_status'] == '购有车辆'){?> selected="selected" <?php } ?> >购有车辆</option>
                        </select>
                    </div>
                </div>
            </li>


            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        是否喝酒
                    </div>

                    <div class="aui-list-item-input">
                        <select id="yj" name="drinkStatus">
                            <option value="不限" <?php  if($modle['drink_status'] == '不限'){?> selected="selected" <?php } ?>   >不限</option>
                            <option value="不喝" <?php  if($modle['drink_status'] == '不喝'){?> selected="selected" <?php } ?>   >不喝</option>
                            <option value="偶尔喝"  <?php  if($modle['drink_status'] == '偶尔喝'){?> selected="selected" <?php } ?>  >偶尔喝</option>
                            <option value="经常喝" <?php  if($modle['drink_status'] == '经常喝'){?> selected="selected" <?php } ?>   >经常喝</option>
                        </select>
                    </div>
                </div>
            </li>

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label">
                        是否抽烟
                    </div>

                    <div class="aui-list-item-input">
                        <select id="cy" name="smokeStatus">
                            <option value="不限" <?php  if($modle['smoke_status'] == '经常喝'){?> selected="selected" <?php } ?> >不限</option>
                            <option value="不抽" <?php  if($modle['smoke_status'] == '不抽'){?> selected="selected" <?php } ?>   >不抽</option>
                            <option value="偶尔抽" <?php  if($modle['smoke_status'] == '偶尔抽'){?> selected="selected" <?php } ?> >偶尔抽</option>
                            <option value="经常抽" <?php  if($modle['smoke_status'] == '经常抽'){?> selected="selected" <?php } ?> >经常抽</option>
                        </select>
                    </div>
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

$this->registerJsFile("@web/cdn/js/city_list.js",['depends'=>'yii\web\YiiAsset','position'=>\yii\web\View::POS_HEAD]);


?>





<script language="JavaScript">


    var dialog = new auiDialog();


    $("#backBtn").click(function(){
        window.history.back();
    });
    $("#regBtn").click(function(){
        tijiao();
    });



    $(document).ready(function(){



        ctx = "<?php echo $baseUrl."/index.php?r=city" ?>";

        $(".aui-list .aui-list-item-input").css('width',"60%");




        initCityData(true);
    });

    var  dProvinceId= "<?php echo $modle['from_province_id'] ?>";
    var  dcityid = "<?php echo $modle['from_city_id'] ?>" ;
    var  dAreaid = "<?php echo $modle['from_area_id'] ?>" ;

    ctx = "${ctx}";

    //获取区县
    $("#province").change(function () {//当选择城市的下拉选的时候，区域进行联动
        getCityList($("#province").val(),"","",true);
    });

    //获取区县
    $("#citys").change(function () {//当选择城市的下拉选的时候，区域进行联动
        getAreasList($("#citys").val(),"",true);
    });


    function tijiao() {


        var age_min = $("select[name='age_min']").val();
        var age_max = $("select[name='age_max']").val();


        if((age_min !="不限")||(age_max !="不限")){
            if(parseFloat(age_min)>parseFloat(age_max)){
                msg("年龄的范围填错了");
                return;
            }
        }

        var height_min = $("input[name='height_min']").val();
        var height_max = $("input[name='height_max']").val();


        if((height_min !="不限")||(height_max !="不限")){
            if(parseFloat(height_min)>parseFloat(height_max)){
                msg("身高的范围填错了");
                return;
            }
        }





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
