<?php

namespace app\data\controller;

use think\admin\Controller;

/**
 * 普通用户管理
 * Class User
 * @package app\data\controller
 */
class User extends Controller
{
    /**
     * 绑定数据表
     * @var string
     */
    private $table = 'DataUser';

    /**
     * 普通用户管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '普通用户管理';
        $query = $this->_query($this->table);
        $query->like('phone,username|nickname#username');
        $query->whereRaw('nickname != "" or username != ""');
        $query->order('id desc')->equal('status')->dateBetween('create_at')->page();
    }

    /**
     * 修改用户状态
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function state()
    {
        $this->_save($this->table, $this->_vali([
            'status.in:0,1'  => '状态值范围异常！',
            'status.require' => '状态值不能为空！',
        ]));
    }

}