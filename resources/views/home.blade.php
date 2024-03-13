@extends('layout')

@section('heading','Working Stations List')
@section('content')
    @if($workstations->count() == 0)
        <p>
            <b>No workstations found</b><br>
            You can simply add new workstation using the button below:<br>
            <a class="btn btn-primary" href="{{ route('import.excel.create') }}">Import XLS File</a>
        </p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($workstations as $workstation)
                <tr>
                    <th scope="row">{{ $workstation->id }}</th>
                    <td>{{ $workstation->name }}</td>
                    <td>
                        <a href="{{ route('workstations.show', $workstation->id) }}">Details</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
