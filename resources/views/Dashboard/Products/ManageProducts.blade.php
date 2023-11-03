@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample_0" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="collapseCardExample_1">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông tin có liên quan đến sản phẩm</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample_0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Accordion -->
                                                    <a href="#collapseCardExample_0_1" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                        role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm</h6>
                                                    </a>
                                                    <!-- Card Content - Collapse -->
                                                    <div class="collapse" id="collapseCardExample_0_1">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach($categories as $category)
                                                                    <div class="col-lg-12">
                                                                        <div class="card shadow mb-4">
                                                                            <!-- Card Header - Accordion -->
                                                                            <a href="#{{ $category->url }}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                                                role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                                                <h6 class="m-0 font-weight-bold text-primary">{{ $category->category_name }}</h6>
                                                                            </a>
                                                                            <!-- Card Content - Collapse -->
                                                                            <div class="collapse" id="{{ $category->url }}">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            @foreach($category->subcategories as $subcategory)
                                                                                                <div class="card shadow mb-4">
                                                                                                    <!-- Card Header - Accordion -->
                                                                                                    <a href="#{{ $subcategory->url }}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                                                                        role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                                                                        <h6 class="m-0 font-weight-bold text-primary">{{ $subcategory->category_name }}</h6>
                                                                                                    </a>
                                                                                                    <!-- Card Content - Collapse -->
                                                                                                    <div class="collapse" id="{{ $subcategory->url }}">
                                                                                                        <div class="card-body">
                                                                                                            <div class="row">
                                                                                                                <div class="col-lg-12 mb-2">
                                                                                                                    <label for="" class="col-form-label">Description</label><br>
                                                                                                                    <input type="text" class="form-control form-control-user" placeholder="Description*" value="{{ $subcategory->description }}">
                                                                                                                </div>
                                                                                                                <div class="col-lg-6 mb-2">
                                                                                                                    <label for="" class="col-form-label">URL</label><br>
                                                                                                                    <input type="text" class="form-control form-control-user" placeholder="URL*" value="{{ $subcategory->url }}">
                                                                                                                </div>
                                                                                                                <div class="col-lg-6 mb-2">
                                                                                                                    <label for="" class="col-form-label">Status</label><br>
                                                                                                                    <select class="form-control-user form-control" id="status" name="status">
                                                                                                                        <option value="" disabled selected>Status*</option>
                                                                                                                        <option value="Public" {{ $subcategory->status === 'Public' ? 'selected' : '' }}>Publiced</option>
                                                                                                                        <option value="Schedule" {{ $subcategory->status === 'Schedule' ? 'selected' : '' }}>Scheduled</option>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="col-lg-4">
                                                                                                                    <button class="btn btn-success btn-user btn-block">Cập nhật danh mục</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <div class="card shadow mb-4">
                                                                                                <!-- Card Header - Accordion -->
                                                                                                <a href="#category_{{ $category->id }}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                                                                    role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                                                                    <h6 class="m-0 font-weight-bold text-primary">Thêm danh mục</h6>
                                                                                                </a>
                                                                                                <!-- Card Content - Collapse -->
                                                                                                <div class="collapse" id="category_{{ $category->id }}">
                                                                                                    <div class="card-body">
                                                                                                        <form action="{{ route('postAddCategory') }}" method="POST">
                                                                                                            @csrf
                                                                                                            <div class="row">
                                                                                                                <input type="hidden" name="parentid" value="{{ $category->id }}">
                                                                                                                <div class="col-lg-12 mb-2">
                                                                                                                    <input type="text" class="form-control form-control-user" placeholder="Tên danh mục*" name="category_name">
                                                                                                                </div>
                                                                                                                <div class="col-lg-12 mb-2">
                                                                                                                    <input type="text" class="form-control form-control-user" placeholder="Description*" name="description">
                                                                                                                </div>
                                                                                                                <div class="col-lg-12 mb-2">
                                                                                                                    <input type="text" class="form-control form-control-user" placeholder="URL*" name="url">
                                                                                                                </div>
                                                                                                                <div class="col-lg-12 mb-2">
                                                                                                                    <select class="form-control-user form-control" id="status" name="status">
                                                                                                                        <option value="" disabled selected>Status*</option>
                                                                                                                        <option value="Public">Publiced</option>
                                                                                                                        <option value="Schedule">Scheduled</option>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="col-lg-4">
                                                                                                                    <button type="submit" class="btn btn-success btn-user btn-block">Thêm danh mục</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card shadow mb-4">
                                                    <!-- Card Header - Accordion -->
                                                    <a href="#collapseCardExample_0_2" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                        role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">Nhà cung cấp</h6>
                                                    </a>
                                                    <!-- Card Content - Collapse -->
                                                    <div class="collapse" id="collapseCardExample_0_2">
                                                        <div class="card-body">
                                                            <div id="area_supplier">
                                                                @foreach($suppliers as $supplier)
                                                                    <div class="row mb-2" id="{{ $supplier->id }}">
                                                                        <div class="col-lg-10">
                                                                            <input type="text" class="form-control form-control-user" value="{{ $supplier->name }}">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <button class="btn btn-danger btn-user btn-block" onclick="deleteSupplier({{ $supplier->id }})">X</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="row mb-2 ml-5 mr-5">
                                                                <div class="col-lg-6">
                                                                    <button class="btn btn-primary btn-user btn-block" onclick="addSupplier()">Thêm nhà cung cấp</button>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <button class="btn btn-success btn-user btn-block" onclick="UpdateSupplier('area_supplier')">Cập nhật</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample_1" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Thông số kỹ thuật</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="collapseCardExample_1">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($groupSpecificationParents as $groupSpecificationParent)
                                                <div class="col-lg-12">
                                                    <div class="card shadow mb-4">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#parent_{{ $groupSpecificationParent->id}}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                            role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                            <h6 class="m-0 font-weight-bold text-primary">{{ $groupSpecificationParent->name }}</h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse" id="parent_{{ $groupSpecificationParent->id }}">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    @foreach($groupSpecificationParent->subGroupSpecifications as $subGroupSpecification)
                                                                        <div class="col-lg-12">
                                                                            <div class="card shadow mb-4">
                                                                                <!-- Card Header - Accordion -->
                                                                                <a href="#subGroup_{{ $subGroupSpecification->id }}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                                                    role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                                                    <h6 class="m-0 font-weight-bold text-primary">{{ $subGroupSpecification->name }}</h6>
                                                                                </a>
                                                                                <!-- Card Content - Collapse -->
                                                                                <div class="collapse" id="subGroup_{{ $subGroupSpecification->id }}">
                                                                                    <div class="card-body">
                                                                                        <div id="group_area_{{ $subGroupSpecification->id }}">
                                                                                            @foreach($subGroupSpecification->specificationDetails as $specificationDetail)
                                                                                                <div class="row mb-2" id="specificationDetail_{{ $specificationDetail->id  }}">
                                                                                                    <div class="col-lg-10">
                                                                                                        <input type="text" class="form-control form-control-user" value="{{ $specificationDetail->description }}">
                                                                                                    </div>
                                                                                                    <div class="col-lg-2">
                                                                                                        <button class="btn btn-danger btn-user btn-block" onclick="deleteSupplier('specificationDetail_{{ $specificationDetail->id  }}')">X</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <div class="row mb-2 ml-5 mr-5">
                                                                                            <div class="col-lg-6">
                                                                                                <button class="btn btn-primary btn-user btn-block" onclick="addSpecification('group_area_{{ $subGroupSpecification->id }}')">Thêm thông số</button>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <button class="btn btn-success btn-user btn-block" onclick="updateSpecification('group_area_{{ $subGroupSpecification->id }}',' {{ $subGroupSpecification->name }}','{{ $subGroupSpecification->id }}')">Cập nhật</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="col-lg-12">
                                                                        <div class="card shadow mb-4">
                                                                            <!-- Card Header - Accordion -->
                                                                            <a href="#groupSpecificationParent_{{ $groupSpecificationParent->id }}" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                                                role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                                                <h6 class="m-0 font-weight-bold text-primary">Thêm chỉ số khác</h6>
                                                                            </a>
                                                                            <!-- Card Content - Collapse -->
                                                                            <div class="collapse" id="groupSpecificationParent_{{ $groupSpecificationParent->id }}">
                                                                                <div class="card-body">
                                                                                    <form action="{{ route('postAddSubGroupSpecification') }}" method="POST">
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col-lg-8">
                                                                                                <input type="text" class="form-control form-control-user" name="name">
                                                                                                <input type="hidden" name="parentid" value="{{ $groupSpecificationParent->id }}">
                                                                                            </div>
                                                                                            <div class="col-lg-4">
                                                                                                <button type="submit" class="btn btn-success btn-user btn-block">Thêm chỉ số</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-12">
                                                    <div class="card shadow mb-4">
                                                        <a href="#collapseCardExample_1_2" class="d-block card-header py-3 collapsed" data-toggle="collapse"
                                                        role="button" aria-expanded="false" aria-controls="collapseCardExample">
                                                        <h6 class="m-0 font-weight-bold text-primary">Thông tin chung</h6>
                                                    </a>
                                                    <div class="collapse" id="collapseCardExample_1_2">
                                                        <div class="card-body">
                                                            This is a collapsable card example using Bootstrap's built in collapse
                                                            functionality. <strong>Click on the card header</strong> to see the card body
                                                            collapse and expand!
                                                        </div>
                                                    </div>
                                                </div> -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('/assets/js/manageproducts.js') }}"></script>
@endpush