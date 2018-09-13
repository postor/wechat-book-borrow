<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Json;

yii\web\JqueryAsset::register($this)

?>
<h1>test/index</h1>
<button id="upload">上传图片</button>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
    wx.config(<?=  Json::encode(\Yii::$app->wechat->jsApiConfig([],true))?>);
    $(document).ready(function(){
        $('#upload').click(function () {
            wx.chooseImage({
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    for(var i=0;i<localIds.length;i++){
                        wx.uploadImage({
                            localId: localIds[i], // 需要上传的图片的本地ID，由chooseImage接口获得
                            isShowProgressTips: 1, // 默认为1，显示进度提示
                            success: function (res) {
                                var serverId = res.serverId; // 返回图片的服务器端ID
                                alert('上传成功：'+serverId)
                            }
                        });
                    }
                }
            });
        })
    })
</script>