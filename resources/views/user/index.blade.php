@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4><b>User Management</b></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('user.create')}}" class="btn btn-success mb-3">CREATE</a>
                    </div>
                    <div class="col-6">
                        <x-alert/>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $key => $datauser)
                            <tr>
                                <th scope="row">{{ $users->firstitem() + $key }}</th>
                                <td>{{ $datauser->name }}</td>
                                <td>{{ $datauser->email }}</td>
                                <td>{{ $datauser->roles }}</td>
                                <td class="d-flex">
                                   <a href="{{ route('user.edit', $datauser->id) }}" class="btn btn-warning me-3"> EDIT </a>
                                   <x-button.delete :action="route('user.delete', $datauser->id)"/>

                                   {{--<form method="POST" action="{{ route('user.delete', $datauser->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                   </form>--}}
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $users->links() }}
                    </div>
            </div>
        </div>
    </div>
@endsection
