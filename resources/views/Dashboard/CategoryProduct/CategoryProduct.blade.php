@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Danh Mục Sản Phẩm</h6>
                            <a href="#" class="btn btn-success btn-icon-split float-right">
                                <span class="text">Thêm Danh Mục</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Hình Ảnh</th>
                                            <th>Tên Danh Mục</th>
                                            <th>Tình Trạng</th>
                                            <!-- <th>Salary</th> -->
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Danh Mục</th>
                                            <th>Tình Trạng</th>
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
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
                                                            <a class="dropdown-item" href="#">Xóa</a>
                                                            <a class="dropdown-item" href="#">Update</a>
                                                            <!-- <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Something else here</a> -->
                                                        </div>
                                                    </li>
                                                </ul>
                                            </nav>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
@endsection

@push('script')
@endpush