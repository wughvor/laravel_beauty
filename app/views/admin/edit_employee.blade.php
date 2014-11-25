@extends('layouts.admin')

@section('content')

<div>
编辑员工信息：
</div>

<div class="span12 dcontent">
	{{ Form::open(array('to' => 'employee/editemployee')) }}

		<input type="hidden" name="id" value="{{ $employee['id'] }}">
		<div class="control-group">
			<label class="control-label" for="last_name">姓 :</label>
			<div class="controls">
				<input type="text" name="last_name" id="last_name" value= "{{ $employee->last_name }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="first_name">名 :</label>
			<div class="controls">
				<input type="text" name="first_name" id="first_name" value= "{{ $employee->first_name }}" placeholder="">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email">邮箱 :</label>
			<div class="controls">
				<input type="text" name="email" id="email" value= "{{ $employee->email }}" placeholder="">
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
				<input type="text" name="phone" id="phone" value= "{{ $employee->phone }}" placeholder="">
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">更新</button>
			<a class="btn btn-primary" href="{{ URL::to('employee') }}">取消</a>
		</div>

	{{ Form::close() }}
</div>

@stop