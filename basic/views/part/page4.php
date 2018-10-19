
<div  id="page4" class="aui-content aui-margin-b-15 aui-hide">

    <ul class="aui-list aui-media-list">
        <li class="aui-list-item">
            <div class="aui-media-list-item-inner">

                <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;">
                    <?php if($modle['avatar']){?>

                        <img src="<?php echo $imageBase.$modle['avatar']?>" >

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
                        <div class="aui-list-item-title"><?php echo $modle['nikename'] ?>
                            <?php if($modle['memberTypeVo']){
                             ?>
                            <font color="red">(<?php echo $modle['memberTypeVo']['info'] ?>)</font>
                            <?php
                             }
                             ?>
                            </div>
                        <div class="aui-list-item-right" style="display: none;">访问次数99</div>
                    </div>

                    <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">
                        广西靖西市， <?php echo $modle['age'] ?>岁，<?php echo $modle['height'] ?> cm，<?php echo $modle['month_income'] ?>
                    </div>
                </div>
            </div>
        </li>

        <div class="aui-card-list">
            <div class="aui-card-list-header">
                相册
                <div class="aui-list-item-right"><a href="${ctx}/u/editPhoto" style="font-size: 0.7rem;">编辑</a></div>
            </div>
            <div class="aui-card-list-content-padded aui-border-b aui-border-t">
                <div class="aui-row aui-row-padded">
                    <ul id="images">
                        <?php if($userImages) {
                                  foreach($userImages as $item) { ?>
                                      <li class="aui-col-xs-4">
                                          <img src="<?php echo $imageBase.$item['image_path'] ?> "/>
                                      </li>
                                      <?php
                                  }
                        }
                        ?>

                    </ul>
                </div>
            </div>

        </div>

<!--个人资料-->
        <li class="aui-list-item">
            <div class="aui-media-list-item-inner">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-title">个人资料</div>
                        <div class="aui-list-item-right"><a href="${ctx}/u/editGrzl" style="font-size: 0.7rem;">编辑</a></div>
                    </div>
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">昵称</div>
                        <div class="aui-list-item-title"><?php echo $modle['nikename']?></div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">年龄</div>
                        <div class="aui-list-item-title"><?php echo $modle['age']?>岁</div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">学历</div>
                        <div class="aui-list-item-title"><?php echo $modle['education']?></div>

                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">身高</div>
                        <div class="aui-list-item-title"><?php echo $modle['height']?> cm</div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">月收入</div>
                        <div class="aui-list-item-title"><?php echo $modle['month_income']?> </div>
                    </div>



                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">体型</div>
                        <div class="aui-list-item-title"><?php echo $modle['shape']?> </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">婚姻状况</div>
                        <div class="aui-list-item-title"><?php echo $modle['marital_status']?> </div>
                    </div>

                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-media-list-item-inner">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-title">择偶条件</div>
                        <div class="aui-list-item-right"><a href="${ctx}/u/editZobz" style="font-size: 0.7rem;">编辑</a></div>
                    </div>
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">年龄</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_age']?>岁</div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">身高</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_height']?>cm</div>
                    </div>


                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">月收入</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_income_monthly']?> </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">学历</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_education']?> </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">婚姻</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_marital_status']?> </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">住房情况</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_house_status']?> </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">购车情况</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_car_status']?> </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">体型</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_shape']?></div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">有无小孩</div>
                        <div class="aui-list-item-title"><?php echo $modle['r_child_status']?> </div>
                    </div>



                </div>


            </div>

        </li>

        <li class="aui-list-item">
            <div class="aui-media-list-item-inner">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-title">生活状态</div>
                        <div class="aui-list-item-right"><a href="${ctx}/u/editShzk" style="font-size: 0.7rem;">编辑</a></div>
                    </div>
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">抽烟状况</div>
                        <div class="aui-list-item-title">
                            <?php if($modle['l_smoking_status']==0){?>
                                不抽
                            <?php } ?>

                            <?php if($modle['l_smoking_status']==1){?>
                                偶尔抽
                            <?php } ?>

                            <?php if($modle['l_smoking_status']==2){?>
                                经常抽
                            <?php } ?>

                        </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">饮酒状况</div>
                        <div class="aui-list-item-title">

                            <?php if($modle['l_drinking_status']==0){?>
                                不喝
                            <?php } ?>

                            <?php if($modle['l_drinking_status']==1){?>
                                偶尔喝
                            <?php } ?>

                            <?php if($modle['l_drinking_status']==2){?>
                                经常喝
                            <?php } ?>

                        </div>
                    </div>


                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">厨艺</div>
                        <div class="aui-list-item-title">
                            <?php if($modle['l_cooking']==0){?>
                                不下厨
                            <?php } ?>

                            <?php if($modle['l_cooking']==1){?>
                                厨艺有待提高
                            <?php } ?>

                            <?php if($modle['l_cooking']==2){?>
                                上得了厅堂
                            <?php } ?>

                            <?php if($modle['l_cooking']==3){?>
                                饭店大厨级别
                            <?php } ?>


                        </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">与父母同住</div>
                        <div class="aui-list-item-title">
                            <?php echo $modle['l_live_with_parents']?>

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
                        <div class="aui-list-item-right"><a href="${ctx}/u/editXqhh" style="font-size: 0.7rem;">编辑</a></div>
                    </div>
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">喜欢的音乐</div>
                        <div class="aui-list-item-title">
                            <?php echo $modle['l_favorite_music']?>

                        </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">喜欢的电影</div>
                        <div class="aui-list-item-title">
                            <?php echo $modle['l_favorite_film']?>
                        </div>
                    </div>


                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">喜欢的运动</div>
                        <div class="aui-list-item-title">
                            <?php echo $modle['l_favorite_sports']?>
                        </div>
                    </div>

                    <div class="aui-list-item-text">
                        <div class="aui-list-item-left">喜欢的宠物</div>
                        <div class="aui-list-item-title">
                            <?php echo $modle['l_favorite_pet']?>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <ul style="margin-top: 16px">

        <p><div class="aui-btn aui-btn-block aui-btn-outlined" id="logoutBtn" style="color: red;">注销登录</div></p>

    </ul>

</div>