<?php
/**
 * Project: api.com
 * User: xialeistudio
 * Date: 2016/11/23 0023
 * Time: 22:11
 */
require __DIR__ . '/../lib/Article.php';
require __DIR__ . '/../lib/User.php';

class Server
{
    /**
     * 用户管理对象
     * @var User
     */
    private $_user;
    /**
     * 文章管理对象
     * @var Article
     */
    private $_article;

    /**
     * 构造方法
     * Server constructor.
     */
    public function __construct()
    {
        $pdo = require __DIR__ . '/../lib/db.php';
        $this->_user = new User($pdo);
        $this->_article = new Article($pdo);
    }

    /**
     * 返回JSON
     * @param array $data
     * @return string
     */
    private function _json(array $data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 用户注册
     * @param $username
     * @param $password
     * @return array
     */
    public function userRegister($username, $password)
    {
        try {
            $this->_user->register($username, $password);
            return $this->_json(['message' => '注册成功', 'code' => 0]);
        } catch (Exception $e) {
            return $this->_json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * 创建文章
     * @param $title
     * @param $content
     * @return string
     */
    public function articleCreate($title, $content)
    {
        $user = $this->_login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

        try {
            $article = $this->_article->create($title, $content, $user['userId']);
            return $this->_json($article);
        } catch (Exception $e) {
            return $this->_json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * 文章编辑
     * @param $articleId
     * @param $title
     * @param $content
     * @return string
     */
    public function articleEdit($articleId, $title, $content)
    {
        $user = $this->_login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

        try {
            $article = $this->_article->edit($articleId, $title, $content, $user['userId']);
            return $this->_json($article);
        } catch (Exception $e) {
            return $this->_json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * 删除文章
     * @param $articleId
     * @return string
     */
    public function articleDelete($articleId)
    {
        $user = $this->_login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

        try {
            $this->_article->delete($articleId, $user['userId']);
            return $this->_json(['message' => '删除成功', 'code' => 0]);
        } catch (Exception $e) {
            return $this->_json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * 文章查询
     * @param $articleId
     * @return string
     */
    public function articleView($articleId)
    {
        try {
            $article = $this->_article->view($articleId);
            return $this->_json($article);
        } catch (Exception $e) {
            return $this->_json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * 文章列表
     * @param int $page
     * @param int $size
     * @return string
     */
    public function articleList($page = 1, $size = 10)
    {
        $user = $this->_login($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
        try {
            $list = $this->_article->getList($user['userId'], $page, $size);
            return $this->_json(['list' => $list, 'code' => 0]);
        } catch (Exception $e) {
            return $this->_json(['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * 用户登录
     * @param $PHP_AUTH_USER
     * @param $PHP_AUTH_PW
     * @return mixed
     */
    private function _login($PHP_AUTH_USER, $PHP_AUTH_PW)
    {
        return $this->_user->login($PHP_AUTH_USER, $PHP_AUTH_PW);
    }
}

$server = new SoapServer(null, [
    'uri' => 'api'
]);
$server->setClass(Server::class);
$server->handle();