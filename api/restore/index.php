<?php

$input = file_get_contents('php://input');
$input = json_decode($input, true);

if (!isset($input['vm_name'])) {
    // エラー処理
}
$vm_name = $input['vm_name'];

if (!isset($input['snapshot'])) {
    // エラー処理
}
$snapshot = $input['snapshot'];

if (!isset($input['id'])) {
    // エラー処理
}
$id = $input['id'];

exec('vboxmanage snapshot ' . $vm_name . " restore " . $snapshot_name, $out, $ret);
