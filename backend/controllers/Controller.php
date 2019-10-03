<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/11/2019
 * Time: 4:49 PM
 */

class Controller
{
    public function my_money_format($num)
    {
        $money = explode('.', $num);


        if (strlen($money[0]) == 0)
            $money[0] = '0';
        if (strlen($money[0]) > 2) {
            $taka = $money[0];
            $thousand = substr($taka, -3);
            $taka = substr($taka, 0, strlen($taka) - 3);
            $i = 0;
            while (strlen($taka) > 0) {
                if (strlen($taka) > 1) {
                    $pp[$i] = substr($taka, -2);
                    $taka = substr($taka, 0, strlen($taka) - 2);
                } else {
                    $pp[$i] = substr($taka, -1);
                    $taka = substr($taka, 0, strlen($taka) - 1);
                }
                $i++;
            }
            $taka_add='';
            for ($j = sizeof($pp) - 1; $j >= 0; $j--)
                $taka_add .= $pp[$j] . ',';
            return $taka_add . $thousand;
        } else
            return $money[0];
    }

}