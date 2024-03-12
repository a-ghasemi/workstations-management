@extends('layout')

@section('heading','Working Stations List')
@section('content')
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    @foreach($workstations as $workstation)
    <tr>
        <td>{{ $workstation->id }}</td>
        <td>{{ $workstation->name }}</td>
        <td>
            <a href="{{ route('workstations.show', $workstation->id) }}">Details</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
