@extends('Admin.Layout.AdminLayout')
@section('AdminContent')
    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Testimonial</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/panel/') }}/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Testimonial</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">





        @if(!$Testimonial->isEmpty())

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/panel/') }}/testimonial-create">
                            Add <i class="fas fa-plus"></i>
                        </a>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>

                    </div>
                    <div class="card-body p-0">

                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 1%">
                                    SL
                                </th>
                                <th style="width: 30%">
                                    Title
                                </th>
                                <th style="width: 30%">
                                    Designation
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th style="width: 20%" class="text-right">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($Testimonial as $key=>$TestimonialItem)

                                <tr>
                                    <td>{{ $key+1 }}</td>

                                    <td>
                                        <a>{{ $TestimonialItem->testimonial_name }}</a>
                                    </td>
                                    <td>
                                        <a>{{ $TestimonialItem->testimonial_designation }}</a>
                                    </td>
                                    <td class="project-state">
                                        @if($TestimonialItem->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($TestimonialItem->status == 2)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ url('/panel/') }}/testimonial-edit/{{ $TestimonialItem->testimonial_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        {{ $Testimonial->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>

            @else
                <div class="card">
                    <div class="card-header">

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/panel/') }}/testimonial-create">
                            Add <i class="fas fa-plus"></i>
                        </a>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>

                    </div>
                </div>
                @include('Admin.Common.DataNotFound')
            @endif

        </section>
        <!-- /.content -->
    </div>

@endsection

@section('AdminScript')
    <script>

    </script>
@endsection
