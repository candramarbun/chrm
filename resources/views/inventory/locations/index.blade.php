@extends('template.admin')
@section('content-header')
   <h1>Inventory Locations</h1>
   @include('_partial.flash_message')
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Location List</h3>
            <div class="box-tools">
                <a href="{{ route('inventory_locations.create') }}" class="btn btn-primary btn-sm">Add New Location</a>
            </div>
        </div>
        <div class="box-body">
            @if(count($locations) > 0)
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td>{{ $location->code }}</td>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->description }}</td>
                                    <td>
                                        <a href="{{ route('inventory_locations.edit', $location->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('inventory_locations.destroy', $location->id) }}" method="POST" style="display: inline;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No locations found</p>
            @endif
        </div>
    </div>
@endsection