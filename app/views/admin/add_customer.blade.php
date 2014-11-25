@extends('layouts.admin')

@section('content')
	<div>
		填写新顾客的基本信息:
	</div>

	{{ Form::open(array('url' => 'customers/addcustomer')) }}
		<div class="control-group">
			<label class="control-label" for="last_name" >姓 :</label>
			<div class="controls">
				<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="first_name" >名 :</label>
			<div class="controls">
				<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email" >邮箱 :</label>
			<div class="controls">
				<input type="text" name="email" id="email" value="{{ Input::old('email') }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="password" >密码 :</label>
			<div class="controls">
				<input type="password" name="password" id="password" value="{{ Input::old('password') }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="password" >确认密码 :</label>
			<div class="controls">
				<input type="password" name="password_confirmation" id="password_confirmation" value="{{ Input::old('password_confirmation') }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="phone" >电话号码 :</label>
			<div class="controls">
				<input type="text" name="phone" id="phone" value="{{ Input::old('phone') }}" placeholder="">
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">保存</button>
			<a class="btn btn-primary" href="{{ URL::to('customers') }}">取消</a>
		</div>
	{{ Form::close() }}
@stop