<div  id="page1" class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-media-list" id="listUser">
        <li class="aui-list-header">
            推荐列表
        </li>
        <?php  foreach($recommendUser as $item){ ?>
        <li class="aui-list-item">
            <a href="javascript:;" onclick="viewUser(<?php echo $item['user_id'] ?>)">


                <div class="aui-media-list-item-inner">
                    <div class="aui-list-item-media" style="width: 7rem; height: 7rem;">


                        <?php if($item['avatar']){

                            ?>
                            <img src="<?php echo $imageBase.$item['avatar'] ?>" >

                        <?php } else{

                                    if($item['sex']==1){
                                        ?>
                                         <img src="<?php echo $baseUrl ?>/cdn/image/default_man_icon.png" >


                        <?php
                                    } else if($item['sex']==2){
                        ?>
                        <img src="<?php echo $baseUrl ?>/cdn/image/default_woman_icon.png" >
                                    <?php
                                        }
                                    }?>
                        </div>


                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-title"> <?php echo $item['nikename'] ?></div>

                            <div class="aui-list-item-right aui-greed">实名</div>
                        </div>
                        <div class="aui-list-item-text">
                            <div class="aui-list-item-text"><?php echo $item['age'] ?>岁</div>
                            <div class="aui-list-item-text"><?php echo $item['profession'] ?> </div>
                            <div class="aui-list-item-text"><?php echo $item['height'] ?> cm</div>
                        </div>



                        <div class="aui-list-item-text" style="color: #0a0c0e">
                            择偶条件:我想找寻靖西
                            <?php if($item['zo_age']){ ?>
                                年龄在<?php echo $item['zo_age'] ?> 岁

                                <?php
                            }
                            ?>
                            <?php if($item['zo_height']){ ?>
                                身高<?php echo $item['zo_height'] ?> <?php if($item['zo_height']!='不限'){ ?>
                                    cm
                                <?php }} ?>，

                                <?php if($item['zo_income_monthly']){ ?>
                                    月收入<?php echo $item['zo_income_monthly']?>的
                                <?php } ?><?php if($item['sex']==2){ ?>男性 <?php }?><?php if($item['sex']==1){ ?>女性 <?php }?>
                        </div>



                    </div>
                </div>
            </a>

            <div class="aui-info" style="padding-top:0">
                <div class="aui-info-item">
                    <a href="javascript:;"  onclick="sendGreetToUser(<?php echo $item['user_id'] ?>)">打招呼</a>
                </div>
                <div class="aui-info-item">

                    <a href="javascript:;"  onclick="getMsgList(<?php echo $item['user_id'] ?>)" > 发信息</a>
                </div>

                <div class="aui-info-item" style="padding-right: 10px;">
                    <a href="javascript:;"  onclick="helpContact(<?php echo $item['user_id'] ?>)" >帮我联系她</a>
                </div>

            </div>



        </li>
        <?php } ?>
    </ul>
</div>





