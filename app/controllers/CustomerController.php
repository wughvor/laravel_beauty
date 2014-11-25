<?php

class CustomerController extends BaseController
{
	public function getIndex()
	{
		$customers = User::where('usertype', "=", 1)
						 ->paginate(10);

		return View::make('admin.manage_users')->with('title','伊绰美容 - 管理员登录')
											   ->with('page_title', '管理顾客信息')
											   ->with('customers', $customers);
	}

	public function getAddcustomer()
	{
		return View::make('admin.add_customer')->with('title', '伊绰美容 - 管理员页面')
										       ->with('page_title', '增加新顾客信息');
	}

	public function postAddcustomer()
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
			return Redirect::to('customers/addcustomer')->withInput()
													   ->withErrors($validation);
		}

		$customer = Sentry::createUser(array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'usertype' => 1,
			'activated' => true,
		));

		$customer->first_name = Input::get('first_name');
		$customer->last_name = Input::get('last_name');
		$customer->phone = Input::get('phone');

		$customer->update();

		return Redirect::to('customers/index')->with('success', '新顾客信息已添加！！');

	}

	public function getEditcustomer($id)
	{
		$customer = User::find($id);

		return View::make('admin.edit_customer')->with('title', '伊绰美容 - 管理员页面')
												->with('page_title', '编辑顾客信息')
												->with('customer', $customer);
	}

	public function postEditcustomer()
	{
		try
		{
			$customer = Sentry::findUserById(Input::get('id'));

			if(Input::get('password') != '')
			{
				$customer->password = Input::get('password');
			}

			$customer->first_name = Input::get('first_name');
			$customer->last_name = Input::get('last_name');
			$customer->email = Input::get('email');
			$customer->phone = Input::get('phone');

			if($customer->save())
			{
				return Redirect::to('customers/index')->with('success', '顾客的信息已更新成功！！');
			}
			else
			{
				return Redirect::to('customers/index')->with('error', '顾客信息更新失败！！');
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('users/index')->with('error','找不到该顾客信息');
		}
	}

	public function getDelete($id=null)
	{
		try
		{
			$customer = Sentry::findUserById($id);
			$delete = $customer->delete();

			if($delete)
			{
				return Redirect::to('customers/index')->with('success', '顾客信息已经被删除！！');
			}
			else
			{
				return Redirect::to('customers/index')->with('error', '顾客信息删除失败，确认无误后请再次删除！！')
													  ->with('title', '伊绰美容 - 管理员页面');
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('customers/index')->with('error','找不到该顾客信息！！');
		}
	}

	public function getBlock($id=null)
	{
		try
		{
			$throttle = Sentry::findThrottlerByUserId($id);
			$throttle->Ban();

			$customer = Sentry::findUserById($id);
			$customer->activated = false;
			$customer->update();

			return Redirect::to('customers/index')->with('success', '该顾客账号已经被禁用！！');

		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('customers/index')->with('error','禁用该顾客的操作失败！！');
		}
	}

	public function getActive($id=null)
	{
		try
		{
			$throttle = Sentry::findThrottlerByUserId($id);
			$throttle->unBan();

			$customer = Sentry::findUserById($id);
			$customer->activated = true;
			$customer->update();

			return Redirect::to('customers/index')->with('success', '该顾客账号已经被启用！！');

		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	    {
	        return Redirect::to('users/index')->with('error','启用顾客账号失败！！');
	    }
	}

	public function getNurserecord($id=null)
	{
		$customer = User::find($id);
		$nurserecord = Customernurse::where('customer_id', '=', $id)->get();

		return View::make('admin.customer_nurse')->with('title', '伊绰美容 - 管理员页面')
												 ->with('page_title', '消费记录')
												 ->with('customer', $customer)
												 ->with('nurserecord', $nurserecord);
	}

	public function getAddnurserecord($id=null)
	{
		$customer = User::find($id);

		$nursesarray = array();
		$nurses = Nurse::all();

		$employeearray = array();
		$employee = User::all();

		foreach ($nurses as $value) {			
			$nursesarray[$value['id']] = $value['name'];
		
		}

		foreach ($employee as $value) {
			if($value->usertype == 2)
			{
				$employeearray[$value['id']] = $value['last_name'] . $value['first_name'];
			}
			
		}

		return View::make('admin.add_customer_nurse_record')->with('title', '伊绰美容 - 管理员页面')
													  ->with('page_title', '增加消费记录')
													  ->with('employee', $employeearray)
													  ->with('nurses', $nursesarray)
													  ->with('customer', $customer);
	}

	public function postAddnurserecord()
	{
		$customer_id = Input::get('customer_id');
		$nurse_id = Input::get('nurse_id');
		$employee_id = Input::get('employee_id');

		$customer = User::find($customer_id);
		$nurse = Nurse::find($nurse_id);
		$employee = User::find($employee_id);
		$employee_name = $employee->last_name . $employee->first_name;

		$customernurse = new Customernurse;

		$customernurse->customer_id = $customer_id;
		$customernurse->nurse_id = $nurse_id;
		$customernurse->employee_id = $employee_id;
		$customernurse->customer_name = $customer->last_name . $customer->first_name;
		$customernurse->nurse_name = $nurse->name;
		$customernurse->price = $nurse->price;
		$customernurse->employee_name = $employee_name;

		if($customernurse->save())
		{

			return Redirect::to('customers/nurserecord/' . $customer_id)->with('title', '伊绰美容 - 管理员页面')
																		->with('page_title', '消费记录')
																		->with('success', '添加消费成功！！');
		}
		else
		{
			//$nurserecord = Customernurse::where('customer_id', '=', $customer_id)->get();
			return Redirect::to('customers/nurserecord/' . $customer_id)->with('title', '伊绰美容 - 管理员页面')
																	    ->with('page_title', '消费记录')
																	    ->with('error', '添加消费记录失败，请再次操作！！');
																	    																	    
		}
	}

	public function getDeletenurserecord($id=null)
	{
		$customer_nurse_record = Customernurse::find($id);
		$customer_id = $customer_nurse_record->customer_id;
		$delete = $customer_nurse_record->delete();

		if($delete)
		{
			return Redirect::to('customers/nurserecord/' . $customer_id)->with('title', '伊绰美容 - 管理员页面')
																		->with('page_title', '消费记录')
																		->with('success', '删除消费记录成功！！');
		}
		else
		{
			return Redirect::to('customers/nurserecord/' . $customer_id)->with('title', '伊绰美容 - 管理员页面')
																	    ->with('page_title', '消费记录')
																	    ->with('error', '删除消费记录失败，请再次操作！！');
		}
	}

}