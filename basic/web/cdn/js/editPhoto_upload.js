$(function () {
    Array.prototype.remove = function(val) {
        var index = this.indexOf(val);
        if (index > -1) {
            this.splice(index, 1);
        }
    };
// 实例化
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: false,
        // swf文件路径
        swf: '${ctx}/webuploader/dist/Uploader.swf',
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        method:'POST',
        duplicate:true,
    });
    // 所有文件的进度信息，key为file id
   var percentages = {};
    var URL = window.URL || window.webkitURL;

    var uploadedImageType = 'image/jpeg';


    function ImageData(imageId,imageOrgName,imageName,isFinish){
        this.imageId = imageId;
        this.imageOrgName = imageOrgName;
        this.imageName = imageName;
        this.isFinish = isFinish;
    }


    var imageArray =[];


    // Import image
    var $inputImage = $('#myfile');

    $("i.photo-delete").click(function () {

        id = $(this).attr("photo-id");
        fla = $(this).attr("fla");

        var deleteIndex;
        $.each(imageArray, function(i, value) {
            if(id == this.imageId){
                deleteIndex = value;

            }
        });
        editPhoto(id,'delete');
        imageArray.remove(deleteIndex);
        imgs=""

        if(fla == 'exist'){
            imgs = $("#deletePhoto").val();
            if(imgs==""){
                imgs = id;
            }else{
                imgs = imgs +","+id;
            }
            $("#deletePhoto").val(imgs);
        }else{
            $.each(imageArray, function(i, value) {
                if(i==0){
                    imgs = this.imageName;
                }else{
                    imgs = imgs+","+this.imageName;
                }
            });

            $("#addPhoto").val(imgs);
        }

        $(this).parent().parent().remove();


    });


    uploader.onFileQueued = function (file) {

        uploadedImageURL = URL.createObjectURL(file.source.source);
        tempHtml = $("#photoItem").html().toString();
        tempHtml = $("#photoItem").html().toString();
        tempHtml = tempHtml.replace("#photo-id",file.id);
        tempHtml = tempHtml.replace("#progressId",file.id);

        tempHtml = tempHtml.replace("#src",uploadedImageURL);
        fileName = file.name;
        $("#photoDiv").append(tempHtml);


        $("i.photo-delete").click(function () {

            id = $(this).attr("photo-id");
            fla = $(this).attr("fla");

            var deleteIndex;
            $.each(imageArray, function(i, value) {
                if(id == this.imageId){
                    deleteIndex = value;

                }
            });
            imageArray.remove(deleteIndex);
            editPhoto(deleteIndex,'delete');
            imgs=""

            if(fla == 'exist'){
                imgs = $("#deletePhoto").val();
                if(imgs==""){
                    imgs = id;
                }else{
                    imgs = imgs +","+id;
                }
            }else{
                $.each(imageArray, function(i, value) {
                    if(i==0){
                        imgs = this.imageName;
                    }else{
                        imgs = imgs+","+this.imageName;
                    }
                });

                $("#addPhoto").val(imgs);
            }

            $(this).parent().parent().remove();


        });

    };


    uploader.on('uploadSuccess', function(file, json){

        $.each(imageArray, function(i, value) {
            if(file.id == this.imageId){
                this.isFinish = true;
                imgs = $("#addPhoto").val();
                editPhoto(this.imageName,'add');
                if(imgs.length<=0){
                    imgs = this.imageName;
                }else{
                    imgs = imgs + "," + this.imageName;
                }
                $("#addPhoto").val(imgs);
                console.log(imgs);
            }
        });

    });

    uploader.onUploadProgress = function (file, percentage) {
        var $li = $('#' + file.id),
            $percent = $li.find('.aui-progress-bar');

        $percent.css('width', percentage * 100 + '%');

    };





    function editPhoto(imgPath,keyWord) {
        //获取签名数据并上传图片

        data = "imgPath="+imgPath+"&keyWord="+keyWord;
        $.ajax({
            url: editPhotoUrl,
            type: "POST",
            data:data,
            success: function (kyData) {

            }
        });
    }


    if (URL) {
        $inputImage.change(function () {
            var files = this.files;

            $.each(files,function (index, file) {

                if (/^image\/\w+$/.test(file.type)) {
                    uploadedImageType = file.type;
                    uploader.addFile(file);

                } else {
                    msg("请选择图片文件");
                    return;
                }
                });

            $inputImage.val('');
            uploader.upload();
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }




    uploader.on('uploadBeforeSend', function (obj, data, headers) {

        var suffix = get_suffix(data.name);
        var random_name = random_string();
        data.key=uploader.options.formData.dir + "/" + random_name + suffix;
        //生成image对象
        imageData = new ImageData();
        imageData.imageId = data.id;
        imageData.isFinish=false;
        imageData.imageOrgName=data.name;
        imageData.imageName =data.key;
        imageArray.push(imageData);

    });




    $.ajax({
        url: oss_policy_url,
        type: "GET",
        success: function (kyData) {
            uploader.options.server = kyData.action;
            uploader.options.formData.policy=kyData.policy;
            uploader.options.formData.signature=kyData.signature;
            uploader.options.formData.action=kyData.action;
            uploader.options.formData.dir=kyData.dir;
            uploader.options.formData.OSSAccessKeyId=kyData.OSSAccessKeyId;
            uploader.options.formData.callback=kyData.callback;
        }
    });





    var dialog = new auiDialog();
    function msg(msg) {
        dialog.alert({
            title:"提示",
            msg:msg,
            buttons:['确定']
        },function(ret){
            // console.log(ret)
        })
    }


    // 根据路径获取后缀
    function get_suffix(filename) {
        var pos = filename.lastIndexOf('.');
        var suffix = '';
        if (pos != -1) {
            suffix = filename.substring(pos);
        }
        return suffix;
    }
    // 随机字符串
    function random_string(len) {
        len = len || 32;
        var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var maxPos = chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    }


});

