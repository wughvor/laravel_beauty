@extends('layouts.default')

@section('content')

<h2>全部用户信息</h2>

<p>{{ link_to_route('users.create', '增加新用户') }}</p>

@if($users->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>用户账号</th>
				<th>密码</th>
				<th>邮箱</th>
				<th>电话</th>
				<th>用户姓名</th>
				<th>用户类型</th>
				<th>用户详细信息</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->password }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->name }}</td>
					<td>
						{{ $user->getUserType($user->id) }}					
					</td>
					<td></td>
				

				</tr>
			@endforeach
		</tbody>

	</table>
@else
	没有找到任何用户信息
@endif

@stop