<?php

class AdminController extends BaseController
{
	public function getLogin()
	{
		if(Sentry::check())
		{
			$customers = User::where('usertype', "=", 1)
						 ->paginate(10);
			return View::make('admin.manage_users')->with('title','伊绰美容 - 管理员登录')
											   ->with('page_title', '管理顾客信息')
											   ->with('customers', $customers);
		}
		else
		{
			return View::make('admin.login')->with('title', '伊绰美容 - 管理员登录');
		}
		
	}

	public function postLogin()
	{
		$rules = array(
			'email' => 'required',
			'password' => 'required',
		);

		$credentials = array(
			'email' => Input::get('username'),
			'password' => Input::get('password'),
		);

		$validation = Validator::make($credentials, $rules);

		if ($validation->fails())
		{
			return Redirect::to('admin/login')->withErrors($validation)
											  ->withInput()
											  ->with("title", "伊绰美容 - 管理员登录");
		}

		try
		{
			$credentials = array(
				'email' => Input::get('username'),
				'password' => Input::get('password'),
			);

			$user = Sentry::authenticate($credentials, false);

			if(Sentry::check())
			{
				$admin = Sentry::findGroupByName('Administration');

				if($user->inGroup($admin))
				{
					return Redirect::to('customers');
				}
			}
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'Login field is required.'));
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'Password field is required.'));
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'Wrong password, try again.'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User was not found.'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User is not activated.'));
		}

		// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User is suspended.'));
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User is banned.'));
		}
	}

	public function getIndex()
	{
		if(Sentry::check())
		{
			$customers = User::where('usertype', "=", 1)
						 ->paginate(10);
			return View::make('admin.manage_users')->with('title','伊绰美容 - 管理员登录')
											   ->with('page_title', '管理顾客信息')
											   ->with('customers', $customers);
		}
		else
		{
			return View::make('admin.login')->with('title', '伊绰美容 - 管理员登录');
		}

	}

	public function getManageusers()
	{
		
	}

	public function getLogout()
	{
		if(Sentry::check())
		{
			Sentry::logout();
			return Redirect::to('admin/login')->with('title', '伊绰美容 - 管理员登录');
		}

		return Redirect::to('admin/login')->with('title', '伊绰美容 - 管理员登录');
		
	}



}