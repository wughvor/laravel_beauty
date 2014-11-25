<?php

class RevenueController extends BaseController
{
	public function getIndex()
	{
		$customernurse = Customernurse::all();

		return View::make('admin.manage_revenue')->with('title', '伊绰美容 - 管理员页面')
												 ->with('page_title', '消费记录')
												 ->with('customernurse', $customernurse);
	}

	public function getDelete($id = null)
	{
		$revenue = Customernurse::find($id);
		$delete = $revenue->delete();

		if($delete)
		{
			return Redirect::to('revenue')->with('title', '伊绰美容 - 管理员页面')
										  ->with('page_title', '消费记录')
										  ->with('success', '该消费记录已被删除！！');

		}
		else
		{
			return Redirect::to('revenue')->with('title', '伊绰美容 - 管理员页面')
										  ->with('page_title', '消费记录')
										  ->with('error', '该消费记录删除失败，请再次进行操作！！');
		}
	}
}