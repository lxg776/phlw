<div  id="page3" class="aui-content aui-margin-b-15 aui-hide">

    <div class="aui-tab" id="tab">
        <div class="aui-tab-item aui-active">收件箱</div>
        <div class="aui-tab-item">谁看过我</div>
    </div>


    <ul id="page3_p1" class="aui-list aui-media-list">

        <?php  foreach ($msgList as $item)  ?>
            <li class="aui-list-item" >
                <a href="javascript:;" onclick="getMsgList(<?php echo $item['from_user_id'] ?> )">
                    <div class="aui-media-list-item-inner">

                        <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;">



                            <?php if($item['b_avatar']){

                                ?>
                                <img src="<?php echo $imageBase.$item['b_avatar'] ?>" >

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



                                <?php
                                    if($item['unReadCount']>0){
                                        ?>

                                        <div class="aui-badge" style="left: 82%; top: 5%">
                                            <?php echo $item['unReadCount'] ?> </div>
                                        <?php
                                    }
                                ?>
                        </div>
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-text">
                                <div class="aui-list-item-title"><?php echo $item['nikename'] ?> </div>
                                <div class="aui-list-item-right"> <?php echo $item['create_time'] ?> </div>
                            </div>

                            <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">
                                广西靖西市，<?php echo $item['age'] ?>岁，<?php echo $item['height'] ?>cm，<?php echo $item['month_income']?>
                            </div>
                        </div>
                    </div>
                </a>
            </li>

        </c:forEach>
    </ul>


    <ul id="page3_p2" class="aui-list aui-media-list aui-hide">
        <?php  foreach ($viewRecordList as $item){  ?>
            <li class="aui-list-item">
                <a href="javascript:;" onclick="viewUser(<?php echo $item['r_b_user_id'] ?>)">
                    <div class="aui-media-list-item-inner">

                        <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;">

                            <?php if($item['b_avatar']){

                                ?>
                                <img src="<?php echo $imageBase.$item['b_avatar'] ?>" >

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
                                <div class="aui-list-item-title"> <?php echo $item['nikename'] ?> </div>
                                <div class="aui-list-item-right"><?php echo $item['r_view_time'] ?> </div>
                            </div>

                            <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">
                                广西靖西市，<?php echo $item['age'] ?>岁，<?php echo $item['height'] ?>cm，<?php echo $item['month_income'] ?>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>



</div>
