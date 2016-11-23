<?php
/**
 * 连接数据库并返回数据库连接句柄
 * Project: api.com
 * User: xialeistudio
 * Date: 2016/11/23 0023
 * Time: 21:15
 */
$pdo = new PDO('mysql:host=localhost;dbname=restful', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
return $pdo;