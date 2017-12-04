<?php
class common{
//    @param int $code 错误码
//    @param string $message 提示信息
//    @param string $返回json处理结果
//    @param array $data 返回数据     
    public function  json($code,$message,$data){
        $code = (int)$code;
        $message = (string)$message;
        $data =(array)$data;
        $result = array(
            "code"=>$code,
            "message"=>$message,
            "data"=>$data
        );
        return json_encode($result);
    }
}
