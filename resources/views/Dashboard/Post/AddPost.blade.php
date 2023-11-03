@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">
                    <form action="{{ route('postAddPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-3">
                        <!-- Area Chart -->
                        <div class="col-xl-10 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Thumbnail</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
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
                                                    <div class="img-post">
                                                        <img id="image-thumbnail" src="" alt="" >
                                                        <div class="chonse-thumbnail" onclick="openFilePicker('#file-thumbnail')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M20.849 8.713a3.932 3.932 0 0 0-5.562-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.093 3.32a8.754 8.754 0 0 0 3.43 2.13l.888-.887Z" opacity=".5"/><path d="m14.439 4l-.039.038l.038.112a8.754 8.754 0 0 0 2.093 3.32a8.753 8.753 0 0 0 3.43 2.13l-8.56 8.56c-.578.577-.867.866-1.185 1.114a6.554 6.554 0 0 1-1.211.748c-.364.174-.751.303-1.526.561l-4.083 1.361a1.06 1.06 0 0 1-1.342-1.341l1.362-4.084c.258-.774.387-1.161.56-1.525c.205-.43.456-.836.749-1.212c.248-.318.537-.606 1.114-1.183L14.439 4Z"/></g></svg></div>
                                                        <input type="file" id="file-thumbnail" name="files" multiple class="custom-file-input" onchange="previewImages()"><br><br>
                                                    </div>
                                                </div>
                                                <p class="text-align note">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</p>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Cơ Bản</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="add-product-are">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <div class="padding-30">
                                            <label class="add-lable" for="">Tên Bài Viết</label><br>
                                            <input class="add-input" type="text" placeholder="Product Name" name="title" id="NameProduct"><br><br>
                                            <label class="add-lable" for="">URL</label><br>
                                            <input class="add-input" type="text" placeholder="URL" name="URL" id="URL"><br><br>
                                            <label class="add-lable" for="">Danh Mục Bài Viết</label><br>
                                            <select class="add-input" id="category_select" name="category_select" onclick="show_option('category_select', 'category_input')">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" p-3">
                                <button type="submit" class="btn btn-success btn-icon-split float-right mb-5">
                                    <span class="text">Thêm Danh Mục Sản Phẩm</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
@endsection

@push('script')
@endpush