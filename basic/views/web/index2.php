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

    <div  id="page1" class="aui-content aui-margin-b-15">
        <ul class="aui-list aui-media-list" id="listUser">
            <li class="aui-list-header">
                推荐列表
            </li>

            <c:forEach var="item" items="${recommendUserList}" >
                <li class="aui-list-item">
                    <a href="javascript:;" onclick="viewUser(${item.userId})">
                        <div class="aui-media-list-item-inner">
                            <div class="aui-list-item-media" style="width: 7rem; height: 7rem;">
                                <c:if test="${not empty item.avatar}">
                                    <img src="${imageBase}${item.avatar}" >
                                </c:if>
                                <c:if test="${empty item.avatar}">
                                    <c:if test="${item.sex == 1}">
                                        <img src="${ctx}/image/default_man_icon.png" >
                                    </c:if>
                                    <c:if test="${item.sex == 2}">
                                        <img src="${ctx}/image/default_woman_icon.png" >

                                    </c:if>
                                </c:if>
                            </div>
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-text">
                                    <div class="aui-list-item-title">${item.fUserBaseMsg.nikename}</div>

                                    <div class="aui-list-item-right aui-greed">实名</div>
                                </div>
                                <div class="aui-list-item-text">
                                    <div class="aui-list-item-text">${item.age}岁</div>
                                    <div class="aui-list-item-text">${item.fUserBaseMsg.profession}</div>
                                    <div class="aui-list-item-text">${item.fUserBaseMsg.height}cm</div>
                                </div>

                                <div class="aui-list-item-text" style="color: #0a0c0e">
                                    择偶条件:我想找寻靖西<c:if test="${not empty item.fUserRequest.age}">年龄在${item.fUserRequest.age}岁,</c:if>
                                    <c:if test="${not empty item.fUserRequest.height}">身高${item.fUserRequest.height}<c:if test="${item.fUserRequest.height!='不限'}">cm</c:if>，</c:if>
                                    <c:if test="${not empty item.fUserRequest.incomeMonthly}">月收入
                                        ${item.fUserRequest.incomeMonthly}</c:if>的<c:if test="${item.sex == 1}">男性</c:if><c:if test="${item.sex == 2}">女性</c:if>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="aui-info" style="padding-top:0">
                        <div class="aui-info-item">
                            <a href="javascript:;"  onclick="sendGreetToUser(${item.userId})">打招呼</a>
                        </div>
                        <div class="aui-info-item">
                            <a href="javascript:;"  <c:if test="${fUserSetting.msgSendStatus == 0}">aui-popup-for="top-left" </c:if>
                            <c:if test="${fUserSetting.msgSendStatus == 1}">onclick="getMsgList(${item.userId})"</c:if>
                            >发信息</a>
                        </div>

                        <div class="aui-info-item" style="padding-right: 10px;">
                            <a href="javascript:;"  onclick="helpContact(${item.userId})" >帮我联系她</a>
                        </div>

                    </div>

                </li>
            </c:forEach>
        </ul>
    </div>


<!--    <%--page2--%>-->
<!---->
<!--    <div  id="page2" class="aui-content aui-margin-b-15 aui-hide">-->
<!--        <section class="aui-content" id="activityList">-->
<!--            <c:forEach var="item" items="${fActivityList}" >-->
<!--                <a href="javascript:;" onclick="detailActivtiy(${item.activityId})">-->
<!--                    <div class="aui-card-list">-->
<!--                        <div class="aui-card-list-header">-->
<!--                            ${item.title}<small>活动时间:${item.activityTime}</small>-->
<!--                        </div>-->
<!--                        <div class="aui-card-list-content">-->
<!--                            <img src="${imageBase}${item.coverImage}" />-->
<!--                        </div>-->
<!--                        <div class="aui-card-list-footer">-->
<!--                            <div>报名费用:${item.signCost}元/人</div>-->
<!--                            <div>单身交友</div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </c:forEach>-->
<!--        </section>-->
<!--    </div>-->

    <%--page3--%>

    <div  id="page3" class="aui-content aui-margin-b-15 aui-hide">

        <div class="aui-tab" id="tab">
            <div class="aui-tab-item aui-active">收件箱</div>
            <div class="aui-tab-item">谁看过我</div>
        </div>


        <ul id="page3_p1" class="aui-list aui-media-list">
            <%--item--%>
            <c:forEach var="item" items="${msgList}" >
                <li class="aui-list-item" >
                    <a href="javascript:;" onclick="getMsgList(${item.fromUserId})">
                        <div class="aui-media-list-item-inner">

                            <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;">
                                <img src="${ctx}/aui/image/mm.jpeg" >
                                <c:if test="${item.unReadCount > 0}">
                                    <div class="aui-badge" style="left: 82%; top: 5%">

                                        ${item.unReadCount}</div></c:if>

                            </div>
                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-text">
                                    <div class="aui-list-item-title">${item.fUserBaseMsg.nikename}</div>
                                    <div class="aui-list-item-right"><fmt:formatDate value="${item.createTime}" pattern="yyyy-MM-dd hh:mm" /></div>
                                </div>

                                <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">
                                    广西靖西市，${item.age}岁，${item.fUserBaseMsg.height}cm，${item.fUserBaseMsg.monthIncome}
                                </div>
                            </div>
                        </div>
                    </a>
                </li>

            </c:forEach>
        </ul>


        <ul id="page3_p2" class="aui-list aui-media-list aui-hide">
            <%--item--%>
            <c:forEach var="item" items="${viewRecordList}" >
                <li class="aui-list-item">
                    <a href="javascript:;" onclick="viewUser(${item.fUserId})">
                        <div class="aui-media-list-item-inner">

                            <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;">
                                <img src="${ctx}/aui/image/mm.jpeg" >
                            </div>

                            <div class="aui-list-item-inner">
                                <div class="aui-list-item-text">
                                    <div class="aui-list-item-title">${item.fwUserBaseMsg.nikename}</div>
                                    <div class="aui-list-item-right"><fmt:formatDate value="${item.viewTime}" pattern="yyyy-MM-dd hh:mm" /></div>
                                </div>

                                <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">
                                    广西靖西市，${item.age}岁，${item.fwUserBaseMsg.height}cm，${item.fwUserBaseMsg.monthIncome}
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            </c:forEach>



        </ul>



    </div>


<!--    <%--page4--%>-->
<!---->
<!--    <div  id="page4" class="aui-content aui-margin-b-15 aui-hide">-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--        <ul class="aui-list aui-media-list">-->
<!--            <li class="aui-list-item">-->
<!--                <div class="aui-media-list-item-inner">-->
<!---->
<!--                    <div class="aui-list-item-media" style="width: 6.0rem; height: 6.0rem;">-->
<!--                        <c:if test="${not empty modle.avatar}">-->
<!--                            <img src="${imageBase}${modle.avatar}" >-->
<!--                        </c:if>-->
<!--                        <c:if test="${empty modle.avatar}">-->
<!--                            <c:if test="${modle.sex == 1}">-->
<!--                                <img src="${ctx}/image/default_man_icon.png" >-->
<!--                            </c:if>-->
<!--                            <c:if test="${modle.sex == 2}">-->
<!--                                <img src="${ctx}/image/default_woman_icon.png" >-->
<!---->
<!--                            </c:if>-->
<!--                        </c:if>-->
<!--                    </div>-->
<!--                    <div class="aui-list-item-inner">-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.nikename} <c:if test="${not empty memberTypeVo}"><font color="red">(${memberTypeVo.info})</font></c:if> </div>-->
<!--                            <div class="aui-list-item-right" style="display: none;">访问次数99</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text" style="color:#757575;font-size: 14px;">-->
<!--                            广西靖西市，${modle.age}岁，${modle.fUserBaseMsg.height}cm，${modle.fUserBaseMsg.monthIncome}-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </li>-->
<!---->
<!--            <div class="aui-card-list">-->
<!--                <div class="aui-card-list-header">-->
<!--                    相册-->
<!--                    <div class="aui-list-item-right"><a href="${ctx}/u/editPhoto" style="font-size: 0.7rem;">编辑</a></div>-->
<!--                </div>-->
<!--                <div class="aui-card-list-content-padded aui-border-b aui-border-t">-->
<!--                    <div class="aui-row aui-row-padded">-->
<!--                        <ul id="images">-->
<!--                            <c:if test="${list == null}">-->
<!--                                <c:forEach var="item" items="${userImages}">-->
<!--                                    <li class="aui-col-xs-4">-->
<!--                                        <img src="${imageBase}${item.imagePath}"/>-->
<!--                                    </li>-->
<!--                                </c:forEach>-->
<!--                            </c:if>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <%--个人资料--%>-->
<!--            <li class="aui-list-item">-->
<!--                <div class="aui-media-list-item-inner">-->
<!--                    <div class="aui-list-item-inner">-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-title">个人资料</div>-->
<!--                            <div class="aui-list-item-right"><a href="${ctx}/u/editGrzl" style="font-size: 0.7rem;">编辑</a></div>-->
<!--                        </div>-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">昵称</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.nikename}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">年龄</div>-->
<!--                            <div class="aui-list-item-title">${modle.age}岁</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">学历</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.education}</div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">身高</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.height}cm</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">月收入</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.monthIncome}</div>-->
<!--                        </div>-->
<!---->
<!---->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">体型</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.shape}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">婚姻状况</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserBaseMsg.maritalStatus}</div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </li>-->
<!--            <li class="aui-list-item">-->
<!--                <div class="aui-media-list-item-inner">-->
<!--                    <div class="aui-list-item-inner">-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-title">择偶条件</div>-->
<!--                            <div class="aui-list-item-right"><a href="${ctx}/u/editZobz" style="font-size: 0.7rem;">编辑</a></div>-->
<!--                        </div>-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">年龄</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.age}岁</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">身高</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.height}cm</div>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">月收入</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.incomeMonthly}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">学历</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.education}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">婚姻</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.maritalStatus}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">住房情况</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.houseStatus}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">购车情况</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.carStatus}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">体型</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.shape}</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">有无小孩</div>-->
<!--                            <div class="aui-list-item-title">${modle.fUserRequest.childStatus}</div>-->
<!--                        </div>-->
<!---->
<!---->
<!---->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--            </li>-->
<!---->
<!--            <li class="aui-list-item">-->
<!--                <div class="aui-media-list-item-inner">-->
<!--                    <div class="aui-list-item-inner">-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-title">生活状态</div>-->
<!--                            <div class="aui-list-item-right"><a href="${ctx}/u/editShzk" style="font-size: 0.7rem;">编辑</a></div>-->
<!--                        </div>-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">抽烟状况</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                <c:if test="${modle.fUserLivingStatus.smokingStatus == 0 }">不抽</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.smokingStatus == 1 }">偶尔抽</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.smokingStatus == 2 }">经常抽</c:if>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">饮酒状况</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                <c:if test="${modle.fUserLivingStatus.drinkingStatus == 0 }">不喝</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.drinkingStatus == 1 }">偶尔喝</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.drinkingStatus == 2 }">经常喝</c:if>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">厨艺</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                <c:if test="${modle.fUserLivingStatus.cooking == 0 }">不下厨</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.cooking == 1 }">厨艺有待提高</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.cooking == 2 }">上得了厅堂</c:if>-->
<!--                                <c:if test="${modle.fUserLivingStatus.cooking == 3 }">饭店大厨级别</c:if>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">与父母同住</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                ${modle.fUserLivingStatus.liveWithParents}-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--            </li>-->
<!---->
<!--            <li class="aui-list-item">-->
<!--                <div class="aui-media-list-item-inner">-->
<!--                    <div class="aui-list-item-inner">-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-title">兴趣爱好</div>-->
<!--                            <div class="aui-list-item-right"><a href="${ctx}/u/editXqhh" style="font-size: 0.7rem;">编辑</a></div>-->
<!--                        </div>-->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">喜欢的音乐</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                ${modle.fUserLivingStatus.favoriteMusic}-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">喜欢的电影</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                ${modle.fUserLivingStatus.favoriteFilm}-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">喜欢的运动</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                ${modle.fUserLivingStatus.favoriteSports}-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-text">-->
<!--                            <div class="aui-list-item-left">喜欢的宠物</div>-->
<!--                            <div class="aui-list-item-title">-->
<!--                                ${modle.fUserLivingStatus.favoritePet}-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--            </li>-->
<!---->
<!--        </ul>-->
<!--        <ul style="margin-top: 16px">-->
<!---->
<!--            <p><div class="aui-btn aui-btn-block aui-btn-outlined" id="logoutBtn" style="color: red;">注销登录</div></p>-->
<!---->
<!--        </ul>-->
<!---->
<!---->
<!--    </div>-->
<!---->
<!--</div>-->
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
        <c:if test="${unReadCount > 0}"><div class="aui-badge">${unReadCount}</div></c:if>
        <i class="aui-iconfont aui-icon-comment"></i>
        <div class="aui-bar-tab-label">消息</div>
    </div>
    <div class="aui-bar-tab-item" tapmode>
        <div class="aui-dot"></div>
        <i class="aui-iconfont aui-icon-my"></i>
        <div class="aui-bar-tab-label">我的</div>
    </div>
</footer>


<!--<div id="tempUser"  style="display: none">-->
<!--    <li class="aui-list-item">-->
<!--        <div class="aui-media-list-item-inner">-->
<!--            <div class="aui-list-item-media" style="width: 7rem; height: 7rem;">-->
<!--                <img src="#image" >-->
<!--            </div>-->
<!--            <div class="aui-list-item-inner">-->
<!--                <div class="aui-list-item-text">-->
<!--                    <div class="aui-list-item-title">#nikename</div>-->
<!---->
<!--                    <div class="aui-list-item-right aui-greed">实名</div>-->
<!--                </div>-->
<!--                <div class="aui-list-item-text">-->
<!--                    <div class="aui-list-item-text">#age岁</div>-->
<!--                    <div class="aui-list-item-text">#profession</div>-->
<!--                    <div class="aui-list-item-text">#heightcm</div>-->
<!--                </div>-->
<!---->
<!--                <div class="aui-list-item-text" style="color: #0a0c0e">-->
<!--                    择偶条件:我想找寻靖西#zo-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="aui-info" style="padding-top:0">-->
<!--            <div class="aui-info-item">-->
<!--                <a href="#">打招呼</a>-->
<!--            </div>-->
<!--            <div class="aui-info-item">-->
<!--                <a href="javascript:;"  <c:if test="${fUserSetting.msgSendStatus == 0}">aui-popup-for="top-left" </c:if>-->
<!--                <c:if test="${fUserSetting.msgSendStatus == 1}">onclick="sendMsg(#toUser)"</c:if>-->
<!--                >发信息</a>-->
<!--            </div>-->
<!---->
<!--            <div class="aui-info-item" style="padding-right: 10px;">-->
<!--                <a href="#">帮我联系她</a>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </li>-->
<!---->
<!--</div>-->

<!--<div id="tempActivity"  style="display: none">-->
<!---->
<!--    <div class="aui-card-list">-->
<!--        <div class="aui-card-list-header">-->
<!--            #title<small>活动时间:#activityTime</small>-->
<!--        </div>-->
<!--        <div class="aui-card-list-content">-->
<!--            <img src="#img" />-->
<!--        </div>-->
<!--        <div class="aui-card-list-footer">-->
<!--            <div>报名费用:#signCost元/人</div>-->
<!--            <div>单身交友</div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->

<!--<%--会员弹出框--%>-->
<!--<div class="aui-popup aui-popup-top-left" style="width: 95%;display: none;" id="top-left">-->
<!---->
<!--    <div class="aui-popup-content">-->
<!--        <div class="aui-content aui-margin-b-15" style="margin-top: 0.5rem;">-->
<!---->
<!--            <ul class="aui-list aui-media-list">-->
<!---->
<!--                <li class="aui-list-item">-->
<!---->
<!--                    <div class="aui-list-item-text">-->
<!--                        <div class="aui-list-item-title">开通的会员类型</div>-->
<!---->
<!--                        <div class="aui-list-item-right" style="padding-right: 16px;"><i class="aui-iconfont aui-icon-close"  id="payCloseBtn"></i></div>-->
<!--                    </div>-->
<!--                    <div class="aui-list-item-inner">-->
<!---->
<!---->
<!--                        <c:forEach items="${typeList}" var="item">-->
<!--                            <div class="aui-list-item-input" style="margin-top: 10px;">-->
<!--                                <label><input class="aui-radio" type="radio" name="mTypeId" value="${item.id}">&nbsp;&nbsp;&nbsp;${item.name}(${item.serviceDays}天)<span style="color: red;">¥${item.price}</span></label>-->
<!--                            </div>-->
<!--                        </c:forEach>-->
<!---->
<!--                    </div>-->
<!--                </li>-->
<!---->
<!--                <li class="aui-list-item">-->
<!--                    <div class="aui-list-item-inner">-->
<!---->
<!--                        <div class="aui-list-item-input" style="margin-bottom: 8px;">-->
<!--                            <label>支付方式</label>-->
<!--                        </div>-->
<!---->
<!--                        <div class="aui-list-item-input" style="margin-top: 10px; position: relative; height: 85px;" >-->
<!--                            <label><input class="aui-radio" style="left: 4px; top: 30px; position: absolute"  type="radio" name="payVendorId" value="1" > <img src="${ctx}/aui/image/wx_pay_icon.png" style="width: 187px; left: 48px; position: absolute" /></label>-->
<!---->
<!--                        </div>-->
<!--                        <div class="aui-list-item-input" style="margin-top: 10px; position: relative; height: 85px;" >-->
<!--                            <label><input class="aui-radio" style="left: 4px; top: 30px; position: absolute"  type="radio" name="payVendorId" value="2"> <img src="${ctx}/aui/image/zfb_pay_icon.png" style="width: 187px; left: 48px; position: absolute" /></label>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
<!---->
<!--            <div class="aui-content-padded">-->
<!--                <div class="aui-btn aui-btn-info aui-btn-block" id="ktBtn" style="margin-top: 1rem;">立即开通</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->


<!--<%--会员弹出框--%>-->
<!--<div class="aui-popup aui-popup-bottom-left" style="width: 95%;display: none;" id="top-buttom">-->
<!---->
<!--    <div class="aui-popup-content">-->
<!--        <div class="aui-content aui-margin-b-15" style="margin-top: 0.5rem;">-->
<!---->
<!--            <ul class="aui-list aui-media-list">-->
<!---->
<!--                <li class="aui-list-item">-->
<!--                    <div class="aui-list-item-text">-->
<!--                        <div class="aui-list-item-title">问候语</div>-->
<!---->
<!--                        <div class="aui-list-item-right" style="padding-right: 16px;"><i class="aui-iconfont aui-icon-close"  id="greetingCloseBtn"></i></div>-->
<!--                    </div>-->
<!--                    <div class="aui-list-item-inner">-->
<!---->
<!---->
<!--                        <input type="hidden" id="gtoUserId" />-->
<!--                        <c:forEach items="${greetingTempList}" var="item">-->
<!--                            <div class="aui-list-item-input" style="margin-top: 10px;">-->
<!--                                <label><input class="aui-radio" type="radio" name="greeting" value="${item.id}" checked>&nbsp;&nbsp;&nbsp;${item.content}</label>-->
<!--                            </div>-->
<!--                        </c:forEach>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
<!---->
<!--            <div class="aui-content-padded">-->
<!--                <div class="aui-btn aui-btn-info aui-btn-block" id="greetingBtn" style="margin-top: 1rem;">发送</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</div>






<div class="aui-list-item-inner">
    <div class="aui-list-item-text">
        <div class="aui-list-item-title"> <? $item['nikename'] ?></div>

        <div class="aui-list-item-right aui-greed">实名</div>
    </div>
    <div class="aui-list-item-text">
        <div class="aui-list-item-text"><? $item['age'] ?>岁</div>
        <div class="aui-list-item-text"><? $item['profession'] ?> </div>
        <div class="aui-list-item-text"><? $item['height'] ?> cm</div>
    </div>

    <div class="aui-list-item-text" style="color: #0a0c0e">
        择偶条件:我想找寻靖西
        <?php if($item['age']){ ?>
            年龄在<? $item['age'] ?> 岁
            <?
        }
        ?>
        <?php if($item['height']){ ?>
            身高<? $item['height'] ?> <? if($item['height']!='不限'){ ?>
                cm
            <? } ?>，
            <?php if($item['income_monthly']){ ?>
                月收入<? $item['income_monthly']?> 的

            <? } ?>，
            <? if($item['sex']==1){ ?>男性 <? }?>
            <? if($item['sex']==2){} ?>女性 <? }?>
    </div>
</div>
</div>
</a>

<div class="aui-info" style="padding-top:0">
    <div class="aui-info-item">
        <a href="javascript:;"  onclick="sendGreetToUser(<?$item[user_id]?>)">打招呼</a>
    </div>
    <div class="aui-info-item">
        <a href="javascript:;"  <? if($fUserSetting['msg_send_status']==0){ ?>  aui-popup-for="top-left" <?
        }?>
            <? if($fUserSetting['msg_send_status']==1){ ?> onclick="getMsgList(${item.userId})"
                <?
            }?>
        >发信息</a>
    </div>

    <div class="aui-info-item" style="padding-right: 10px;">
        <a href="javascript:;"  onclick="helpContact(${item.userId})" >帮我联系她</a>
    </div>

</div>
