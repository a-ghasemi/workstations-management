@extends('layout')

@section('heading','Working Station Details')
@section('content')
    <h2>Name: {{ $workstation->name }}</h2>
    <h2>User</h2>
    @if($workstation->user)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $workstation->user->id }}</th>
                <td>{{ $workstation->user->name }}</td>
                <td>{{ $workstation->user->email }}</td>
                <td>
                    {{--                    <a href="{{ route('users.show', $item->id) }}">Details</a>--}}
                </td>
            </tr>
        </tbody>
    </table>
    @else
        <p>No User Specified Yet</p>
    @endif
    <hr>
    <h2>Address: </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Street</th>
                <th scope="col">ZipCode</th>
                <th scope="col">City</th>
                <th scope="col">Country</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $workstation->address->id }}</th>
                <td>{{ $workstation->address->name }}</td>
                <td>{{ $workstation->address->street }}</td>
                <td>{{ $workstation->address->zip_code }}</td>
                <td>{{ $workstation->address->city }}</td>
                <td>{{ $workstation->address->country }}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <h2>Components</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Serial Number</th>
                <th>Type</th>
                <th>Category</th>
                <th>Make</th>
                <th>Model</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workstation->components as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->type->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->make }}</td>
                    <td>{{ $item->model }}</td>
                    <td>
    {{--                    <a href="{{ route('components.show', $item->id) }}">Details</a>--}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
