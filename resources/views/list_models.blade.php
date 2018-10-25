@extends('layouts.ap')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Models</h4>
                            <p class="card-description">
                                List of all models 
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Model Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $models as $model )
                                        <tr>
                                            <td>{{ $model->name }}</td>
                                            <td>
                                                <a href="{{ URL::to('/view_model/'.$model->name.'') }}" class="btn btn-primary btn-fw">View Model Files</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
