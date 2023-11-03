<script>
    var users = {!! json_encode($users) !!};
</script>
@extends('Layout')
@section('content')
@include('sweetalert::alert')
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary float-left">User</h6>
                            <a href="{{ route('getAddUser') }}" class="btn btn-success btn-icon-split float-right">
                                <span class="text">Thêm User</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Họ Và Tên</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email</th>
                                            <th>Chức Vụ</th>
                                            <th>Phân Quyền</th>
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Họ Và Tên</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email</th>
                                            <th>Chức Vụ</th>
                                            <th>Phân Quyền</th>
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td id="name_{{ $user->id }}">{{ $user->firstname.' '.$user->lastname }}</td>
                                            <td id="phone_{{ $user->id }}">{{ $user->phone }}</td>
                                            <td id="email_{{ $user->id }}">{{ $user->email }}</td>
                                            <td>
                                                <div style="height:100%">
                                                    <label onclick="{initializeMobiscrollSelect('select-position-{{ $user->id }}', 'input-position-{{ $user->id }}')}">
                                                        Multi-select
                                                        <input mbsc-input class="input-multiple-select" id="input-position-{{ $user->id }}" placeholder="Please select..." data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" />
                                                    </label>
                                                    <select style="display: none" id="select-position-{{ $user->id }}" multiple>
                                                        @foreach($positionDetails as $positionDetail)
                                                            @php
                                                                $found = false;
                                                            @endphp
                                                            @foreach($user->positions as $position)
                                                                @if($position->position_detail_id == $positionDetail->id)
                                                                    <option value="{{ $positionDetail->id }}" {{ $position->position_detail_id == $positionDetail->id ? 'selected' : '' }}>{{ $positionDetail->name_position }}</option>
                                                                    @php
                                                                        $found = true;
                                                                    @endphp
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @if(!$found)
                                                            <option value="{{ $positionDetail->id }}">{{ $positionDetail->name_position }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="height:100%">
                                                    <label onclick="{initializeMobiscrollSelect('select-{{ $user->id }}', 'input-{{ $user->id }}')}">
                                                        Multi-select
                                                        <input mbsc-input class="input-multiple-select" id="input-{{ $user->id }}" placeholder="Please select..." data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" />
                                                    </label>
                                                    <select style="display: none" id="select-{{ $user->id }}" multiple>
                                                        @foreach($authorizationdetails as $authorizationdetail)
                                                            @php
                                                                $found = false;
                                                            @endphp
                                                            @foreach($user->authorizations as $authorization)
                                                                @if($authorizationdetail->id == $authorization->authorid)
                                                                    <option value="{{ $authorizationdetail->id }}" {{ $authorizationdetail->id == $authorization->authorid ? 'selected' : '' }}>{{ $authorizationdetail->name_author }}</option>
                                                                    @php
                                                                        $found = true;
                                                                    @endphp
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @if(!$found)
                                                                <option value="{{ $authorizationdetail->id }}">{{ $authorizationdetail->name_author }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
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
                                                            <form method="POST" action="{{ route('deleteUser', ['id' => $user->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <a class="dropdown-item" href="" onclick="event.preventDefault(); this.closest('form').submit();" disabled>Xóa</a>
                                                            </form>
                                                            <a class="dropdown-item" onclick="UpdateUser('name_{{ $user->id }}', 'phone_{{ $user->id }}', 'email_{{ $user->id }}', 'select-position-{{ $user->id }}', 'select-{{ $user->id }}', '{{ $user->id }}')">Update</a>
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
    <script type="text/javascript" src="{{ asset('/assets/js/users.js') }}"></script>
@endpush
