@extends('layouts.admin')

@section('content')
<div>
消费记录：
</div>

<table class="table table-striped table-bordered table-condensed sr-table">
	<thead>
		<tr>
			<th>护理项目</th>
			<th>顾客</th>
			<th>价格</th>
			<th>护理员工</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($customernurse->count() > 0)
			@foreach($customernurse as $revenue)
				<tr>
					<td>{{ $revenue->nurse_name }}</td>
					<td>{{ $revenue->customer_name }}</td>
					<td>{{ $revenue->price }}</td>
					<td>{{ $revenue->employee_name }}</td>
					<td>
						<a href="{{ URL::to('revenue/delete/' . $revenue->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> 删除</a>
					</td>
				</td>
				</tr>
			@endforeach
			<tr>
				<td colspan="6" class="sr-align-center">消费总额：{{ $customernurse->sum('price') }}</td>
			</tr>
		@else
			<tr>
				<td colspan="6" class="sr-align-center">暂时没有消费记录</td>
			</tr>
		@endif
	</tbody>
</table>

@stop