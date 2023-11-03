@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Customer</h6>
                            <!-- <a href="{{ route('getAddProduct') }}" class="btn btn-success btn-icon-split float-right">
                                <span class="text">Thêm Sản Phẩm</span>
                            </a> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên Khách Hàng</th>
                                            <th>Email</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tên Khách Hàng</th>
                                            <th>Email</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->customer_name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ $customer->status }}</td>
                                                <td>{{ $customer->created_at }}</td>
                                                <!-- <td>$31.88</td> -->
                                                <td>
                                                <nav class="navbar navbar-expand navbar-light bg-light">
                                                    <ul class="navbar-nav ml-auto">
                                                        <li class="nav-item dropdown">
                                                            <a class="text-decoration-none dropdown-toggle"  id="navbarDropdown"
                                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                                aria-labelledby="navbarDropdown">
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                                </form>
                                                                <a class="dropdown-item" href="">View</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
@endsection

@push('script')
<script type="text/javascript" src="{{ asset('/assets/js/product.js') }}"></script>
@endpush