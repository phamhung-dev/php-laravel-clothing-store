@extends('admin.layouts.default')

@section('title', 'Role list')

@section('header_optional')
<!-- No Extra plugin used -->
<link href="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.css')}}" rel="stylesheet">
<link href="{{asset('admin/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>All role</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Role
                </p>
            </div>
            <div>
                <a href="/admin/role/create" class="btn btn-primary"> Add new</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="">
                            <div id="responsive-data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                                <table id="responsive-data-table" class="table dataTable no-footer" style="width:100%" aria-describedby="responsive-data-table_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 39.6875px;">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="User name: activate to sort column ascending" style="width: 180.0977px;">User name</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Role name: activate to sort column ascending" style="width: 99.062px;">Role name</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Create at: activate to sort column ascending" style="width: 104.375px;">Create at</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Update at: activate to sort column ascending" style="width: 104.375px;">Update at</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 107.109px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($roleUsers as $role)
                                        <tr class="odd">
                                            <td class="sorting_1"></td>
                                            <td>{{$role->User->first_name.' '.$role->User->last_name}}</td>
                                            <td>{{$role->Role->name}}</td>
                                            <td>{{$role->created_at}}</td>
                                            <td>{{$role->updated_at}}</td>
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.role.destroy', [$role->User->id, $role->Role->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-outline-warning" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
</div> <!-- End Content Wrapper -->

@section('footer_optional')
<!-- Datatables -->
<script src="{{asset('admin/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin/plugins/data-tables/datatables.responsive.min.js')}}"></script>
<!-- Option Switcher -->
<script src="{{asset('admin/plugins/options-sidebar/optionswitcher.js')}}"></script>
@endsection


@endsection