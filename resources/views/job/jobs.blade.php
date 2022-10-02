@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Wrapper -->
    <div class="page-wrapper">		
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Jobs</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Jobs</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_job"><i class="fa fa-plus"></i> Add Job</a>
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
                                    <th>No</th>
                                    <th>Job Title</th>
                                    <th>Department</th>
                                    <th>Start Date</th>
                                    <th>Expire Date</th>
                                    <th class="text-center">Job Type</th>
                                    <th class="text-center">Status</th>
                                    <th>Applicants</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job_list as $key=>$items )
                                    
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><a href="{{ url('job/details/'.$items->id) }}">{{ $items->job_title }}</a></td>
                                    <td>{{ $items->department }}</td>
                                    <td>{{ date('d F, Y',strtotime($items->start_date)) }}</td>
                                    <td>{{ date('d F, Y',strtotime($items->expired_date)) }}</td>
                                    <td class="text-center">
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> {{ $items->job_type }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Full Time</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Part Time</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Internship</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Temporary</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Other</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> {{ $items->status }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Open</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Closed</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Cancelled</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('job/applicants') }}" class="btn btn-sm btn-primary">3 Candidates</a></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_job"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_job"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
        <!-- Add Job Modal -->
        <div id="add_job" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/jobs/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input class="form-control @error('job_title') is-invalid @enderror" type="text" name="job_title" value="{{ old('job_title') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="select @error('department') is-invalid @enderror" name="department">
                                            <option selected disabled>--Selete--</option>
                                            @foreach ($department as $value)
                                            <option value="{{ $value->department }}" {{ old('department') == $value->department ? "selected" :""}}>{{ $value->department }}</option>
                                            @endforeach
                                        </select>
                                    </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Location</label>
                                        <textarea class="form-control @error('job_location') is-invalid @enderror" name="job_location" style="height: 44px;">{{ old('job_location') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No of Vacancies</label>
                                        <input class="form-control @error('no_of_vacancies') is-invalid @enderror" type="text" name="no_of_vacancies" value="{{ old('no_of_vacancies') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input class="form-control @error('experience') is-invalid @enderror" type="text" name="experience" value="{{ old('experience') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control @error('age') is-invalid @enderror" type="number" name="age" value="{{ old('age') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Salary From</label>
                                        <input type="text" class="form-control @error('salary_from') is-invalid @enderror" name="salary_from" value="{{ old('salary_from') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Salary To</label>
                                        <input type="text" class="form-control @error('salary_to') is-invalid @enderror" name="salary_to" value="{{ old('salary_to') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Type</label>
                                        <select class="select @error('tob_type') is-invalid @enderror" name="job_type">
                                            <option selected disabled>--select--</option>
                                            @foreach ($type_job as $job )
                                            <option value="{{ $job->name_type_job }}" {{ old('job_type') == $job->name_type_job ? "selected" :""}}>{{ $job->name_type_job }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select @error('status') is-invalid @enderror" name="status">
                                            <option value="Open">Open</option>
                                            <option value="Closed">Closed</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control datetimepicker @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expired Date</label>
                                        <input type="text" class="form-control datetimepicker @error('expired_date') is-invalid @enderror" name="expired_date" value="{{ old('expired_date') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Job Modal -->
        
        <!-- Edit Job Modal -->
        <div id="edit_job" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input class="form-control" type="text" value="Web Developer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="select">
                                            <option>-</option>
                                            <option selected>Web Development</option>
                                            <option>Application Development</option>
                                            <option>IT Management</option>
                                            <option>Accounts Management</option>
                                            <option>Support Management</option>
                                            <option>Marketing</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Location</label>
                                        <input class="form-control" type="text" value="California">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No of Vacancies</label>
                                        <input class="form-control" type="text" value="5">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input class="form-control" type="text" value="2 Years">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control" type="text" value="-">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Salary From</label>
                                        <input type="text" class="form-control" value="32k">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Salary To</label>
                                        <input type="text" class="form-control" value="38k">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Type</label>
                                        <select class="select">
                                            <option selected>Full Time</option>
                                            <option>Part Time</option>
                                            <option>Internship</option>
                                            <option>Temporary</option>
                                            <option>Remote</option>
                                            <option>Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="select">
                                            <option selected>Open</option>
                                            <option>Closed</option>
                                            <option>Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control datetimepicker" value="3 Mar 2019">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expired Date</label>
                                        <input type="text" class="form-control datetimepicker" value="31 May 2019">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Job Modal -->

        <!-- Delete Job Modal -->
        <div class="modal custom-modal fade" id="delete_job" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Job</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Job Modal -->
    </div>
    <!-- /Page Wrapper -->
@endsection