@extends('layouts.app')

@section('title', 'Users')

@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <style>
        /* Role select styling */
        .role-select {
            min-width: 130px;
            font-size: 13px;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            cursor: pointer;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .role-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.25);
            outline: none;
        }

        /* Saving spinner state */
        .role-select.saving {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Success flash on select */
        .role-select.role-saved {
            border-color: #1cc88a !important;
            box-shadow: 0 0 0 2px rgba(28, 200, 138, 0.3) !important;
            transition: all 0.3s ease;
        }

        /* Error flash on select */
        .role-select.role-error {
            border-color: #e74a3b !important;
            box-shadow: 0 0 0 2px rgba(231, 74, 59, 0.3) !important;
        }

        /* Inline toast */
        .role-toast {
            display: inline-block;
            font-size: 11px;
            margin-left: 6px;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .role-toast.show {
            opacity: 1;
        }

        .role-toast.success {
            background: #d4edda;
            color: #155724;
        }

        .role-toast.error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
@endpush

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>
@endpush

@section('content')
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Users</a></li>
    </ol>
    <!-- END breadcrumb -->

    <h1 class="page-header">Users</h1>

    <div class="panel panel-inverse">
        <!-- BEGIN panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">
                @can('user-create')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary w-100px" title="Add User">
                        Add User
                    </a>
                @endcan
            </h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
                    <i class="fa fa-expand"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload">
                    <i class="fa fa-redo"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
                    <i class="fa fa-minus"></i>
                </a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <!-- END panel-heading -->

        <!-- BEGIN panel-body -->
        <div class="panel-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <table id="data-table-default" width="100%"
                class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%" data-orderable="false">Photo</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Phone</th>
                        <th class="text-nowrap">Role</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr class="odd gradeX">

                            {{-- Sr. No --}}
                            <td width="1%" class="fw-bold">{{ $key + 1 }}</td>

                            {{-- Profile Image --}}
                            <td width="1%" class="with-img">
                                @if ($user->profile_image)
                                    <img class="rounded h-30px my-n1 mx-n1"
                                        src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" />
                                @else
                                    <img src="/assets/img/user/user-13.jpg" class="rounded h-30px my-n1 mx-n1"
                                        alt="Default" />
                                @endif
                            </td>

                            {{-- Name --}}
                            <td>{{ $user->name }}</td>

                            {{-- Email --}}
                            <td>{{ $user->email }}</td>

                            {{-- Phone --}}
                            <td>{{ $user->phone ?? 'N/A' }}</td>

                            {{-- Role Dropdown --}}
                            {{-- Select karte hi AJAX se update hoga --}}
                            <td>
                                @can('user-assign-role')
                                    <div class="d-flex align-items-center">
                                        <select class="form-control role-select" data-user-id="{{ $user->id }}"
                                            data-current-role="{{ $user->roles->first()?->id ?? '' }}"
                                            data-update-url="{{ route('admin.users.update-role', $user->id) }}"
                                            title="Change role">
                                            <option value="" disabled {{ $user->roles->isEmpty() ? 'selected' : '' }}>
                                                Select Role
                                            </option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->roles->first()?->id == $role->id ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- Inline feedback toast --}}
                                        <span class="role-toast" id="toast-{{ $user->id }}"></span>
                                    </div>
                                @endcan
                            </td>

                            {{-- Actions --}}
                            <td>
                                @can('user-edit')
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                        title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan

                                @can('user-view')
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm"
                                        title="Show User">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan

                                @can('user-delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        style="display:inline-block;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- END panel-body -->
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // =========================================
            // DELETE FORM — confirmation
            // =========================================
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete this user?')) {
                        form.submit();
                    }
                });
            });

            // =========================================
            // ROLE SELECT — AJAX save to users table
            // Select karte hi turant save ho jayega
            // =========================================
            document.querySelectorAll('.role-select').forEach(function(select) {

                select.addEventListener('change', function() {

                    const userId = this.dataset.userId;
                    const roleId = this.value;
                    const previousRole = this.dataset.currentRole;
                    const updateUrl = this.dataset.updateUrl;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const toast = document.getElementById('toast-' + userId);

                    if (!roleId) return;

                    // Skip if same role is selected (no change needed)
                    if (String(roleId) === String(previousRole)) {
                        if (toast) {
                            toast.className = 'role-toast success show';
                            toast.textContent = 'Already saved';
                        }
                        setTimeout(() => {
                            if (toast) toast.classList.remove('show');
                        }, 1500);
                        return;
                    }

                    this.classList.add('saving');
                    this.disabled = true;
                    if (toast) {
                        toast.className = 'role-toast';
                        toast.textContent = 'Saving...';
                        toast.classList.add('show');
                    }

                    fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                role_id: roleId
                            }),
                        })
                        .then(async response => {
                            this.classList.remove('saving');
                            const contentType = response.headers.get('content-type');
                            const isJson = contentType && contentType.includes(
                                'application/json');
                            if (!response.ok) {
                                if (isJson) {
                                    const err = await response.json();
                                    throw err;
                                }
                                throw new Error('HTTP error ' + response.status);
                            }
                            return isJson ? response.json() : {
                                success: true
                            };
                        })
                        .then(data => {
                            this.disabled = false;
                            this.classList.remove('role-saved', 'role-error');
                            if (data.success) {
                                this.dataset.currentRole = roleId;
                                this.classList.add('role-saved');
                                if (toast) {
                                    toast.className = 'role-toast success show';
                                    toast.textContent = 'Saved!';
                                }
                                setTimeout(() => {
                                    this.classList.remove('role-saved');
                                    if (toast) toast.classList.remove('show');
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Update failed');
                            }
                        })
                        .catch(error => {
                            this.disabled = false;
                            this.classList.remove('saving', 'role-saved');
                            this.classList.add('role-error');
                            this.value = previousRole;
                            this.dataset.currentRole = previousRole;
                            const message = error.message || 'Something went wrong';
                            console.error('Role update error:', message, error);
                            if (toast) {
                                toast.className = 'role-toast error show';
                                toast.textContent = typeof message === 'string' ? message :
                                    'Error';
                            }
                            setTimeout(() => {
                                this.classList.remove('role-error');
                                if (toast) toast.classList.remove('show');
                            }, 3000);
                        });

                }); // change end

            }); // forEach end

        }); // DOMContentLoaded end
    </script>
@endpush
