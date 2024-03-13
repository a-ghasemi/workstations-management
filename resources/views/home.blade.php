@extends('layout')

@section('heading','Working Stations List')
@section('content')
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
@endsection
