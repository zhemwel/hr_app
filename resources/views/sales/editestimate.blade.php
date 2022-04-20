
@extends('layouts.master')
@section('content')
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-dashboard"></i>
                            <span> Dashboard</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ route('home') }}">Admin Dashboard</a></li>
                            <li><a href="{{ route('em/dashboard') }}">Employee Dashboard</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->role_name=='Admin')
                        <li class="menu-title"> <span>Authentication</span> </li>
                        <li class="submenu">
                            <a href="#">
                                <i class="la la-user-secret"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                            </a>
                            <ul style="display: none;">
                                <li><a href="{{ route('userManagement') }}">All User</a></li>
                                <li><a href="{{ route('activity/log') }}">Activity Log</a></li>
                                <li><a href="{{ route('activity/login/logout') }}">Activity User</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="menu-title">
                        <span>Employees</span>
                    </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user"></i>
                            <span> Employees</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ route('all/employee/card') }}">All Employees</a></li>
                            <li><a href="{{ route('form/holidays/new') }}">Holidays</a></li>
                            <li><a href="{{ route('form/leaves/new') }}">Leaves (Admin) 
                                <span class="badge badge-pill bg-primary float-right">1</span></a>
                            </li>
                            <li><a href="{{route('form/leavesemployee/new')}}">Leaves (Employee)</a></li>
                            <li><a href="{{ route('form/leavesettings/page') }}">Leave Settings</a></li>
                            <li><a href="{{ route('attendance/page') }}">Attendance (Admin)</a></li>
                            <li><a href="{{ route('attendance/employee/page') }}">Attendance (Employee)</a></li>
                            <li><a href="{{ route('form/departments/page') }}">Departments</a></li>
                            <li><a href="designations.html">Designations</a></li>
                            <li><a href="timesheet.html">Timesheet</a></li>
                            <li><a href="shift-scheduling.html">Shift & Schedule</a></li>
                            <li><a href="overtime.html">Overtime</a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>HR</span> </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot">
                            <i class="la la-files-o"></i>
                            <span> Sales </span> 
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a class="active" href="{{ route('form/estimates/page') }}">Estimates</a></li>
                            <li><a href="{{ route('form/invoice/view/page') }}">Invoices</a></li>
                            <li><a href="payments.html">Payments</a></li>
                            <li><a href="expenses.html">Expenses</a></li>
                            <li><a href="provident-fund.html">Provident Fund</a></li>
                            <li><a href="taxes.html">Taxes</a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-money"></i>
                        <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
                            <li><a href="{{ url('form/salary/view') }}"> Payslip </a></li>
                            <li><a href="{{ route('form/payroll/items') }}"> Payroll Items </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i>
                        <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/expense/reports/page') }}"> Expense Report </a></li>
                            <li><a href="{{ route('form/invoice/reports/page') }}"> Invoice Report </a></li>
                            <li><a href="payments-reports.html"> Payments Report </a></li>
                            <li><a href="employee-reports.html"> Employee Report </a></li>
                            <li><a href="payslip-reports.html"> Payslip Report </a></li>
                            <li><a href="attendance-reports.html"> Attendance Report </a></li>
                            <li><a href="{{ route('form/leave/reports/page') }}"> Leave Report </a></li>
                            <li><a href="{{ route('form/daily/reports/page') }}"> Daily Report </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Performance</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-graduation-cap"></i>
                        <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/performance/indicator/page') }}"> Performance Indicator </a></li>
                            <li><a href="{{ route('form/performance/page') }}"> Performance Review </a></li>
                            <li><a href="{{ route('form/performance/appraisal/page') }}"> Performance Appraisal </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-edit"></i>
                        <span> Training </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/training/list/page') }}"> Training List </a></li>
                            <li><a href="{{ route('form/trainers/list/page') }}"> Trainers</a></li>
                            <li><a href="{{ route('form/training/type/list/page') }}"> Training Type </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Administration</span> </li>
                    <li> <a href="assets.html"><i class="la la-object-ungroup">
                        </i> <span>Assets</span></a>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-briefcase"></i>
                        <span> Jobs </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="user-dashboard.html"> User Dasboard </a></li>
                            <li><a href="jobs-dashboard.html"> Jobs Dasboard </a></li>
                            <li><a href="jobs.html"> Manage Jobs </a></li>
                            <li><a href="manage-resumes.html"> Manage Resumes </a></li>
                            <li><a href="shortlist-candidates.html"> Shortlist Candidates </a></li>
                            <li><a href="interview-questions.html"> Interview Questions </a></li>
                            <li><a href="offer_approvals.html"> Offer Approvals </a></li>
                            <li><a href="experiance-level.html"> Experience Level </a></li>
                            <li><a href="candidates.html"> Candidates List </a></li>
                            <li><a href="schedule-timing.html"> Schedule timing </a></li>
                            <li><a href="apptitude-result.html"> Aptitude Results </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Pages</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-user"></i>
                        <span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="profile.html"> Employee Profile </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
                
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Estimate</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Estimate</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Client <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Please Select</option>
                                        <option selected>Barry Cuda</option>
                                        <option>Tressa Wexler</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Project <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select Project</option>
                                        <option selected>Office Management</option>
                                        <option>Project Management</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" value="barrycuda@example.com">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Tax</label>
                                    <select class="select">
                                        <option>Select Tax</option>
                                        <option>VAT</option>
                                        <option selected>GST</option>
                                        <option>No Tax</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Client Address</label>
                                    <textarea class="form-control" rows="3">5754 Airport Rd, Coosada, AL, 36020</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Billing Address</label>
                                    <textarea class="form-control" rows="3">5754 Airport Rd, Coosada, AL, 36020</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Estimate Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" value="2019/05/20">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Expiry Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" value="2019/05/27">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-white">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px">#</th>
                                                <th class="col-sm-2">Item</th>
                                                <th class="col-md-6">Description</th>
                                                <th style="width:100px;">Unit Cost</th>
                                                <th style="width:80px;">Qty</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input class="form-control" type="text" value="Vehicle Module" style="min-width:150px">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" value="Create, edit delete functionlity" style="min-width:150px">
                                            </td>
                                            <td>
                                                <input class="form-control" style="width:100px" type="text" value="112">
                                            </td>
                                            <td>
                                                <input class="form-control" style="width:80px" type="text" value="1">
                                            </td>
                                            <td>
                                                <input class="form-control" readonly style="width:120px" type="text" value="112">
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-success font-18" title="Add"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <input class="form-control" type="text" value="Vehicle Module" style="min-width:150px">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" value="Create, edit delete functionlity" style="min-width:150px">
                                            </td>
                                            <td>
                                                <input class="form-control" style="width:100px" type="text" value="112">
                                            </td>
                                            <td>
                                                <input class="form-control" style="width:80px" type="text" value="1">
                                            </td>
                                            <td>
                                                <input class="form-control" readonly style="width:120px" type="text" value="112">
                                            </td>
                                            <td><a href="javascript:void(0)" class="text-danger font-18" title="Remove"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-white">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Total</td>
                                                <td style="text-align: right; width: 230px">112</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: right">Tax</td>
                                                <td style="text-align: right;width: 230px">
                                                    <input class="form-control text-right" value="0" readonly type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: right">
                                                    Discount %
                                                </td>
                                                <td style="text-align: right; width: 230px">
                                                    <input class="form-control text-right" value="0" type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: right; font-weight: bold">
                                                    Grand Total
                                                </td>
                                                <td style="text-align: right; font-weight: bold; font-size: 16px;width: 230px">
                                                    $ 112
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                               
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Other Information</label>
                                            <textarea class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn m-r-10">Save & Send</button>
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->

    @section('script')
   
    @endsection
@endsection
