@extends('Admin.Layout.AdminLayout')
@section('AdminContent')
    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Common Page Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Common Page Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-default">

                    <div class="card-header">

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin/') }}/common-page-list">
                            All Data
                        </a>


                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>



                    <div class="card-body">


                        @if ($errors->any())
                            <div class="alert alert-default-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @if (session('success_message'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('success_message') }}
                            </div>
                        @elseif (session('error_message'))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('error_message') }}
                            </div>
                        @else

                        @endif

                        <form action="{{ url('admin/common-page-update/'.$CommonPage->page_id)}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ $CommonPage->page_title }}" name="page_title" placeholder="Title">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="page_image">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img class="img-fluid w-100 rounded" src="{{asset($CommonPage->page_image)}}" alt="Photo">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" id="page_description" name="page_description" placeholder="Description ...">{{ $CommonPage->page_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Page Link</label>
                                        <input type="text" class="form-control" value="{{ $CommonPage->page_link }}" name="page_link" placeholder="Page Link">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="common_page_status" name="status">
                                            <option value="" selected="selected">Select One</option>
                                            <option value="1" @if($CommonPage->status == "1") {{ 'selected' }} @endif>Active</option>
                                            <option value="2" @if($CommonPage->status == "2") {{ 'selected' }} @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('AdminScript')
    <script>
        $('#common_page_status').select2();
        $('#page_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });
    </script>
@endsection
