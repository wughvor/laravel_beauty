<?php

class EmployeeController extends BaseController
{
	public function getIndex()
	{
		$employees = User::where('usertype', '=', 2)
						  ->paginate(10);

		return View::make('admin.manage_employee')->with('title', '伊绰美容 - 管理员登录')
												  ->with('page_title', '管理员工信息')
												  ->with('employees', $employees);
	}

	public function getAddemployee()
	{
		return View::make('admin.add_employee')->with('title', '伊绰美容 - 管理员登录')
											   ->with('page_title', '增加新员工信息');
	}

	public function postAddemployee()
	{
		$rules = array(
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
		);

		$input = Input::get();
		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('employee/addemployee')->withInput()
													   ->withErrors($validation);
		}

		$employee = Sentry::createUser(array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'usertype' => 2,
			'activated' => true,
		));

		$employee->first_name = Input::get('first_name');
		$employee->last_name = Input::get('last_name');
		$employee->phone = Input::get('phone');

		$employee->update();

		return Redirect::to('employee/index')->with('success', '新员工信息已添加！！');
	}

	public function getEditemployee($id)
	{
		$employee = User::find($id);

		return View::make('admin.edit_employee')->with('title', '伊绰美容 - 管理员页面')
												->with('page_title', '编辑员工信息')
												->with('employee', $employee);
	}

	public function postEditemployee()
	{
		try
		{
			$employee = Sentry::findUserById(Input::get('id'));

			if(Input::get('password') != '')
			{
				$employee->password = Input::get('password');
			}

			$employee->first_name = Input::get('first_name');
			$employee->last_name = Input::get('last_name');

			if($employee->save())
			{
				return Redirect::to('employee/index')->with('success', '员工信息已更新成功！！');
			}
			else
			{
				return Redirect::to('employee/index')->with('error', '员工信息更新失败！！');
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('employee/index')->with('error','找不到该员工的信息');
		}
	}

	public function getDelete($id=null)
	{
		try
		{
			$employee = Sentry::findUserById($id);
			$delete = $employee->delete();

			if($delete)
			{
				return Redirect::to('employee/index')->with('success', '该员工信息已被删除！！');
			}
			else
			{
				return Redirect::to('employee/index')->with('error', '员工信息删除失败，确认无误后请再次删除！！');
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('users/index')->with('error','找不到该员工的信息');
		}
	}

	public function getBlock($id=null)
	{
		try
		{
			$throttle = Sentry::findThrottlerByUserId($id);
			$throttle->Ban();

			$employee = Sentry::findUserById($id);
			$employee->activated = false;
			$employee->update();

			return Redirect::to('employee/index')->with('success', '该员工账号已经被禁用！！');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('employee/index')->with('error','禁用该员工的操作失败！！');
		}
	}

	public function getActive($id=null)
	{
		try
		{
			$throttle = Sentry::findThrottlerByUserId($id);
			$throttle->unBan();

			$employee = Sentry::findUserById($id);
			$employee->activated = true;
			$employee->update();

			return Redirect::to('employee/index')->with('success', '该员工账号已经被启用！！');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('employee/index')->with('error','启用该员工的操作失败！！');
		}
	}
}