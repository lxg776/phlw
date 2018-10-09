<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/9/6
 * Time: 20:17
 */

namespace app\models;
use app\util\CommonUtil;
use Yii;
use yii\base\Model;

class UserServiceModle extends Model
{



    public function selectViewRecordUsers($userId){

        $sql = "select r.view_time as r_view_time, r.b_user_id as r_b_user_id,base.user_id as base_user_id,base.nikename,base.avatar as b_avatar,base.birth_date,base.height,base.month_income,base.education,base.marital_status 
          from f_user_view_record  as r
          left join f_user_base_msg as base on r.f_user_id = base.user_id
          where r.b_user_id=:userId GROUP BY r.f_user_id
          order by r.view_time desc
         ";

        $query  = \Yii::$app->getDb()->createCommand($sql,[':userId'=>$userId ])->queryAll();

        $num = count($query);

        for($i=0;$i<$num;++$i){
            $birth_date = $query[$i]['birth_date'];

            if($birth_date){
                $age = CommonUtil::getAge($birth_date);
                $query[$i]['age'] = $age ;
            }

        }

        return $query;



    }



    /**
     * 查询最近消息
     * @param $userId
     * @return array
     * @throws \yii\db\Exception
     */
    public function  selectRecentMsgByUser($userId){


        $sql="    select * from
        (select m.id,m.msg_content,m.from_user_id,m.to_user_id,m.create_time,base.*  from f_message
        as m left join f_user_base_msg as base on m.from_user_id = base.user_id
        where to_user_id = :userId  order by m.id desc) as d left join (select from_user_id , count(id) as unReadCount  from f_message
            where to_user_id = :userId and msg_state = 0  group by from_user_id) as t on d.from_user_id = t.from_user_id ORDER BY d.create_time desc ";

        $query  = \Yii::$app->getDb()->createCommand($sql,[':userId'=>$userId ])->queryAll();

        $num = count($query);

        for($i=0;$i<$num;++$i){
            $birth_date = $query[$i]['birth_date'];

            if($birth_date){
                $age = CommonUtil::getAge($birth_date);
                $query[$i]['age'] = $age ;
            }

        }


        return $query;


    }





    public function  selectActivityList($pageNum,$pageSize){


        $offset = ($pageNum-1)*$pageSize;

        $sql = "select activity_id , title , sign_time , sign_end_time, activity_time ,sponsor,link_man, sign_cost, link_address, activity_address, show_status, 
ctime,cover_image from f_activity as f  where f.show_status = 'show'  ORDER BY ctime desc limit :offset,:pageSize";

        $query  = \Yii::$app->getDb()->createCommand($sql,[':offset'=>$offset,':pageSize'=>$pageSize])->queryAll();

        return $query;

    }


    public  function  selectActivityDetail($activityId){


        $sql = "select * from f_activity where activity_id = :activity_id";
        $query  = \Yii::$app->getDb()->createCommand($sql,[':activity_id'=>$activityId])->queryOne();

        return $query;

    }



    public function  selectTypeListByUserId($user_id){

        $q1 = " name as typeName,info,service_days, beg_time, end_time ";

        $from = "  from f_user_member_rel as r  left join
        f_member_type t on r.member_type_id = t.id ";

        $where = " where r.user_id = :user_id ORDER BY r.id desc ";

        $sql = "select ".$q1.$from.$where;
        $query  = \Yii::$app->getDb()->createCommand($sql,[':user_id'=>$user_id])->queryAll();

        return $query;

    }



    /**
     * 获取问候语
     */
    public function selectGreetingTemp($show_status){

        $sql  = "select * from f_greeting_temp where show_status = :show_status  ORDER BY sort desc";

        $query  = \Yii::$app->getDb()->createCommand($sql,[':show_status'=>$show_status])->queryAll();

        return $query;

    }




    /**
     * 访问+1
     * @param $f_user_id
     * @param $b_user_id
     * @throws \yii\db\Exception
     */
   public function execAddUserView($f_user_id,$b_user_id){

       $sql = "insert into f_user_view_record(f_user_id,b_user_id) values(:f_user_id,:b_user_id)";
        \Yii::$app->getDb()->createCommand($sql,[':f_user_id' => $f_user_id, ':b_user_id'=>$b_user_id])->execute();

   }

    /**
     * 获取用户设置
     * @param $user_id
     * @return array|false
     * @throws \yii\db\Exception
     */
    public function  selectUserSettingById($user_id){

        $sql = "select * from f_user_setting where user_id = :user_id";

        $query =  \Yii::$app->getDb()->createCommand($sql,[':user_id'=>$user_id])->queryOne();

        return $query;
    }


    /**
     * 获取图片列表
     * @param $user_id
     * @param $keyword
     * @return array
     * @throws \yii\db\Exception
     */
    public function  selectUserImageListById($user_id,$keyword){

        $sql = "select * from f_user_images where user_id  = :user_id and keyword = :keyword ";

        $query =  \Yii::$app->getDb()->createCommand($sql,[':user_id'=>$user_id,'keyword'=>$keyword])->queryAll();

        return $query;

    }

    /**
     * 获取推荐好友
     * @param $user
     * @param $offset
     * @param $limit
     * @return array
     * @throws \yii\db\Exception
     */
    public function  selectRecommendUsers($user,$offset,$limit){

        $q1 = "  uc.user_id , uc.user_name,uc.avatar, uc.sex, uc.last_login_time, uc.last_login_ip,uc.create_time ";

        $q2 =" base.nikename,base.birth_date,base.height,base.profession,base.marital_status,base.from_city, base.from_area ";

        $q3 = "  zo.sex ,zo.height as zo_height ,zo.income_monthly ,zo.education  ";

        $from = " from ucenter_user as uc ";

        $join  = "   left join f_user_base_msg as base on uc.user_id = base.user_id
        left join f_user_request as zo on uc.user_id = zo.user_id
        left join f_user_setting as s on uc.user_id = s.user_id
        where uc.user_id!=:user_id";

        $ordery  = " ORDER BY uc.last_login_time desc limit :offset,:limit";

        $sexString = "";

        if($user->sex==1){
            $sexString = " and uc.sex = 2 ";
        }else{
            $sexString = " and uc.sex = 1 ";
        }




        $sql  = "select ".$q1.",".$q2.",".$q3.$from.$join.$sexString.$ordery;

        //$query = \Yii::$app->getDb()->createCommand($sql,[':offset' => $offset,':limit'=>$limit]);
        //\Yii::$app->getDb()->createCommand

        $query =  \Yii::$app->getDb()->createCommand($sql,[':user_id'=>$user->id,':offset' => $offset,':limit'=>$limit])->queryAll();

        return $query;


    }

    /**
     * 获取用户详情
     * @param $user
     * @return array|false
     * @throws \yii\db\Exception
     */
    public function selectFUserDetailVoByUserId ($id){



        $q1 = " uc.user_id , uc.user_name,uc.avatar, uc.nickname, uc.sex, uc.last_login_time, uc.last_login_ip,uc.create_time ";
        $q2 = " base.nikename,base.birth_date,base.height,base.shape,base.year_income,base.month_income,base.education,base.disposition,base.profession,base.unit_property,
    base.work_unit,base.work_place,base.house_status,base.marital_status,base.children_status,base.soliloquy,base.declaration, base.from_city_id, base.from_area_id ";
        $q3 = "  zo.age as r_age,zo.sex as r_sex,zo.height as r_height,zo.shape as r_shape,zo.income_monthly as r_income_monthly,zo.income_year as r_income_year,zo.house_state as r_house_state,zo.education as r_education,zo.marital_status as r_marital_status,zo.house_status as r_house_status,zo.car_status as r_car_status,zo.job as r_job,zo.friend_require as r_friend_require,
        zo.drink_status as r_drink_status,zo.smoke_status as r_smoke_status,zo.living_status as r_living_status,zo.child_status as r_child_status ";
        $q4 = " ic.real_name as z_real_name, ic.idcard_type as z_idcard_type, ic.idcard_no as z_idcard_no, ic.idcard_imgs as z_idcard_imgs, ic.cellphone as z_cellphone ";

        $q5 = "   zh.smoking_status as l_smoking_status,zh.drinking_status as l_drinking_status,zh.cooking as l_cooking,zh.live_with_parents as l_live_with_parents,zh.favorite_date as l_favorite_date,zh.favorite_music as l_favorite_music,
        zh.favorite_film as l_favorite_film,zh.favorite_sports as l_favorite_sports,zh.favorite_pet as l_favorite_pet ";

        $q6 = " s.show_index_page as s_show_index_page , s.show_base_msg as s_show_base_msg,s.show_friend_request as s_show_friend_request,s.show_living_status as s_show_living_status ,s.show_favorite as s_show_favorite,s.idcard_status as s_idcard_status ";

        $from = " from ucenter_user as uc ";

        $join = " left join f_user_base_msg as base on uc.user_id = base.user_id
        left join ucenter_identificaion as ic on uc.user_id = ic.user_id
        left join f_user_request as zo on uc.user_id = zo.user_id
        left join f_user_living_status as zh on uc.user_id = zh.user_id
        left join f_user_setting as s on uc.user_id = s.user_id ";


        $where = "  where uc.user_id=:user_id ";

        $sql = "select ".$q1.",".$q2.",".$q3.",".$q4.",".$q5.",".$q6.$from.$join.$where;


        $query = \Yii::$app->getDb()->createCommand($sql,[':user_id'=>$id])->queryOne();

        $typeList = $this->selectTypeListByUserId($id);





        if($typeList){
            $query['type_list'] = $typeList;
            if($typeList){
                $query['memberTypeVo'] = $typeList[0];
            }
        }

        $birth_date = $query['birth_date'];

        if($birth_date){
           $age = \app\util\CommonUtil::getAge($birth_date);
           $query['age'] = $age;
        }

        return $query;

    }



}