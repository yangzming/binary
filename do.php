<?php
/**
 * Created by WHEREIN.
 * User: yzm
 * Date: 2018/2/26
 * Time: 18:20
 */

$result = turnTo($_POST['keyword']);
show_josn($result);

function turnTo($keyword, $turn_type = 'decbin') {
    $result = '';
    if (empty($keyword)) {
        return '';
    }
    $keyword = htmlspecialchars(trim($keyword));
    if (is_numeric($keyword)) {
        // 是数字直接转为二进制
        $result = decbin($keyword);
    } else {
        $key_arr = explode(' ', $keyword);
        $list = array();
        foreach ($key_arr as $key => $val) {
            $val_arr = str_split($val); // 切割字符串
            if (!empty($val_arr)) {
                foreach ($val_arr as $key1 => $val1) {
                    if (!is_numeric($val1)) {
                        $val1 = ord($val1);
                    }
                    $val_arr[$key1] = decbin($val1);
                    $val_str = implode('_', $val_arr);
                }
                $list[] = $val_str;
            }
        }
        $result = !empty($list) ? implode(' ', $list) : '';
    }
    return $result;
}

function show_josn($param) {
    header('Content-Type:application/json; charset=utf-8');
    $data = json_encode($param);
    exit($data);
}
function p() {
    $getArgs = func_get_args();
    if (in_array(end($getArgs), ['y', 'n'])) {
        $is_exit = end($getArgs);
        array_pop($getArgs);
    } else {
        $is_exit = 'y';
    }
    foreach ($getArgs as $key => $val) {
        echo '<pre>';
        var_dump($val);
    }
    if ($is_exit === 'y') {
        exit;
    }
}