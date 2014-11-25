@extends('layouts.admin')

@section('content')
<div>
护理项目信息:
</div>

<table class="table table-striped table-bordered table-condensed sr-table">
	<thead>
		<tr>
			<th>项目名称</th>
			<th>价格</th>
			<th>次数</th>
			<th>简介</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($nurses->count() > 0)
			@foreach($nurses as $nurse)
				<tr>
					<td>{{ $nurse->name }}</td>
					<td>{{ $nurse->price }}</td>
					<td>{{ $nurse->total }}</td>
					<td>{{ $nurse->info }}</td>
					<td>
						<a href="{{ URL::to('nurse/editnurse/' . $nurse->id) }}" class="btn"><i class="icon-pencil"></i> 编辑</a>
						<a href="{{ URL::to('nurse/delete/' . $nurse->id) }}" class="btn btn-danger"><i class="icon-remove-sign"></i> 删除</a>
					</td>
				</tr>
			@endforeach
		@else
			<tr>
				<td colspan="6" class="sr-align-center">没有任何护理项目信息</td>
			</tr>
		@endif
	</tbody>
</table>
@stop