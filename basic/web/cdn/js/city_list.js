//初始化城市数据
var ctx="";


function initCityData(fla) {
    $("#province").empty();

    $.ajax({
        url: ctx+"/c/provinceList",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            $.each(data.data.dataList, function (i, item) {
                if (item.provinceid == dProvinceId) {
                    $("#province").append(" <option value='" + item.provinceid + "'   selected='selected'> " + item.province + "</option>");
                } else {
                    $("#province").append(" <option value='" + item.provinceid + "' > " + item.province + "</option>");
                }
            });
        }
    });

    if(fla){
        getCityList(dProvinceId, dcityid, "",fla);
    }else{
        getCityList(dProvinceId, dcityid, dAreaid);
    }
    // getAreasList(cityid,areaid);
}

function getCityList(provinceid,defaultId,dareaid,fla) {
    $("#citys").empty();
    data = "provinceid="+provinceid;
    $.ajax({
        url: ctx+"/c/cityList",
        type: "GET",
        data:data,
        dataType:'json',
        success:function(data){
            $.each(data.data.dataList,function(i,item){
                if(defaultId&&item.cityid == defaultId ){
                    $("#citys").append(" <option value='" + item.cityid + "'   selected='selected'> " + item.city + "</option>");
                    if(fla){
                        getAreasList(defaultId,"",fla);
                    }else{
                        getAreasList(defaultId,dareaid);
                    }

                    return;
                }else{
                    $("#citys").append(" <option value='" + item.cityid + "' > " + item.city + "</option>");
                    if(!defaultId&&i==0){
                        if(fla){
                            getAreasList(item.cityid,"",fla);
                        }else{
                            getAreasList(item.cityid,"");
                        }

                    }
                }
            });
        }
    });
}

function getAreasList(cityid,defaultId,fla) {
    $("#areas").empty();
    data = "cityid="+cityid;
    $.ajax({
        url: ctx+"/c/areasList",
        type: "GET",
        data:data,
        dataType:'json',
        success:function(data){

            if(!defaultId&&fla){
                $("#areas").append(" <option value='0' selected='selected'> 不限</option>");
            }

            $.each(data.data.dataList,function(i,item){
                if(defaultId&&item.areaid == defaultId ){
                    $("#areas").append(" <option value='" + item.areaid + "'   selected='selected'> " + item.area + "</option>");
                }else{
                    $("#areas").append(" <option value='" + item.areaid + "' > " + item.area + "</option>");
                }

            });


        }
    });
}