
@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">
                        <div class="row p-3">
                            <!-- Area Chart -->
                            <div class="col-xl-8 col-lg-7">
                                <form action="{{ route('postUpdateUser', ['id' => $user->id]) }}" class="user" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Thông tin tài khoản</h6>
                                            <div class="dropdown no-arrow"> 
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="add-product-are">
                                                <!-- <canvas id="myAreaChart"></canvas> -->
                                                <!-- <div class="select-thumbnail mg-bottom-30"> -->
                                                    <div class="padding-30">
                                                        <div class="continent">
                                                            <div class="thumbnail">
                                                                <img id="image-thumbnail" src="{{ asset('storage/' . $user->thumbnail) }}" alt="" >
                                                                <div class="chonse-thumbnail" onclick="openFilePicker('#file-thumbnail')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M20.849 8.713a3.932 3.932 0 0 0-5.562-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.093 3.32a8.754 8.754 0 0 0 3.43 2.13l.888-.887Z" opacity=".5"/><path d="m14.439 4l-.039.038l.038.112a8.754 8.754 0 0 0 2.093 3.32a8.753 8.753 0 0 0 3.43 2.13l-8.56 8.56c-.578.577-.867.866-1.185 1.114a6.554 6.554 0 0 1-1.211.748c-.364.174-.751.303-1.526.561l-4.083 1.361a1.06 1.06 0 0 1-1.342-1.341l1.362-4.084c.258-.774.387-1.161.56-1.525c.205-.43.456-.836.749-1.212c.248-.318.537-.606 1.114-1.183L14.439 4Z"/></g></svg></div>
                                                                <input type="file" id="file-thumbnail" name="files" multiple class="custom-file-input" onchange="previewImages()"><br><br>
                                                            </div>
                                                        </div>
                                                        <p class="text-align note">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</p>
                                                    </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="p-5">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    @error('firstname')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="firstname"
                                                        placeholder="First Name*" value="{{ $user->firstname }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    @error('lastname')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="text" class="form-control form-control-user input_required" id="exampleLastName" name="lastname"
                                                        placeholder="Last Name*" value="{{ $user->lastname }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    @error('email')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email"
                                                        placeholder="Email Address*" value="{{ $user->email }}">
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    @error('phone')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="phone" class="form-control form-control-user" id="exampleInputEmail" name="phone"
                                                        placeholder="Phone Number*" value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Update Account
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xl-4 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Thay đổi mật khẩu</h6>
                                        <div class="dropdown no-arrow"> 
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <form action="{{ route('postUpdatePasswordUser', ['id' => $user->id]) }}" class="user" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    @error('current_password')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="password" class="form-control form-control-user" id="exampleFirstName" name="current_password"
                                                        placeholder="Current Password*" value="{{ old('current_password') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    @error('password')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="password" class="form-control form-control-user" id="exampleFirstName" name="password"
                                                        placeholder="New Password*" value="{{ old('password') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    @error('password_confirmation')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="password" class="form-control form-control-user" id="exampleFirstName" name="password_confirmation"
                                                        placeholder="Repeat New Password*" value="{{ old('password_confirmation') }}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Update Password
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Yêu cầu cấp quyền</h6>
                                        <div class="dropdown no-arrow"> 
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <form action="{{ route('postRequestAuthorization', ['id' => $user->id]) }}" class="user" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!-- <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    @error('current_password')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="password" class="form-control form-control-user" id="exampleFirstName" name="current_password"
                                                        placeholder="Current Password*" value="{{ old('current_password') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    @error('password')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="password" class="form-control form-control-user" id="exampleFirstName" name="password"
                                                        placeholder="New Password*" value="{{ old('password') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    @error('password_confirmation')
                                                        <p style="color: red">{{ $message }}</p>
                                                    @enderror
                                                    <input type="password" class="form-control form-control-user" id="exampleFirstName" name="password_confirmation"
                                                        placeholder="Repeat New Password*" value="{{ old('password_confirmation') }}">
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <select class=" form-control custom-select" id="category_select" name="position" >
                                                    <option value="" disabled selected>Position*</option>
                                                    @foreach($authorizationdetails as $authorizationdetail)
                                                        <option value="{{ $authorizationdetail->id }}">{{ $authorizationdetail->name_author }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Gửi yêu cầu
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
@endsection

@push('script')
@endpush
