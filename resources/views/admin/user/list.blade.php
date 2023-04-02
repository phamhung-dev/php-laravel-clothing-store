@extends('admin.layouts.default')

@section('title', 'User list')

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
                <h1>All User</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Users
                </p>
            </div>
            <div>
                <a href="/admin/coupon/add" class="btn btn-primary"> Add new</a>
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
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Img: activate to sort column ascending" style="width: 99.062px;">Avatar</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 180.0977px;">Full name</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 118.672px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Telephone: activate to sort column ascending" style="width: 118.672px;">Telephone</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Is locked: activate to sort column ascending" style="width: 104.375px;">Is locked</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 107.109px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach ($users as $user)
                                        <tr class="odd">
                                            <td class="sorting_1">{{$user->id}}</td>
                                            <td>
                                                @if($user->avatar != null)
                                                <img class="cat-thumb" src="data:image/png;base64, {{$user->avatar}}" alt="img">
                                                @else
                                                <img class="cat-thumb" src="{{asset('web/img/common/avatar.png')}}" alt="img">
                                                @endif
                                            </td>
                                            <td>{{$user->first_name.' '.$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->telephone}}</td>
                                            <td>
                                                @if($user->is_admin == 1)
                                                <span class="badge badge-success">admin</span>
                                                @else
                                                @endif
                                            </td>                                        
                                            <td>
                                            <div class="btn-group mb-1">
                                                    <a href="{{ route('admin.user.info', ['id' => $user->id]) }}" class="btn btn-outline-success">Info</a>
                                                </div>
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