@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">Post</h6>
                            <a href="{{ route('getAddPost') }}" class="btn btn-success btn-icon-split float-right">
                                <span class="text">Thêm Bài Viết</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Hình Ảnh</th>
                                            <th>Tên Bài Viết</th>
                                            <th>Người Viết Bài</th>
                                            <th>Danh Mục Bài Viết</th>
                                            <!-- <th>Salary</th> -->
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <<th class="col-1">Hình Ảnh</th>
                                            <th>Tên Bài Viết</th>
                                            <th>Người Viết Bài</th>
                                            <th>Danh Mục Bài Viết</th>
                                            <!-- <th>Salary</th> -->
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($posts as $post)
                                        <tr>
                                            <td>
                                            <img src="{{ $post->LinkThumbnail }}" alt="" style="max-width: 100%;">
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->PostCreator }}</td>
                                            <td>{{ $post->CategoryName }}</td>
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
                                                            <form method="POST" action="{{ route('deletePost', ['id' => $post->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="dropdown-item" href="{{ route('deletePost', ['id' => $post->id]) }}" onclick="event.preventDefault(); this.closest('form').submit();" disabled>Xóa</a>
                                                            </form>
                                                            <a class="dropdown-item" href="{{ route('getUpdatePost', ['id' => $post->id]) }}">Update</a>
                                                            <!-- <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Something else here</a> -->
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
@endpush
