<?php
    // 取出当前系统时间
    date_default_timezone_set('Asia/Shanghai');
    $now = time();
    $nowStr = date('Y-m-d H:i', $now);
    
    $result = array(
                    'key' => $nowStr
                    );
    
    echo json_encode($result);
?>
