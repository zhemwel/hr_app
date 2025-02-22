@extends('layouts.master')
@section('content')
   	<!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="page-title">Shortlist Candidates</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item">Jobs</li>
                            <li class="breadcrumb-item active">Shortlist Candidates</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Job Title</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="profile.html" class="avatar"><img alt="" src="{{ URL::to('assets/img/profiles/avatar-19.jpg') }}"></a>
                                            <a href="profile.html">John Doe <span>Web Designer</span></a>
                                        </h2>
                                    </td>
                                    <td><a href="job-details.html">Web Developer</a></td>
                                    <td>Development</td>
                                    <td>
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Offered
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="profile.html" class="avatar"><img alt="" src="{{ URL::to('assets/img/profiles/avatar-19.jpg') }}"></a>
                                            <a href="profile.html">Richard Miles <span>Web Developer</span></a>
                                        </h2>
                                    </td>
                                    <td><a href="job-details.html">Web Designer</a></td>
                                    <td>Designing</td>
                                    <td>
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Offered
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="profile.html" class="avatar"><img alt="" src="{{ URL::to('assets/img/profiles/avatar-19.jpg') }}"></a>
                                            <a href="profile.html">John Smith <span>Android Developer</span></a>
                                        </h2>
                                    </td>
                                    <td><a href="job-details.html">Android Developer</a></td>
                                    <td>Android</td>
                                    <td>
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Offered
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

@endsection
