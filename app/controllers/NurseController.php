<?php

class NurseController extends BaseController
{
	public function getIndex()
	{
		$nurses = Nurse::all();

		return View::make('admin.manage_nurse')->with('title', '伊绰美容 - 管理员登录')
											   ->with('page_title', '管理护理项目信息')
											   ->with('nurses', $nurses);
	}

	public function getAddnurse()
	{
		return View::make('admin.add_nurse')->with('title', '伊绰美容 - 管理员登录')
											->with('page_title', '增加护理项目信息');
	}

	public function postAddnurse()
	{
		$rules = array(
			'name' => 'required',
			'price' => 'required|numeric',
			'total' => 'required|integer|min:1'
		);

		$input = Input::get();
		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('nurse/addnurse')->withInput()
											 	 ->withErrors($validation);
		}

		$nurse = new Nurse;

		$nurse->name = Input::get('name');
		$nurse->price = Input::get('price');
		$nurse->total = Input::get('total');
		$nurse->info = Input::get('info');

		if($nurse->save())
		{
			return Redirect::to('nurse')->with('success', '新的护理项目信息已成功添加！！');
		}
		else
		{
			return Redirect::to('nurse/addnurse')->withErrors($nurse->errors)->withInput();
		}
	}

	public function getEditnurse($id)
	{
		$nurse = Nurse::find($id);

		return View::make('admin.edit_nurse')->with('title', '伊绰美容 - 管理员登录')
											 ->with('page_title', '编辑护理项目信息')
											 ->with('nurse', $nurse);

	}

	public function postEditnurse()
	{
		
		
		$rules = array(
			'name' => 'required',
			'price' => 'required|numeric',
			'total' => 'required|integer|min:1'
		);

		$input = Input::get();
		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('nurse/editnurse')->withInput()
											 	 	 ->withErrors($validation);
		}

		$nurse = Nurse::find(Input::get('id'));

		$nurse->name = Input::get('name');
		$nurse->price = Input::get('price');
		$nurse->total = Input::get('total');
		$nurse->info = Input::get('info');

		if($nurse->save())
		{
			return Redirect::to('nurse/index')->with('success', '护理项目信息已更新成功！！');
		}
		else
		{
			return Redirect::to('nurse/index')->with('error', '护理项目信息更新失败！！');
		}
		
	}

	public function getDelete($id=null)
	{
		$nurse = Nurse::find($id);
		$delete = $nurse->delete();

		if($delete)
		{
			return Redirect::to('nurse/index')->with('success', '该护理项目信息已被删除！！');
		}
		else
		{
			return Redirect::to('nurse/index')->with('error', '护理项目信息失败， 确认无误后请再次删除！！');
		}
	}
	
}