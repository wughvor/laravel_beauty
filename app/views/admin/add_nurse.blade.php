@extends('layouts.admin')

@section('content')
<div>
填写护理项目信息:
</div>

{{ Form::open(array('url' => 'nurse/addnurse')) }}
	<div class="control-group">
		<label class="control-label" for="name" >项目名称 :</label>
		<div class="controls">
			<input type="text" name="name" id="name" value="{{ Input::old('name') }}" placeholder="">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="price" >价格 :</label>
		<div class="controls">
			<input type="text" name="price" id="price" value="{{ Input::old('price') }}" placeholder="">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="total" >次数 :</label>
		<div class="controls">
			<input type="text" name="total" id="total" value="{{ Input::old('total') }}" placeholder="">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="info" >简介 :</label>
		<div class="controls">
			<input type="text" name="info" id="info" value="{{ Input::old('info') }}" placeholder="">
		</div>
	</div>

	<div class="form-actions">
		<button type="submit" class="btn btn-primary">保存</button>
		<a class="btn btn-primary" href="{{ URL::to('nurse') }}">取消</a>
	</div>

{{ Form::close() }}
@stop