@extends('layouts.app')

@section('content')

<section class="content">
    <form action="{{ route('admin.bucket.store') }}" method="POST" enctype="multipart/form-data">
        {{ method_field('POST') }}
        @csrf
        <div class="card ">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.vehiclepricingbucket.create') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;
                        Attach a Bucket
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
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="name">Bucket Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="bucketname" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Bucket Name" autocomplete="off" />
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </div>
    </form>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>Filter</strong>
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
                <table class="table table-striped table-bordered table-sm" id="bucket-table">
                    <thead>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="100">Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
    var oTable = $('#bucket-table').DataTable({
        processing: true,
        "searching": true,
        serverSide: true,
        ajax: {
            url: "{!! route('bucket.datatables') !!}",
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