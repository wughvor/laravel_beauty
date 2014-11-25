@extends('layouts.admin')

@section('content')
<div>
顾客信息：
</div>
<div class="pull-right">
	<a class="btn btn-success"" href="{{ URL::to('customers/addnurserecord/' . $customer->id) }}"><i ></i>增加消费记录</a>
	<br />
</div>
<table class="table table-striped table-bordered table-condensed sr-table">
	<thead>
		<tr>
			<th>姓名</th>
			<th>邮箱</th>
			<th>电话</th>
			<th>状态</th>
		</tr>
		
	</thead>
	<tbody>
		<tr>
			<td>{{ $customer->last_name . $customer->first_name }}</td>
			<td>{{ $customer->email }}</td>
			<td>{{ $customer->phone }}</td>
			<td>
				@if($customer->activated == "1")
					<span class="label label-success">启用</span>
				@endif
				@if($customer->activated == "0")
					<span class="label label-important">禁用</span>
				@endif
			</td>
		</tr>
		
	</tbody>
</table>

<div>


<div>
填写消费记录的信息：
{{ count($employee) }}
</div>
	{{ Form::open(array('url' => 'customers/addnurserecord' )) }}
		<input type="hidden" id="customer_id" name="customer_id" value="{{ $customer->id }} ">
		<div class="control-group">
			<label class="control-label" for="nurse_name">护理项目：</label>
			<div class="controls">
				{{ Form::select('nurse_id', array('' => "-- 选择护理项目 --") + $nurses, Input::old('nurse_name')) }}
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="nurse_name">护理项目：</label>
			<div class="controls">
				{{ Form::select('employee_id', array('' => "-- 选择护理员工 --") + $employee, Input::old('employee_name')) }}
			</div>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">保存</button>
			<a class="btn btn-primary" href="{{ URL::to('customers/nurserecord/' . $customer->id) }}">取消</a>
		</div>

	{{ Form::close() }}
@stop