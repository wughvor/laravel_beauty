@extends('layouts.admin')

@section('content')
<div>
编辑顾客信息：
</div>
<div class="span12 dcontent">
	{{ Form::open(array('to' => 'customer/editcustomer')) }}

		<input type="hidden" name="id" value="{{ $customer['id'] }}">
		<div class="control-group">
			<label class="control-label" for="last_name">姓 :</label>
			<div class="controls">
				<input type="text" name="last_name" id="last_name" value= "{{ $customer->last_name }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="first_name">名 :</label>
			<div class="controls">
				<input type="text" name="first_name" id="first_name" value= "{{ $customer->first_name }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email">邮箱 :</label>
			<div class="controls">
				<input type="text" name="email" id="email" value= "{{ $customer->email }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="password">密码 :</label>
			<div class="controls">
				<input type="text" name="password" id="password" value= "" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="phone">电话 :</label>
			<div class="controls">
				<input type="text" name="phone" id="phone" value= "{{ $customer->phone }}" placeholder="">
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">更新</button>
			<a class="btn btn-primary" href="{{ URL::to('customers') }}">取消</a>
		</div>

	{{ Form::close() }}
</div>

@stop