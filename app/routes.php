<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
Route::get('/', function()
{
	return View::make('hello');
});
*/

Route::get('/createadmingroup', function()
{
	try
	{
		// create the group
		$group = Sentry::createGroup(array(
			'name' => 'Administration',
			'permissions' => array(
				'read' => 1,
				'write' => 1,
			),
		));

		echo "Administration Group is Created";
	}
	catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
	{
	    echo 'Name field is required';
	}
	catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
	{
	    echo 'Group already exists';
	}
	
});

Route::get('/checkadmingroup', function()
{

	try
	{
	    $group = Sentry::findGroupByName('administration');
	    echo "Administration Group Exists";
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}

});

Route::get('/createadminuser', function()
{
	try
	{
		// Find the group using the group name
		$adminGroup = Sentry::findGroupByName("Administration");

		// Create the user
		$user = Sentry::createUser(array(
			'email' => 'wughvor@gmail.com',
			'password' => '123456',
			'activated' => true,
			'usertype' => 0,
			'phone'	=> '18676235683',
			'first_name' => '国海',
			'last_name' => '吴',
		));

		echo "Admin user is created<br>";

		$user->addGroup($adminGroup);

		echo "Admin user assigned to administration group";
	}
	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	{
	    echo 'Password field is required.';
	}
	catch (Cartalyst\Sentry\Users\UserExistsException $e)
	{
	    echo 'User with this login already exists.';
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}
});

Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@getIndex'));
Route::get('admin/login', array('as' => 'adminlogin', 'uses' => 'AdminController@getLogin'));
Route::post('admin/login', array('as' => 'adminlogin', 'uses' => 'AdminController@postLogin'));

Route::group(array('before' => 'administrationauth'), function()
{
	//Route::get('/', array('uses' => 'AdminController@getLogin'));
	Route::controller('admin', 'AdminController');
	Route::controller('customers', 'CustomerController');
	Route::controller('employee', 'EmployeeController');
	Route::controller('nurse', 'NurseController');
	Route::controller('revenue', 'RevenueController');
});

