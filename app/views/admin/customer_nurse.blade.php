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
护理记录:
</div>
<table class="table table-striped table-bordered table-condensed sr-table">
	<thead>
		<tr>
			<th>项目名称</th>
			<th>消费金额</th>
			<th>护理员工</th>
			<th>护理时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($nurserecord->count() > 0)
			@foreach($nurserecord as $nurse)
			<tr>
				<td><a href="{{ URL::to('nurse') }}">{{ $nurse->nurse_name }}</a></td>
				<td class="sr-align-right">{{ $nurse->price }}</td>
				<td>{{ $nurse->employee_name }}</td>
				<td>{{ $nurse->created_at }}</td>
				<td>
					<a href="{{ URL::to('customers/deletenurserecord/' . $nurse->id) }}" class="btn btn-danger"><i class="icon-pencil"></i>删除</a>
				</td>
			</tr>	
			@endforeach
			<tr>
				<td colspan="6" class="sr-align-center">消费总额：{{ $nurserecord->sum('price') }}</td>
			</tr>
		@else
			<tr>
				<td colspan="6" class="sr-align-center">该顾客还没有任何消费记录</td>
			</tr>
		@endif
	</tbody>
</table>
@stop

















