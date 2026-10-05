@extends('layouts.app')

@section('content')
    <h1 class="page-header">
        Manage Industries
    </h1>

    <div class="panel panel-inverse">

        <div class="panel-heading">

            <h4 class="panel-title">
                Industries Section
            </h4>

        </div>

        <div class="panel-body">

            {{-- ADD INDUSTRY FORM --}}
            <form action="{{ route('admin.about-us.industry.update', 0) }}" method="POST">

                @csrf

                <div class="row">

                    {{-- ICON --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Icon
                        </label>

                        <input type="text" name="icon" class="form-control" placeholder="🚗">

                    </div>

                    {{-- TITLE --}}
                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input type="text" name="title" class="form-control">

                    </div>

                    {{-- SORT ORDER --}}
                    <div class="col-md-2 mb-3">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input type="number" name="sort_order" class="form-control" value="0">

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-2 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-control">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea name="description" class="form-control" rows="4"></textarea>

                </div>

                <button type="submit" class="btn btn-success">

                    Add Industry

                </button>

            </form>

        </div>

    </div>

    {{-- LISTING --}}

    <div class="panel panel-inverse mt-4">

        <div class="panel-heading">

            <h4 class="panel-title">
                Industry List
            </h4>

        </div>

        <div class="panel-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="80">
                            ID
                        </th>

                        <th width="100">
                            Icon
                        </th>

                        <th>
                            Title
                        </th>

                        <th>
                            Description
                        </th>



                        <th width="220">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($industries as $industry)
                        <tr>

                            <td style="width:2%">
                                {{ $industry->id }}
                            </td>

                            <td style="font-size:20px;width:10%">
                                {{ $industry->icon }}
                            </td>

                            <td style="width:15%">
                                {{ $industry->title }}
                            </td>

                            <td style="width:25%">
                                {{ $industry->description }}
                            </td>





                            <td>

                                {{-- EDIT FORM --}}

                                <form action="{{ route('admin.about-us.industry.update', $industry->id) }}" method="POST">

                                    @csrf

                                    <div class="row">

                                        <div class="col-md-12 mb-2">

                                            <input type="text" name="icon" class="form-control"
                                                value="{{ $industry->icon }}">

                                        </div>

                                        <div class="col-md-12 mb-2">

                                            <input type="text" name="title" class="form-control"
                                                value="{{ $industry->title }}">

                                        </div>

                                        <div class="col-md-12 mb-2">

                                            <textarea name="description" class="form-control" rows="3">{{ $industry->description }}</textarea>

                                        </div>

                                        <div class="col-md-6 mb-2">

                                            <input type="number" name="sort_order" class="form-control"
                                                value="{{ $industry->sort_order }}">

                                        </div>

                                        <div class="col-md-6 mb-2">

                                            <select name="status" class="form-control">

                                                <option value="1" {{ $industry->status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0" {{ $industry->status == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">

                                        Update

                                    </button>


                                </form>

                                <form action="{{ route('admin.about-us.industry.delete', $industry->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this industry?')" style="margin-top:10px;">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center">
                                No Industries Found
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection
