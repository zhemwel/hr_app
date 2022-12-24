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
                        <h3 class="page-title">Interview Questions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item">Jobs</li>
                            <li class="breadcrumb-item active">Interview Questions</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn mb-1" data-toggle="modal" data-target="#add_question"><i class="fa fa-plus"></i> Add Question</a>
                        <a href="#" class="btn add-btn mr-1 mb-1" data-toggle="modal" data-target="#add_category"><i class="fa fa-plus"></i> Add Category</a>
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
                                    <th>Questions</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th class="text-center">Correct Answer</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        IS management has decided to rewrite a legacy <br>customer relations system using fourth generation <br>languages (4GLs). Which of the following risks is<br> MOST often associated with system development using 4GLs?
                                    </td>
                                    <td>design facilities </td>
                                    <td> language subsets  </td>
                                    <td>Lack of portability  </td>
                                    <td>Inability to perform data  </td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_question"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_job"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
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

        <!-- Add Category Modal -->
        <div id="add_category" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('save/category') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Category</label>
                                        <input class="form-control @error('category') is-invalid @enderror" type="text" name="category">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Cancel</button>
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Questions Modal -->
    
        <!-- Add Questions Modal -->
        <div id="add_question" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('save/questions') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Category</label>
                                        <select class="select  @error('category') is-invalid @enderror" name="category">
                                            <option selected disabled> --Select --</option>
                                            @foreach ($category as $categorys )
                                            <option value="{{ $categorys->category }}" {{ old('category') == $categorys->category ? "selected" :""}}>{{ $categorys->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="select @error('department') is-invalid @enderror" name="department" id="department">
                                            <option selected disabled> --Select --</option>
                                            @foreach ($department as $departments )
                                            <option value="{{ $departments->department }}" {{ old('department') == $departments->department ? "selected" :""}}>{{ $departments->department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Questions</label>
                                        <textarea class="form-control @error('questions') is-invalid @enderror" name="questions">{{ old('questions') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option A</label>
                                        <input class="form-control @error('option_a') is-invalid @enderror" type="text" name="option_a" value="{{ old('option_a') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option B</label>
                                        <input class="form-control @error('option_b') is-invalid @enderror" type="text" name="option_b" value="{{ old('option_b') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option C</label>
                                        <input class="form-control @error('option_c') is-invalid @enderror" type="text" name="option_c" value="{{ old('option_c') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option D</label>
                                        <input class="form-control @error('option_d') is-invalid @enderror" type="text" name="option_d" value="{{ old('option_d') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Correct Answer</label>
                                        <select class="select @error('answer') is-invalid @enderror" name="answer">
                                            <option selected disabled> --Select --</option>
                                            @foreach ($answer as $answers )
                                            <option value="{{ $answers->answer }}" {{ old('answer') == $answers->answer ? "selected" :""}}>{{ $answers->answer }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Code Snippets</label>
                                        <textarea class="form-control @error('code_snippets') is-invalid @enderror" name="code_snippets">{{ old('code_snippets') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Answer Explanation</label>
                                        <textarea class="form-control @error('answer_explanation') is-invalid @enderror" name="answer_explanation">{{ old('answer_explanation') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Video Link</label>
                                        <input class="form-control @error('video_link') is-invalid @enderror" type="text" name="video_link" value="{{ old('video_link') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Image To Question</label>
                                        <input class="form-control @error('image_to_question') is-invalid @enderror" type="file" name="image_to_question">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Cancel</button>
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Questions Modal -->

        <!-- Edit Job Modal -->
        <div id="edit_question" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="select">
                                            <option>-</option>
                                            <option selected>HTML</option>
                                            <option>CSS</option>
                                        </select>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add Questions</label>
                                        <textarea class="form-control">
                                            IS management has decided to rewrite a legacy customer relations system using fourth generation languages (4GLs). Which of the following risks is MOST often associated with system development using 4GLs?
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option A</label>
                                        <input class="form-control" type="text" value="Design facilities">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option B</label>
                                        <input class="form-control" type="text" value="language subsets">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option C</label>
                                        <input class="form-control" type="text" value="Lack of portability">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Option D</label>
                                        <input class="form-control" type="text" value="Inability to perform data">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Correct Answer</label>
                                        <select class="select">
                                            <option>-</option>
                                            <option selected>Option A</option>
                                            <option>Option B</option>
                                            <option>Option C</option>
                                            <option>Option D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Code Snippets</label>
                                        <textarea class="form-control">
                                        
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Answer Explanation</label>
                                        <textarea class="form-control">
                                            
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Video Link</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add Image To Question</label>
                                        <input class="form-control" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Cancel</button>
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
                            <h3>Delete</h3>
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