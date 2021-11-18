<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-muted">{{ ucwords($title) }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <?php if (url()->current() != route('admin.dashboard')) { ?>
                        <li class="breadcrumb-item">
                            <?php
                            $module = strtolower($module);
                            ?>
                            <a href='{{ Route::has("admin.$module.list") ? route("admin.$module.list") : $module }}'>
                                {{ $module }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    <?php } ?>

                </ol>
            </div><!-- /.col -->
            <div class="col-sm-12 mt-3">
                @include('partials._messages')
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->