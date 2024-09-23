@extends('Admin.Layout.AdminLayout')
@section('AdminContent')
    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Site Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Site Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-default">

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


                        <form action="{{ url('admin/site-data-update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>about title</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_about_title }}" name="site_about_title" placeholder="about title">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>about image</label>
                                        <input type="file" class="form-control" name="site_about_img">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img class="img-fluid w-100 rounded" src="{{asset($SiteCommon->site_about_img)}}" alt="Photo">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>about description</label>
                                        <textarea class="form-control" id="site_about_description" name="site_about_description" placeholder="Description ...">{{ $SiteCommon->site_about_description }}</textarea>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>welcome_title</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_welcome_title }}" name="site_welcome_title" placeholder="welcome title">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>welcome Video</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_welcome_video }}" name="site_welcome_video" placeholder="welcome video">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>site map</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_map }}" name="site_map" placeholder="site map">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>welcome description</label>
                                        <textarea class="form-control" id="site_welcome_description" name="site_welcome_description" placeholder="Description ...">{{ $SiteCommon->site_welcome_description }}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 text-center mt-3">
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
        $('#site_about_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });
        $('#site_welcome_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });
    </script>
@endsection
