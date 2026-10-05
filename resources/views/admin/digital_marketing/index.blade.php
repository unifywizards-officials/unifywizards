@extends('layouts.app')

@section('title', 'Digital Marketing Services')

@push('css')
    <style>
        .w-125px {
            width: 125px !important;
        }
    </style>

    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
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

        <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item active">
            Digital Marketing Services
        </li>

    </ol>
    <!-- END breadcrumb -->

    <!-- BEGIN page-header -->
    <h1 class="page-header">
        Digital Marketing Services
    </h1>
    <!-- END page-header -->

    <!-- BEGIN panel -->
    <div class="panel panel-inverse">

        <!-- BEGIN panel-heading -->
        <div class="panel-heading">

            <h4 class="panel-title">
                
                @can('service-create')

                <a href="{{ route('admin.dm.page.create') }}" class="btn btn-primary w-125px" data-bs-toggle="tooltip"
                    title="Add Service">

                    Add Service

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
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table id="data-table-default" width="100%"
                class="table table-striped table-bordered align-middle text-nowrap">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Service Type</th>

                        <th>Page Name</th>

                        <th>Service Title</th>

                        <th>Footer Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($pages as $service)
                        @php
                            $banner = $service->s1_banner;
                        @endphp
                        <tr>

                            <td>{{ $service['id'] }}</td>

                            <td>
                                <strong>
                                    {{ $service['service_type'] }}
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    {{ $service['page_name'] }}
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    {{ $banner['sub_title'] }}
                                </strong>
                            </td>
                            
                               <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input footerStatusToggle" type="checkbox"
                                        data-id="{{ $service->id }}" {{ $service->footer_status ? 'checked' : '' }}>
                                </div>
                            </td>



                            <td>

                                <div class="btn-group">
                                  @can('service-edit')
                                    <a href="{{ route('admin.dm.page.edit', $service['id']) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fa fa-pencil"></i>

                                    </a>
                                    
                                    @endcan
                                     
                                     @can('service-delete')
                                    <button type="button" class="btn btn-danger btn-sm deleteServiceBtn"
                                        style="margin-left: 5px;"
                                        data-url="{{ route('admin.dm.page.destroy', $service['id']) }}"
                                        data-title="{{ $service['page_name'] }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    
                                    @endcan

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
        <!-- END panel-body -->

    </div>
    <!-- END panel -->

    <!-- Delete Service Modal -->
    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Delete Service
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body text-center">

                    <i class="fa fa-trash text-danger mb-3" style="font-size:60px;">
                    </i>

                    <h4>
                        Are you sure?
                    </h4>

                    <p class="text-muted">
                        You are about to delete:
                    </p>

                    <strong id="deleteServiceTitle"></strong>

                    <p class="text-danger mt-2 mb-0">
                        This action cannot be undone.
                    </p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form id="deleteServiceForm" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Yes, Delete
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const deleteModalElement =
                document.getElementById('deleteServiceModal');

            const deleteModal =
                new bootstrap.Modal(deleteModalElement);

            const deleteForm =
                document.getElementById('deleteServiceForm');

            const deleteTitle =
                document.getElementById('deleteServiceTitle');

            document.querySelectorAll('.deleteServiceBtn')
                .forEach(button => {

                    button.addEventListener('click', function() {

                        deleteForm.action =
                            this.dataset.url;

                        deleteTitle.innerText =
                            this.dataset.title;

                        deleteModal.show();

                    });

                });

        });
    </script>
    
        <script>
        $(document).on('change', '.footerStatusToggle', function() {

            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.dm.page.footer.status', ':id') }}"
                    .replace(':id', id),

                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    footer_status: status
                },

                success: function(response) {
                    console.log('Status Updated');
                }
            });

        });
    </script>
@endpush
