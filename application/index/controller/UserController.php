<?php
namespace app\index\controller;

use app\index\model\User;
use think\Request;

class UserController
{
	// 新增用户数据
	// public function add()
	// {
	// 	$user = new User;
	// 	$user->nickname = '流年';
	// 	$user->email = 'thinkphp@qq.com';
	// 	$user->birthday = strtotime('1977-03-05');
	// 	if ($user->save()) {
	// 		return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
	// 	} else {
	// 		return $user->getError();
	// 	}
	// }
	public function add(Request $request)
	{
		$user = new User;
		$user->nickname = $request->post('nickname');
		$user->email = $request->post('email');
		$user->birthday = strtotime($request->post('birthday'));
		if ($user->save()) {
			return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
		} else {
			return $user->getError();
		}
	}

	// 新增用户数据
	public function adddd()
	{
		$user['nickname'] = '看云';
		$user['email'] = 'kancloud@qq.com';
		$user['birthday'] = strtotime('2015-04-02');
		if ($result = User::create($user)) {
			return '用户[ ' . $result->nickname . ':' . $result->id . ' ]新增成功';
		} else {
			return '新增出错';
		}
	}

	// 批量新增用户数据
	//因为addList中是大写的L，所以请使用http://aajz.cn/user/add_list来执行该方法
	public function addList()
	{
		$user = new User;
		$list = [
			['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1988-01-15')],
			['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-09-19')],
		];
		if ($user->saveAll($list)) {
			return '用户批量新增成功';
		} else {
			return $user->getError();
		}
	}


	// 读取用户数据
	public function read($id='')
	{
		$user = User::get($id);
		echo $user->nickname . '<br/>';
		echo $user->email . '<br/>';
		//因为模型里面应用了读取器，所以不用在这里转换日期显示的数据格式了
		// echo date('Y/m/d', $user->birthday) . '<br/>';
		echo $user->birthday . '<br/>';
	}


	// 获取用户数据列表
	public function index()
	{
		$list = User::all();
		foreach ($list as $user) {
			echo $user->id . '<br/>';
			echo $user->nickname . '<br/>';
			echo $user->email . '<br/>';
			//因为模型里面应用了读取器，所以不用在这里转换日期显示的数据格式了
			// echo date('Y/m/d', $user->birthday) . '<br/>';
			echo $user->birthday . '<br/>';
			echo '----------------------------------<br/>';
		}
	}

	// 更新用户数据
	public function update($id)
	{
		$user['id'] = (int) $id;
		$user['nickname'] = '刘晨';
		$user['email'] = 'liu21st@gmail.com';
		User::update($user);
		return '更新用户成功';
	}

	// // 删除用户数据
	// public function delete($id)
	// {
	// 	$user = User::get($id);
	// 	if ($user) {
	// 		$user->delete();
	// 		return '删除用户成功';
	// 	} else {
	// 		return '删除的用户不存在';
	// 	}
	// }

	// 删除用户数据
	public function delete($id)
	{
		$result = User::destroy($id);
		if ($result) {
			return '删除用户成功';
		} else {
			return '删除的用户不存在';
		}
	}
}