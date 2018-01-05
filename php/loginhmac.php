<?php 

class itcastUsers {
    // 用户登录
    function userLogin() {
    	if (isset($_GET['username']) && isset($_GET['password'])) {
    		// 获取GET请求参数
			$accessType = '[GET]';
			$userName = $_GET['username'];
			$userPassword = $_GET['password'];
		} else if (isset($_POST['username']) && isset($_POST['password'])) {
			// 获取POST请求参数
			$accessType = '[POST]';
			$userName = $_POST['username'];
			$userPassword = $_POST['password'];
		} else {
			echo('非法请求。');
			return false;
		}
        
        // 服务器记录的密码itcast
        $hmacKey = '8a627a4578ace384017c997f12d68b23';
        $recordPwd = hash_hmac('md5', 'zhang', $hmacKey);
        // 取出当前系统时间
        date_default_timezone_set('Asia/Shanghai');
        $now = time();
        $pre = $now - 60;
        $nowStr = date('Y-m-d H:i', $now);
        $preStr = date('Y-m-d H:i', $pre);
        $hmacPwd1 = hash_hmac('md5', $recordPwd . $nowStr, $hmacKey);
        $hmacPwd2 = hash_hmac('md5', $recordPwd . $preStr, $hmacKey);
        
        if ($userName == 'zhangsan' && ($userPassword == $hmacPwd1 || $userPassword == $hmacPwd2)) {
            // 将查询结果绑定到数据字典
            $result = array(
                            'userId' => 1,
                            'userName' => '张三'
                            );
            // 将数据字典使用JSON编码
            echo json_encode($result);
        } else {
            $result = array(
                            'userId' => 0,
                            'userName' => ''
                            );

            echo json_encode($result);
        }
        
		return true;
    }
}

header('Content-Type:application/json;charset=utf-8');
$itcast = new itcastUsers;
$itcast->userLogin();
?>
