<?php  
/**
 * 后台菜单列表
 *
 */
 
$menu = array (
  1 => 
  array (
    'id' => '1',
    'name' => '后台菜单',
    'pid' => '',
    'path' => '1|',
    'dept' => '',
    'controller_name' => 'manage',
    'action_name' => 'menu_all',
    'urlpath' => '',
    'allow' => 'r1',
  ),
  2 => 
  array (
    'id' => '2',
    'name' => '系统管理',
    'pid' => '1',
    'path' => '1|2|',
    'dept' => '3',
    'controller_name' => '',
    'action_name' => '',
    'urlpath' => '',
    'allow' => '',
  ),
);
return $menu;
?>
