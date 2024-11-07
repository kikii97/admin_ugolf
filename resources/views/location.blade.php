@extends('index')

@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 style="font-family: 'Kufam', sans-serif;" class="page-title text-truncate text-dark font-weight-medium mb-1">Location</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Apps</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Location</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="lokasi/create">
                        <button class="custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <span style="margin-left: 12px;">Add</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Container fluid  -->
    <div class="container-fluid">

        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Created by</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="fs-6">In Progress</span></td>
                                        <td><a href="javascript:void(0)" class="font-weight-medium link">Elegant
                                                Theme
                                                Side Menu Open OnClick</a></td>
                                        <td><a href="javascript:void(0)" class="font-bold link">276377</a></td>
                                        <td>Elegant Admin</td>
                                        <td>Eric Pratt</td>
                                        <td>2018/05/01</td>
                                        <td>Fazz</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fs-6">Closed</span></td>
                                        <td><a href="javascript:void(0)" class="font-weight-medium link">AdminX
                                                Theme
                                                Side Menu Open OnClick</a></td>
                                        <td><a href="javascript:void(0)" class="font-bold link">1234251</a></td>
                                        <td>AdminX Admin</td>
                                        <td>Nirav Joshi</td>
                                        <td>2018/05/11</td>
                                        <td>Steve</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fs-6">Opened</span></td>
                                        <td><a href="javascript:void(0)" class="font-weight-medium link">Admin-Pro
                                                Theme Side Menu Open OnClick</a></td>
                                        <td><a href="javascript:void(0)" class="font-bold link">1020345</a></td>
                                        <td>Admin-Pro</td>
                                        <td>Vishal Bhatt</td>
                                        <td>2018/04/01</td>
                                        <td>John</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fs-6">In Progress</span></td>
                                        <td><a href="javascript:void(0)" class="font-weight-medium link">Elegant
                                                Theme
                                                Side Menu Open OnClick</a></td>
                                        <td><a href="javascript:void(0)" class="font-bold link">7810203</a></td>
                                        <td>Elegant Admin</td>
                                        <td>Eric Pratt</td>
                                        <td>2018/01/01</td>
                                        <td>Fazz</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fs-6">In Progress</span></td>
                                        <td><a href="javascript:void(0)" class="font-weight-medium link">AdminX
                                                Theme
                                                Side Menu Open OnClick</a></td>
                                        <td><a href="javascript:void(0)" class="font-bold link">2103450</a></td>
                                        <td>AdminX Admin</td>
                                        <td>Nirav Joshi</td>
                                        <td>2018/05/01</td>
                                        <td>John</td>
                                    </tr>
                                    <tr>
                                        <td><span class="fs-6">In Progress</span></td>
                                        <td><a href="javascript:void(0)" class="font-weight-medium link">Admin-Pro
                                                Theme Side Menu Open OnClick</a></td>
                                        <td><a href="javascript:void(0)" class="font-bold link">2140530</a></td>
                                        <td>Admin-Pro</td>
                                        <td>Vishal Bhatt</td>
                                        <td>2018/07/01</td>
                                        <td>Steve</td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="pagination float-end">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
