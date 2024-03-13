@extends('layout')

@section('heading','Working Station | Import')
@section('content')
<form action="{{ route('import.excel.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="mb-3">
        <label for="excel_file" class="form-label">Excel File</label>
        <input type="file" class="form-control" name="excel_file">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
