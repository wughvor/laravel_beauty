@extends('layouts.admin')

@section('content')
<div>
编辑护理项目信息：
</div>

{{ Form::open(array('url' => 'nurse/editnurse')) }}

	<input type="hidden" name="id" value="{{ $nurse['id'] }}">
	<div class="control-group">
		<label class="control-label" for="name" >项目名称 :</label>
		<div class="controls">
			<input type="text" name="name" id="name" value="{{ $nurse->name}}" placeholder="">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="price" >价格 :</label>
		<div class="controls">
			<input type="text" name="price" id="price" value="{{ $nurse->price }}" placeholder="">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="total" >次数 :</label>
		<div class="controls">
			<input type="text" name="total" id="total" value="{{ $nurse->total }}" placeholder="">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="info" >简介 :</label>
		<div class="controls">
			<input type="text" name="info" id="info" value="{{ $nurse->info }}" placeholder="">
		</div>
	</div>

	<div class="form-actions">
		<button type="submit" class="btn btn-primary">更新</button>
		<a class="btn btn-primary" href="{{ URL::to('nurse') }}">取消</a>
	</div>

{{ Form::close() }}
@stop