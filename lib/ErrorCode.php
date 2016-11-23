<?php

/**
 * Project: api.com
 * User: xialeistudio
 * Date: 2016/11/23 0023
 * Time: 21:26
 */
class ErrorCode
{
    const USERNAME_EXISTS = 1;//用户名已存在
    const PASSWORD_CANNOT_EMPTY = 2;//密码不能为空
    const USERNAME_CANNOT_EMPTY = 3;//用户名不能为空
    const REGISTER_FAIL = 4;//用户注册失败
    const USERNAME_OR_PASSWORD_INVALID = 5;//用户名或密码错误
    //文章标题不能为空
    const ARTICLE_TILE_CANNOT_EMPTY = 6;
    //文章内容不能为空
    const ARTICLE_CONTENT_CANNOT_EMPTY = 7;
    //发表文章失败
    const ARTICLE_CREATE_FAIL = 8;
    //文章ID不能为空
    const ARTICLE_ID_CANNOT_EMPTY = 9;
    //文章不存在
    const ARTICLE_NOT_FOUND = 10;
    //无权操作
    const PERMISSION_DENIED = 11;
    //文章编辑失败
    const ARTICLE_EDIT_FAIL = 12;
    //文章删除失败
    const ARTICLE_DELETE_FAIL = 13;
    //分页大小太大
    const PAGE_SIZE_TO_BIG = 14;
    //服务器内部错误
    const SERVER_INTERNAL_ERROR = 15;
}