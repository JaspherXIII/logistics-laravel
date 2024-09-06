@extends('layouts.app')
@section('title', 'OSave | Dashboard')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-transparent card-block card-stretch card-height border-none">
                    <div class="card-body p-0 mt-lg-2 mt-0">
                        <h3 class="mb-3">{{ $greeting }}, {{ Auth::user()->name }}</h3>
                        <p class="mb-0 mr-4">Your dashboard gives you the summary of your logistics retail.</p>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="/logistic-assets/images/product/1.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">In Stocks</p>
                                        <h4>{{ $inStockCount }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-primary iq-progress progress-1" data-percent="{{ $inStockCount }}">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="/logistic-assets/images/product/2.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Low In Stock</p>
                                        <h4>{{ $lowStockCount }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-secondary iq-progress progress-1" data-percent="{{ $lowStockCount }}">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="/logistic-assets/images/product/3.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Out of Stock</p>
                                        <h4>{{ $outOfStockCount }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="{{ $outOfStockCount }}">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <!-- Chart1 -->
        <div class="col-sm-12 col-lg-6">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Top Products</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006" data-toggle="dropdown">
                                {{ request('filter', 'This Month') }}<i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton006">
                                <a class="dropdown-item"
                                    href="{{ route('admin.dashboard', ['filter' => 'Year']) }}">Year</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin.dashboard', ['filter' => 'Month']) }}">Month</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin.dashboard', ['filter' => 'Week']) }}">Week</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled row top-product mb-0">
                        @foreach ($topProducts as $product)
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-warning-light rounded">
                                            <img src="{{ asset('' . $product->product->image) }}"
                                                class="style-img img-fluid m-auto p-3" alt="image"
                                                style="width: 100% !important;">
                                        </div>

                                        <div class="style-text text-left mt-3">
                                            <h6 class="mb-0">{{ $product->product->name }}</h6>
                                            <p class="mb-0">{{ $product->quantity }} Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Recent Purchase Orders</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive rounded mb-3">
                        <table class="table mb-0 order-table">
                            <thead>
                                <tr class="ligth ligth-data">
                                    <th>Created Date</th>
                                    <th>Purchase Order No.</th>
                                    <th>Supplier</th>
                                    <th>Delivery Status</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End Chart2 -->
    </div>


@endsection

@section('scripts')
    <script>
        $(function() {
            var orderTable = $('.order-table').DataTable({
                ajax: {
                    url: "{{ route('orders.getTop3Orders') }}",
                    method: 'GET',
                    dataType: 'JSON'
                },
                columns: [{
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            var date = new Date(data);
                            var options = {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            };
                            return date.toLocaleDateString('en-GB', options);
                        }
                    },
                    {
                        data: 'purchase_order_no',
                        name: 'purchase_order_no'
                    },
                    {
                        data: 'supplier.name',
                        name: 'supplier.name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, full, meta) {
                            var badgeClass;
                            var badgeText;

                            switch (data) {
                                case 'To Deliver':
                                    badgeClass = 'badge-success';
                                    badgeText = 'To Deliver';
                                    break;
                                case 'Failed To Receive':
                                    badgeClass = 'badge-danger';
                                    badgeText = 'Failed To Receive';
                                    break;
                                case 'Cancelled':
                                    badgeClass = 'badge-secondary';
                                    badgeText = 'Cancelled';
                                    break;
                                case 'Delivered':
                                    badgeClass = 'badge-primary';
                                    badgeText = 'Delivered';
                                    break;
                                case 'Returned':
                                    badgeClass = 'badge-warning';
                                    badgeText = 'Returned';
                                    break;
                                default:
                                    badgeClass = 'badge-secondary';
                                    badgeText = 'Unknown';
                            }

                            return '<div class="badge ' + badgeClass + '">' + badgeText + '</div>';
                        }
                    }
                ]
            });
        });
    </script>

@endsection
