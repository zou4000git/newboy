<?php

/**
 * 登录用来保存cookie
 *
 * 类的详细介绍（可选）
 * @author  4000
 * @version
 * @date  2018-03-01 20:46:21
 */

class Login
{

    public function set($n)
    {
        $sql = "select * from nb_manager where name = '{$n}'";
        $command = Yii::app()->db->createCommand($sql)->queryRow();
        if ($command) {
            unset($command['pwd']);
            //session_start();

            //$_COOKIE['userInfo'] = $command;

            setcookie("userInfo", serialize($command), time() + 3600 * 24);

        }
    }
}
