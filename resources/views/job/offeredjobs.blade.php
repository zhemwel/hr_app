@extends('layouts.master')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Offered Jobs</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item ">Jobs</li>
                            <li class="breadcrumb-item ">User Dashboard</li>
                            <li class="breadcrumb-item active">Offered Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="card">
                <div class="card-body">
                    @include('sidebar.sidebarjob')
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select</option>
                            <option>Development</option>
                            <option>Designing</option>
                            <option>Android</option>
                        </select>
                        <label class="focus-label">Department</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select</option>
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Internship</option>
                        </select>
                        <label class="focus-label">Job Type</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select Designation</option>
                            <option>Web Developer</option>
                            <option>Web Designer</option>
                            <option>Android Developer</option>
                            <option>Ios Developer</option>
                        </select>
                        <label class="focus-label">Designation</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <!-- Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Job Title</th>
                                    <th>Department</th>
                                    <th>Job Type</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="job-details.html">Web Developer</a></td>
                                    <td>Development</td>
                                    <td>
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Full Time
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info download-offer"><span><i class="fa fa-download mr-1"></i> Download Offer</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="job-details.html">Web Designer</a></td>
                                    <td>Designing</td>
                                    <td>
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-success"></i> Part Time
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info download-offer"><span><i class="fa fa-download mr-1"></i> Download Offer</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="job-details.html">Android Developer</a></td>
                                    <td>Android</td>
                                    <td>
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Internship
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info download-offer"><span><i class="fa fa-download mr-1"></i> Download Offer</span></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection
