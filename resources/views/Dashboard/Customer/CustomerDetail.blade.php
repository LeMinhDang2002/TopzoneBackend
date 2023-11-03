@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-5">
                        <h1 class="h3 mb-0 text-gray-800 ml-5">Thông tin chi tiết của khách hàng</h1>
                    </div>
                    <div class="row ml-5 mr-5">

                        <div class="col-lg-4 ml-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông tin cơ bản</h6>
                                </div>
                                <div class="card-body">
                                    <div class="add-product-are">
                                            <div class="padding-30">
                                                <div class="continent">
                                                    <div class="thumbnail">
                                                        <img id="image-thumbnail" src="" alt="" >
                                                        <div class="chonse-thumbnail" onclick="openFilePicker('#file-thumbnail')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M20.849 8.713a3.932 3.932 0 0 0-5.562-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.093 3.32a8.754 8.754 0 0 0 3.43 2.13l.888-.887Z" opacity=".5"/><path d="m14.439 4l-.039.038l.038.112a8.754 8.754 0 0 0 2.093 3.32a8.753 8.753 0 0 0 3.43 2.13l-8.56 8.56c-.578.577-.867.866-1.185 1.114a6.554 6.554 0 0 1-1.211.748c-.364.174-.751.303-1.526.561l-4.083 1.361a1.06 1.06 0 0 1-1.342-1.341l1.362-4.084c.258-.774.387-1.161.56-1.525c.205-.43.456-.836.749-1.212c.248-.318.537-.606 1.114-1.183L14.439 4Z"/></g></svg></div>
                                                        <input type="file" id="file-thumbnail" name="files" multiple class="custom-file-input" onchange="previewImages()"><br><br>
                                                    </div>
                                                </div>
                                                <p class="text-align note">Tên Của Khách Hàng</p>
                                            </div>
                                            <hr>
                                            <div>
                                                <strong class="text-gray-700 mb-0">Email</strong>
                                                <p class="text-gray-600">lmd16032002@gmail.com</p>
                                            </div>
                                            <div>
                                                <strong class="text-gray-700 mb-0">Số điện thọai</strong>
                                                <p class="text-gray-600">0382255077</p>
                                            </div>
                                            <div>
                                                <strong class="text-gray-700 mb-0">Địa chỉ</strong>
                                                <p class="text-gray-600">Quận Gò Vấp - TPHCM</p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 mr-5">
                            <div class="row">
                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Tổng số tiền giao dịch</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Chả biết bỏ cái gì vào</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Lịch sử giao dịch</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Mã Đơn Hàng</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Số Tiền</th>
                                                    <th>Ngày Giao Dịch</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <<th>Mã Đơn Hàng</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Số Tiền</th>
                                                    <th>Ngày Giao Dịch</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                </tr>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
@endsection

@push('script')
@endpush