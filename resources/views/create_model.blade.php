@extends('layouts.ap')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create New Model</h4>
                            <p class="card-description">
                                
                            </p>
                            <form class="forms-sample" method="post" action="">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="model_name">
                                </div>

                                <div class="form-group">
                                    <label>Dummy Files</label>
                                    <input type="file" name="img[]" class="">
                                </div>

                                <div class="form-group">
                                    <label>Dummy Files</label>
                                    <input type="file" name="img[]" class="">
                                </div>


                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
