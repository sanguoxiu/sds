<?php
function hash_value ($str) {  //将字符串转换成md5，交给num_format函数处理
    $str_md5 = md5 ($str);  //首先获得md5
    $str_num = num_format ($str_md5);  //使用num_format函数进行处理
    return $str_num;  //返回结果
}
function num_format ($str) {  //num_format函数是将检查num_plus的结果是几位数，若不是1位数，则循环使用num_plus处理。
    $num_plus  =num_plus ($str);  //直接使用num_plus相加函数处理md5
    while( $num_plus >9 ) {  //如果结果大于9，循环处理，直到结果小于9
        $num_plus  =num_plus ($num_plus);  //交给num_plus函数循环处理
    }
    return $num_plus;  //结果返回到主函数
}
function num_plus ($str) {  //num_format相加函数,可以将1-f共16个字符串转成数字，然后按位想加，返回结果
    $num = array('1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8,'9' => 9,'0' => 10,'a' => 11,'b' => 12,'c' => 13,'d' => 14,'e' => 15,'f' => 16,);  //将字符定义成数字
    $lengh = strlen($str);  //计算md5字符串的长度
    for ($i=0; $i<$lengh; $i++){ //此处for循环是将md5字符串转换成数字想加
        $str = strval($str); //第二次调用时，将int转换成str
        $explode_str = $str[$i];  //将md5字符串分解
        $num_format = $num[$explode_str];  //将分解后的字符串转换成数字
        $num_plus += $num_format;  //结果相加
    }
    return $num_plus;  //返回想加结果
}