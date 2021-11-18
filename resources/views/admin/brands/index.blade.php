@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php /* ?>
<form action="{{ route('admin.front.update') }}" method="POST" enctype="multipart/form-data">

    {{ method_field('PUT') }}
    @csrf
<?php */ ?>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>Filters</strong>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" autocomplete="off" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" placeholder="Select Status">
                            <option value="">Select Status</option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{ route('admin.brand.create') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;
                    Add Brand
                </a>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" id="brands-table">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Image</th>
                        <th>Heading</th>
                        <th>Slogan</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Created At</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<?php /* ?>
</form>
<?php */ ?>

<script>
    var oTable = $('#brands-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('brand.datatables') !!}",
            data: function(d) {
                d.status = $('#status').val();
                d.name = $('#name').val();
            }
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'logo',
                name: 'logo',
                render: function(data, type, full, meta) {
                    // placeholder
                    if (data.includes("robo") || data.includes("lorempixel") || data.includes("unsplash") || data.includes("placeholder")) {
                        return "<img src='" + data + "' style='height:80px;' class='img-fluid img-thumbnail' alt='Brand Logo'  />";
                    } else {
                        return '<img src="{{url("/images/brands/logos/")}}/' + data + '" class="img-fluid img-thumbnail" alt="Brand Logo" />';
                    }
                }
            },
            {
                data: 'image',
                name: 'image',
                render: function(data, type, full, meta) {
                    if (data.includes("robo") || data.includes("lorempixel") || data.includes("unsplash") || data.includes("placeholder")) {
                        return "<img src='" + data + "' style='height:100px;' class='img-fluid img-thumbnail' alt='Brand Image'  />";
                    } else {
                        return '<img src="{{url("/images/brands/images/")}}/' + data + '" class="img-fluid img-thumbnail" alt="Brand Image" />';
                    }
                }
            },
            {
                data: 'heading',
                name: 'heading'
            },
            {
                data: 'slogan',
                name: 'slogan'
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    if (data == 'Enabled') {
                        return "<span class='right badge badge-success p-1'>" + data + "</span>";
                    } else {
                        return "<span class='right badge badge-danger p-1'>" + data + "</span>";
                    }
                }
            },
            {
                data: 'order',
                name: 'order'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        order: [
            [0, 'desc']
        ],
        searching: false,
        // bLengthChange:false,
    });

    $('#status').on('change', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    $('#name').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
</script>

@endsection