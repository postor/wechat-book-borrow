<?php
/* @var $this yii\web\View */

use yii\helpers\Json;

$this->registerAssetBundle(yii\web\JqueryAsset::className(), yii\web\View::POS_HEAD);
?>
<h1>test/index</h1>
<button id="upload">上传图片</button>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
    window.onerror=(err)=>alert(JSON.stringify(err))
    wx.config(<?=  Json::encode(\Yii::$app->wechat->jsApiConfig([],true))?>);
    $(document).ready(function(){
        $('#upload').click(function () {
            wx.chooseImage({
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    Promise.all(localIds.map((localId)=>{
                        return uploadLocalId(localId).then((serverId)=>{
                            return serverLoadMedia(serverId).then((obj)=>{
                                alert(JSON.stringify(obj))
                                return obj
                            })
                        })
                    })).then(()=>{
                        alert('all done!')
                    })

                }
            });
        })
    })

    function uploadLocalId(localId){
        return new Promise((resolve,reject)=>{
            wx.uploadImage({
                localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
                isShowProgressTips: 1, // 默认为1，显示进度提示
                success: function (res) {
                    var serverId = res.serverId; // 返回图片的服务器端ID
                    alert('上传成功：'+serverId)
                    resolve(serverId)
                }
            });
        })
    }

    function serverLoadMedia(serverId){
        return $.getJSON('/?r=test/media&id='+serverId)
    }
</script>