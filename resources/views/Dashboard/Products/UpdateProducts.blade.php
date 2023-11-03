@extends('Layout')
@section('content')
@include('sweetalert::alert')
            <form action="{{ route('postUpdateProduct', ['id' => $product->id]) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="container-fluid">
                    <div class="row p-3">
                    <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Cở Bản</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="add-product-are">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <div class="padding-30">
                                            <label class="add-lable" for="">Tên Sản Phẩm</label><br>
                                            <input class="add-input" type="text" placeholder="Product Name" name="name_product" id="NameProduct" value="{{$product->product_name}}"><br><br>
                                            <label class="add-lable" for="">Description</label><br>
                                            <input class="add-input" type="text" placeholder="Description" name="description" id="Description" value="{{$product->product_description}}"><br><br>
                                            <label class="add-lable" for="">Phiên Bản</label><br>
                                            <input class="add-input" type="text" placeholder="Version" name="version" id="Version" value="{{$product->version}}"><br><br>
                                            <label class="add-lable" for="">Số Lượng Trong Kho</label><br>
                                            <input class="add-input" type="text" placeholder="Quantity" name="quantity" id="Quantity" value="{{$product->quantity}}"><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Media</h6>
                                </div>
                                <div class="card-body">
                                    <div class="add-product-are">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <div class="padding-30">
                                            <label class="add-lable" for="">Tên Màu</label><br>
                                            <input class="add-input" type="text" placeholder="NameColor" name="namecolor" id="NameColor" value="{{ $color->name_color }}"><br><br>
                                            <label class="add-lable" for="">Mã Màu</label><br>
                                            <input class="add-input" type="text" placeholder="CodeColor" name="codecolor" id="CodeColor" value="{{ $color->code_color }}"><br><br>
                                            <label class="add-lable" for="">Hình Ảnh</label><br><br>
                                            <div class="custom_file_label" onclick="openFilePicker('#file-input-img')">
                                                <div class="padding-30">
                                                    <span>Select files</span>
                                                    <div class="display-flex" id="preview">
                                                        @foreach($images as $image)
                                                            <div class="image-container">
                                                                <img height="100" width="100" alt="{{ $image->file_name }}" src="{{ asset('storage/' . $image->file_name) }}" name="images_old[]">
                                                                <input type="hidden" name="images_old[]" value="{{ $image->file_name }}">
                                                                <button onclick="removeImage({{ $loop->index }})">x</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <input type="file" id="file-input-img" name="images[]" multiple class="custom-file-input" onchange="handleFileSelect(event)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <a href="#collapseCardExample_1" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Thông số kỹ thuật</h6>
                                </a>
                                <div class="collapse" id="collapseCardExample_1">
                                    <div class="card-body">
                                        @foreach($groupSpecificationParents as $groupSpecificationParent)
                                            <div class="row" id="div_{{$groupSpecificationParent->id}}">
                                                <div class="col-lg-11">
                                                    <div class="card shadow mb-4">
                                                        <a href="#groupSpecificationParent_{{$groupSpecificationParent->id}}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                        role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">{{ $groupSpecificationParent->name }}</h6>
                                                        </a>
                                                        <div class="collapse" id="groupSpecificationParent_{{$groupSpecificationParent->id}}">
                                                            <div class="card-body">
                                                                @foreach($groupSpecificationParent->subGroupSpecifications as $subGroupSpecification)
                                                                    <div class="row" id="div_{{$subGroupSpecification->id}}">
                                                                        <div class="col-lg-11">
                                                                                <div class="row mb-4">
                                                                                    <div class="col-lg-4">
                                                                                        <label class="add-lable" for="">{{$subGroupSpecification->name}}</label>
                                                                                    </div>
                                                                                    <div class="col-lg-8">
                                                                                        <select class="add-input" id="category_select" name="group_specification[{{$subGroupSpecification->id}}]">
                                                                                            <option value="" disabled selected></option>
                                                                                            @foreach($subGroupSpecification->specificationDetails as $specificationDetail)
                                                                                                <option value="{{$specificationDetail->id}}" {{ $specificationDetail->id == $subGroupSpecification->specificationDetailOfProduct->id ? 'selected':'' }}>{{$specificationDetail->description}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <button class="btn btn-danger btn-user btn-block" onclick="DeleteGroupSpecification('div_{{$subGroupSpecification->id}}')">X</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1">
                                                    <button class="btn btn-danger btn-user btn-block" onclick="DeleteGroupSpecification('div_{{$groupSpecificationParent->id}}')">X</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Thumbnail</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="add-product-are">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <!-- <div class="select-thumbnail mg-bottom-30"> -->
                                            <div class="padding-30">
                                                <div class="continent">
                                                    <div class="thumbnail">
                                                        <img id="image-thumbnail" src="{{ asset('storage/' . $thumbnail->file_name) }}" alt="">
                                                        <div class="chonse-thumbnail" onclick="openFilePicker('#file-thumbnail')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M20.849 8.713a3.932 3.932 0 0 0-5.562-5.561l-.887.887l.038.111a8.754 8.754 0 0 0 2.093 3.32a8.754 8.754 0 0 0 3.43 2.13l.888-.887Z" opacity=".5"/><path d="m14.439 4l-.039.038l.038.112a8.754 8.754 0 0 0 2.093 3.32a8.753 8.753 0 0 0 3.43 2.13l-8.56 8.56c-.578.577-.867.866-1.185 1.114a6.554 6.554 0 0 1-1.211.748c-.364.174-.751.303-1.526.561l-4.083 1.361a1.06 1.06 0 0 1-1.342-1.341l1.362-4.084c.258-.774.387-1.161.56-1.525c.205-.43.456-.836.749-1.212c.248-.318.537-.606 1.114-1.183L14.439 4Z"/></g></svg></div>
                                                        <input type="file" id="file-thumbnail" name="file_thumbnail" multiple class="custom-file-input" onchange="previewImages()"><br><br>
                                                    </div>
                                                </div>
                                                <p class="text-align note">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</p>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Other</h6>
                                </div>
                                <div class="card-body">
                                    <div class="add-product-are">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <div class="padding-30">
                                            <label class="add-lable" for="">Danh Mục Sản Phẩm</label><br>
                                            <select class="add-input" id="category_select" name="category" >
                                                <option value="" disabled selected></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{$category->id == $product->categoryid ? 'selected':''}}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>

                                            <label class="add-lable" for="">Trạng Thái</label><br>
                                            <select class="add-input" id="category_select" name="status">
                                                <option value="" disabled selected></option>
                                                <option value="Public" {{$product->product_available == 'Public' ? 'selected':''}}>Publiced</option>
                                                <option value="Schedule" {{$product->product_available == 'Schedule' ? 'selected':''}}>Scheduled</option>
                                            </select>

                                            <label class="add-lable" for="">Nhà Cung Cấp</label><br>
                                            <select class="add-input" id="category_select" name="supplier">
                                                <option value="" disabled selected></option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{$supplier->id == $product->supplierid ? 'selected':''}}>{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Price</h6>
                                </div>
                                <div class="card-body">
                                    <div class="add-product-are">
                                        <!-- <canvas id="myAreaChart"></canvas> -->
                                        <div class="padding-30">
                                            <label class="add-lable" for="">Giá Sản Phẩm</label><br>
                                            <input class="add-input" type="text" placeholder="Base Price" name="price" id="Price" value="{{$product->price}}"><br><br>
                                            <label class="add-lable" for="">Giảm Giá</label><br>
                                            <div class="flex-gap-30">
                                                <label for="" class="discount-type" onclick="handleRadio('radio-1')">
                                                    <div class="padding-20">
                                                        <div class="radio">
                                                            <input id="radio-1" name="radio_1" type="radio" >
                                                            <label for="radio-1" class="radio-label">Không Giảm Giá</label>
                                                        </div>
                                                    </div>
                                                </label>
                                                <label for="" class="discount-type" onclick="handleRadio('radio-2')">
                                                    <div class="padding-20">
                                                        <div class="radio">
                                                            <input id="radio-2" name="radio_2" type="radio" {{$product->discount !=0 ? 'checked' : ''}}>
                                                            <label for="radio-2" class="radio-label">Phần Trăm</label>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <div id="range-discount" class="padding-30 {{$product->discount == 0 ? display-none : ''}}">
                                                <div class="continent">
                                                    <h3 id="discountPercentage">{{ $product->discount }}%</h3>
                                                </div>
                                                <input name="discount" id="Discount" class="range-discount" type="range" min="0" max="100" step="1" value="{{ $product->discount }}" oninput="updateDiscountPercentage(this.value)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" p-3">
                        <button type="submit" class="btn btn-success btn-user btn-icon-split float-right mb-5 p-2">Cập nhật sản phẩm</button>
                    </div>
                </div>
            </form>
@endsection

@push('script')
<script type="text/javascript" src="{{ asset('/assets/js/product.js') }}"></script>
@endpush