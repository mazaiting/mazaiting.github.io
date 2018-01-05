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
        
        if ($userName == 'zhangsan' && $userPassword == 'zhang') {
            // 将查询结果绑定到数据字典
            $result = array(
                            'userId' => 1,
                            'userName' => $userName,
                            'type' => $accessType
                            );
            // 将数据字典使用JSON编码
            echo json_encode($result);
        } else {
            $result = array(
                            'userId' => -1,
                            'userName' => $userName,
                            'type' => $accessType
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
