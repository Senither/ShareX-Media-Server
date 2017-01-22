@extends('master')

@section('page-title', 'Permission Management')

@section('style', '<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">')

@section('content')
    @include('partial.flash')

    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Group Permission Management</strong>
                </div>

                <div class="panel-body">
                    <h3 class="text-center">{{ $group->name }} permissions</h3>
                    <form action="{{ action('PermissionsController@update', [mb_strtolower($group->name)]) }}" method="post">
                        {{ csrf_field() }}
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <input 
                                            type="checkbox" 
                                            data-toggle="toggle" 
                                            data-on="Enabled" 
                                            data-off="Disabled" 
                                            data-onstyle="success" 
                                            onchange="updatePermissionState(this)"
                                            name="permission-{{ $permission->id }}"
                                            {{ $group->permissions->contains('node', $permission->node) ? 'checked' : null }}
                                        >
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        function updatePermissionState(input) {
            $.ajax({
                type: "POST",
                url: "{{ action('PermissionsController@update', [mb_strtolower($group->name)]) }}",
                data: "_token={{ csrf_token() }}&" + input.name + "=true",
                success : function (text) {
                    //
                },
                error : function (jqXhr, json, errorThrown) {
                    //
                }
            });
        }
    </script>
@stop