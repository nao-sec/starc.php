<?php

$input = file_get_contents('php://input');
$input = json_decode($input, true);

if (!isset($input['vm_name'])) {
    // エラー処理
}
$vm_name = $input['vm_name'];

if (!isset($input['id'])) {
    // エラー処理
}
$id = $input['id'];

exec('vboxmanage controlvm ' . $vm_name . ' poweroff', $out, $ret);
