<?php
getFile("http://easyread.ph.126.net/N8gDl6ayo5wLgKbgT21NZQ==/7917056565549478184.jpg");
/**
* php实现下载远程图片保存到本地
**
* $url 图片所在地址
* $path 保存图片的路径
* $filename 图片自定义命名
* $type 使用什么方式下载 
* 0:curl方式,1:readfile方式,2file_get_contents方式
*
* return 文件名
*/
function getFile($url,$path='',$filename='',$type=0){
    if($url==''){return false;}
    //获取远程文件数据
    if($type===0){
        $ch=curl_init();
        $timeout=5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);//最长执行时间
        curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);//最长等待时间
        
        $img=curl_exec($ch);
        curl_close($ch);
    }
    if($type===1){
        ob_start(); 
        readfile($url);
        $img=ob_get_contents(); 
        ob_end_clean(); 
    }
    if($type===2){
        $img=file_get_contents($url);
    }
    //判断下载的数据 是否为空 下载超时问题
    if(empty($img)){
        throw new \Exception("下载错误,无法获取下载文件！");
    }
    
    //没有指定路径则默认当前路径
    if($path===''){
        $path="./";
    }
    //如果命名为空
    if($filename===""){
        $filename=md5($img);
    }
    //获取后缀名
    $ext=substr($url, strrpos($url, '.'));
    if($ext && strlen($ext)<5){
        $filename.=$ext;
    }
    
    //防止"/"没有添加
    $path=rtrim($path,"/")."/";
    //var_dump($path.$filename);die();
    $fp2=@fopen($path.$filename,'a');

    fwrite($fp2,$img);
    fclose($fp2);
    //echo "finish";
    return $filename;
}
?>