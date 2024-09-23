@extends('Admin.Layout.AdminLayout')
@section('AdminContent')
    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Site Info</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Site Info</li>
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


                        <form action="{{ url('admin/site-info-update')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>time zone</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->time_zone }}" name="time_zone" placeholder="time zone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site name</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_name }}" name="site_name" placeholder="site name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site title</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_title }}" name="site_title" placeholder="site title">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site email</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_email }}" name="site_email" placeholder="site email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site contact</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_contact }}" name="site_contact" placeholder="site contact">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site address</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_address }}" name="site_address" placeholder="site address">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site description</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_description }}" name="site_description" placeholder="site description">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site time</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_time }}" name="site_time" placeholder="site time">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>site link</label>
                                        <input type="text" class="form-control" value="{{ $SiteCommon->site_link }}" name="site_link" placeholder="site link">
                                    </div>
                                </div>


                                <input id="showTagId" type="text" class="form-control d-none" name="site_keyword" value="{{ $SiteCommon->site_keyword }}" placeholder="Site Keyword">
                                <div class="col-md-12 tag_input">
                                    <div class="wrapper">
                                        <div class="title">
                                            <label>site keyword</label>
                                            <a id="removeBtn">All <i class="fas fa-trash"></i></a>
                                        </div>
                                        <div class="content">
                                            <ul id="ulId">
                                                <input id="inputId" type="text" spellcheck="false">
                                            </ul>
                                            <p><span id="detailsItem">10</span> tags are remaining</p>
                                        </div>
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


    </script>
@endsection
