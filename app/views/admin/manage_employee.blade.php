@extends('layouts.admin')

@section('content')
<div>
员工信息：
</div>

<table class="table table-striped table-bordered table-condensed sr-table">
	<thead>
		<tr>
			<th>姓名</th>
			<th>邮箱</th>
			<th>电话</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($employees->count() > 0)
			@foreach($employees as $employee)
				<tr>
					<td>{{ $employee->last_name . ' ' . $employee->first_name }}</td>
					<td>{{ $employee->email }}</td>
					<td>{{ $employee->phone }}</td>
					<td>
						@if($employee->activated == "1")
							<span class="label label-success">启用</span>
						@endif
						@if($employee->activated == "0")
							<span class="label label-important">禁用</span>
						@endif
						&nbsp;
					</td>
					<td>
						<a href="{{ URL::to('employee/editemployee/' . $employee->id) }}" class="btn"><i class="icon-pencil"></i> 编辑</a>
						<a href="{{ URL::to('employee/delete/' . $employee->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> 删除</a>
						@if($employee->activated == "1")
							<a href="{{ URL::to('employee/block/' . $employee->id) }}" class="btn btn-danger"><i class="icon-ban-circle"></i> 禁用</a>
						@endif
						@if($employee->activated == "0")
							<a href="{{ URL::to('employee/active/' . $employee->id) }}" class="btn btn-success"><i class="icon-ok-circle"></i> 启用</a>
						@endif
						<a href="{{ URL::to('employee/nurserecord/' . $employee->id) }}" class="btn btn-info"><i class="icon-list"></i> 护理记录</a>
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td colspan="6" class="sr-align-center">没有员工信息</td>
			</tr>
		@endif
	</tbody>
</table>

@stop