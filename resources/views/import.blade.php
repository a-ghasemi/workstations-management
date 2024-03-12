@extends('layout')

@section('heading','Working Station | Import')
@section('content')
<form action="{{ route('import.excel.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <input type="file" name="excel_file">
    <input type="submit" value="Submit">
</form>
@endsection
