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
<div>
    <h4>Download Sample Excels</h4>
    <ul>
        <li><b>Success demo: </b><a href="{{ route('download',1) }}">Download File</a></li>
        <li><b>Failure demo: </b><a href="{{ route('download',2) }}">Download File</a></li>
    </ul>
</div>
@endsection
