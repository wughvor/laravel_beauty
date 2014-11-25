@extends('layouts.admin')

@section('content')
	<div>
		顾客信息 ：
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
			@if($customers->count() > 0)
				@foreach($customers as $customer)
					<tr>
						<td>{{ $customer->last_name . ' ' . $customer->first_name }}</td>
						<td>{{ $customer->email }}</td>
						<td>{{ $customer->phone }}</td>
						<td>
							@if($customer->activated == "1")
								<span class="label label-success">启用</span>
							@endif
							@if($customer->activated == "0")
								<span class="label label-important">禁用</span>
							@endif
							&nbsp;
						</td>
						<td>
							<a href="{{ URL::to('customers/editcustomer/' . $customer->id) }}" class="btn"><i class="icon-pencil"></i> 编辑</a>
							<a href="{{ URL::to('customers/delete/' . $customer->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> 删除</a>
							@if($customer->activated == "1")
								<a href="{{ URL::to('customers/block/' . $customer->id) }}" class="btn btn-danger"><i class="icon-ban-circle"></i> 禁用</a>
							@endif
							@if($customer->activated == "0")
								<a href="{{ URL::to('customers/active/' . $customer->id) }}" class="btn btn-success"><i class="icon-ok-circle"></i> 启用</a>
							@endif
							<a href="{{ URL::to('customers/nurserecord/' . $customer->id) }}" class="btn btn-info"><i class="icon-list"></i> 护理记录</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6" class="sr-align-center">没有顾客信息</td>
				</tr>
			@endif
		</tbody>
	</table>
@stop