@extends('admin.layouts.default')

@section('title', 'inventory')

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
                <h1>Inventories</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Inventory
                </p>
            </div>
            <div>
                <a href="/admin/inventory/create" class="btn btn-primary"> Add new</a>
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
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Product name: activate to sort column ascending" style="width: 180.0977px;">Product name</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Size: activate to sort column ascending" style="width: 99.062px;">Size</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Color: activate to sort column ascending" style="width: 118.672px;">Color</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 118.672px;">Quantity</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="ICreate at: activate to sort column ascending" style="width: 104.375px;">Create at</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Update at: activate to sort column ascending" style="width: 104.375px;">Update at</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Is active: activate to sort column ascending" style="width: 104.375px;">Is active</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 107.109px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($productInventories as $productInventory)
                                        <tr class="odd">
                                            <td class="sorting_1">{{$productInventory->id}}</td>
                                            <td>{{$productInventory->Product->name}}</td>
                                            <td>{{$productInventory->size}}</td>
                                            <td>{{$productInventory->color}}</td>
                                            <td>{{$productInventory->quantity}}</td>
                                            <td>{{$productInventory->created_at}}</td>
                                            <td>{{$productInventory->updated_at}}</td>
                                            <td>
                                                @if($productInventory->is_active == 1)
                                                <span class="badge badge-success">enabled</span>
                                                @else
                                                <span class="badge badge-secondary">disabled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group mb-1">
                                                    <a href="{{ route('admin.inventory.edit', ['id' => $productInventory->id]) }}" class="btn btn-outline-success">Edit</a>
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