
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
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Performance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Performance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <section class="review-section information">
                <div class="review-header text-center">
                    <h3 class="review-title">Employee Basic Information</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="depart3">Department</label>
                                                    <input type="text" class="form-control" id="depart3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="departa">Designation</label>
                                                    <input type="text" class="form-control" id="departa">
                                                </div>
                                                <div class="form-group">
                                                    <label for="qualif">Qualification: </label>
                                                    <input type="text" class="form-control" id="qualif">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="doj">Emp ID</label>
                                                    <input type="text" class="form-control" value="DGT-009">
                                                </div>
                                                <div class="form-group">
                                                    <label for="doj">Date of Join</label>
                                                    <input type="text" class="form-control" id="doj">
                                                </div>
                                                <div class="form-group">
                                                    <label for="doc">Date of Confirmation</label>
                                                    <input type="text" class="form-control" id="doc">
                                                </div>
                                                <div class="form-group">
                                                    <label for="qualif1">Previous Years Of Exp</label>
                                                    <input type="text" class="form-control" id="qualif1">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name1"> RO's Name</label>
                                                    <input type="text" class="form-control" id="name1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="depart1"> RO Designation: </label>
                                                    <input type="text" class="form-control" id="depart1">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section professional-excellence">
                <div class="review-header text-center">
                    <h3 class="review-title">Professional Excellence</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Key Result Area</th>
                                        <th>Key Performance Indicators</th>
                                        <th>Weightage</th>
                                        <th>Percentage Achieved <br>(Self Score)</th>
                                        <th>Points Scored <br>(Self)</th>
                                        <th>Percentage Achieved <br>(RO's Score)</th>
                                        <th>Points Scored <br>(RO)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">1</td>
                                        <td rowspan="2">Production</td>
                                        <td>Quality</td>
                                        <td><input type="text" class="form-control" readonly value="30"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>TAT (Turn Around Time)</td>
                                        <td><input type="text" class="form-control" readonly value="30"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Process Improvement</td>
                                        <td>PMS, New Ideas</td>
                                        <td><input type="text" class="form-control" readonly value="10"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Team Management</td>
                                        <td>Team Productivity, Dynamics, Attendance, Attrition</td>
                                        <td><input type="text" class="form-control" readonly value="5"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Knowledge Sharing</td>
                                        <td>Sharing The Knowledge For Team Productivity </td>
                                        <td><input type="text" class="form-control" readonly value="5"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Reporting & Communication</td>
                                        <td>Emails/Calls/Reports & Other Communication</td>
                                        <td><input type="text" class="form-control" readonly value="5"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-center">Total </td>
                                        <td><input type="text" class="form-control" readonly value="85"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="review-section personal-excellence">
                <div class="review-header text-center">
                    <h3 class="review-title">Personal Excellence</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Personal Attributes</th>
                                        <th>Key Indicators</th>
                                        <th>Weightage</th>
                                        <th>Percentage Achieved <br>(Self Score)</th>
                                        <th>Points Scored <br>(Self)</th>
                                        <th>Percentage Achieved <br>(RO's Score)</th>
                                        <th>Points Scored <br>(RO)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">1</td>
                                        <td rowspan="2">Attendance</td>
                                        <td>Planned Or Unplanned Leaves</td>
                                        <td><input type="text" class="form-control" readonly value="2"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>Time Consciousness</td>
                                        <td><input type="text" class="form-control" readonly value="2"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">2</td>
                                        <td rowspan="2">Attitude & Behavior</td>
                                        <td>Team Collaboration</td>
                                        <td><input type="text" class="form-control" readonly value="2"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>Professionalism & Responsiveness</td>
                                        <td><input type="text" class="form-control" readonly value="2"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Policy & Procedures </td>
                                        <td>Adherence To Policies And Procedures</td>
                                        <td><input type="text" class="form-control" readonly value="2"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                    <td>4</td>
                                        <td>Initiatives</td>
                                        <td>Special Efforts, Suggestions, Ideas, Etc.</td>
                                        <td><input type="text" class="form-control" readonly value="2"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Continuous Skill Improvement</td>
                                        <td>Preparedness To Move To Next Level & Training Utilization</td>
                                        <td><input type="text" class="form-control" readonly value="3"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-center">Total </td>
                                        <td><input type="text" class="form-control" readonly value="15"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                        <td><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-center"><b>Total Percentage(%)</b></td>
                                        <td colspan="5" class="text-center"><input type="text" class="form-control" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="grade-span">
                                                <h4>Grade</h4>
                                                <span class="badge bg-inverse-danger">Below 65 Poor</span>
                                                <span class="badge bg-inverse-warning">65-74 Average</span>
                                                <span class="badge bg-inverse-info">75-84 Satisfactory</span>
                                                <span class="badge bg-inverse-purple">85-92 Good</span>
                                                <span class="badge bg-inverse-success">Above 92 Excellent</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Special Initiatives, Achievements, Contributions</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-review review-table mb-0" id="table_achievements">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>By Self</th>
                                        <th>RO's Comment</th>
                                        <th>HOD's Comment</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="table_achievements_tbody">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Comments On The Role</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-review review-table mb-0" id="table_alterations">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>By Self</th>
                                        <th>RO's Comment</th>
                                        <th>HOD's Comment</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="table_alterations_tbody">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Comments On The Role</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Strengths</th>
                                        <th>Area's For Improvement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Appraisee's Strengths & Areas For Improvement Perceived By The Reporting Officer</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Strengths</th>
                                        <th>Area's For Improvement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Appraisee's Strengths & Areas For Improvement Perceived By The Head Of The Department</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Strengths</th>
                                        <th>Area's For Improvement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Personal Goals</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Goal Achieved During Last Year</th>
                                        <th>Goal Set For Current Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Personal Updates</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>Last Year</th>
                                        <th>Yes/No</th>
                                        <th>Details</th>
                                        <th>Current Year</th>
                                        <th>Yes/No</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Married / Engaged?</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td>Marriage Plans</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Higher Studies / Certifications?</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td>Plans For Higher Study</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Health Issues?</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td>Certification Plans</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Others</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td>Others</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Professional Goals Achieved For Last Year</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-review review-table mb-0" id="table_goals">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>By Self</th>
                                        <th>RO's Comment</th>
                                        <th>HOD's Comment</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="table_goals_tbody">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Professional Goals For The Forthcoming Year</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-review review-table mb-0" id="table_forthcoming">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">#</th>
                                        <th>By Self</th>
                                        <th>RO's Comment</th>
                                        <th>HOD's Comment</th>
                                        <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="table_forthcoming_tbody">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Training Requirements</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-review review-table mb-0" id="table_targets">
                                <thead>
                                    <tr>
                                    <th style="width:40px;">#</th>
                                    <th>By Self</th>
                                    <th>RO's Comment</th>
                                    <th>HOD's Comment</th>
                                    <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="table_targets_tbody">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">Any Other General Comments, Observations, Suggestions Etc.</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-review review-table mb-0" id="general_comments">
                                <thead>
                                    <tr>
                                    <th style="width:40px;">#</th>
                                    <th>Self</th>
                                    <th>RO</th>
                                    <th>HOD</th>
                                    <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>
                                <tbody id="general_comments_tbody" >
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">For RO's Use Only</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Yes/No</th>
                                        <th>If Yes - Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>The Team Member Has Work Related Issues</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>The Team Member Has Leave Issues</td>
                                        <td>
                                        <select class="form-control select">
                                            <option>Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>The Team Member Has Stability Issues</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>The Team Member Exhibits Non-Supportive Attitude</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Any Other Points In Specific To Note About The Team Member</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                    <td>Overall Comment / Performance Of The Team Member</td>
                                        <td>
                                            <select class="form-control select">
                                                <option>Select</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section class="review-section">
                <div class="review-header text-center">
                    <h3 class="review-title">For HRD's Use Only</h3>
                    <p class="text-muted">HR</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered review-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Overall Parameters</th>
                                        <th>Available Points</th>
                                        <th>Points Scored</th>
                                        <th>RO's Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>KRAs Target Achievement Points (Will Be Considered From The Overall Score Specified In This Document By The Reporting Officer)</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Professional Skills Scores (RO's Points Furnished In The Skill & Attitude Assessment Sheet Will Be Considered)</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Personal Skills Scores (RO's Points Furnished In The Skill & Attitude Assessment Sheet Will Be Considered)</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Special Achievements Score (HOD To Furnish)</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td>Overall Total Score</td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                        <td><input type="text" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered review-table mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Signature</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Employee</td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <td>Reporting Officer</td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <td>HOD</td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <td>HRD</td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
                                    <td><input type="text" class="form-control" ></td>
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
    @section('script')
    <!-- Add Table Row JS -->
    <script>
        $(function () {
            $(document).on("click", '.btn-add-row', function () {
                var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
                console.log(id);
                var div = $("<tr />");
                div.html(GetDynamicTextBox(id));
                $("#"+id+"_tbody").append(div);
            });
            $(document).on("click", "#comments_remove", function () {
                $(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
                $(this).closest("tr").remove();
            });
            function GetDynamicTextBox(table_id) {
                $('#comments_remove').remove();
                var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
                return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
            }
        });
    </script>
    @endsection
@endsection
