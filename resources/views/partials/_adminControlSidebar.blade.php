<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <!-- Membership discount menu -->

    <a href="{{ route('admin.membership.create') }}" class="nav-control <?php if (url()->current() == route('admin.membership.create')) {
                                                                            echo 'active';
                                                                        } ?>">

        Membership > Add Discount
    </a>


    <a href="{{ route('admin.membership.list') }}" class="nav-control <?php if (url()->current() == route('admin.membership.list')) {
                                                                            echo 'active';
                                                                        } ?>">
        Membership > View Discounts
    </a>


    <!--Pricing Bucket / Package Menu -->

    <a href="{{ route('admin.bucket.create') }}" class="nav-control <?php if ((url()->current() == route('admin.bucket.create'))) {
                                                                        echo 'active';
                                                                    } ?>">
        Buckets
    </a>
</aside>