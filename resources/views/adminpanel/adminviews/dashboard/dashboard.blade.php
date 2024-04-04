@extends('layouts.master')
@section('title', 'AdminDashBoard')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12 fw-bold fs-3">
                Dashboard
            </div>
        </div>
    </div>

    <!--bang hien thi 4 mau-->
    <div class="row m-0 mb-3">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Success card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Danger card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Warning card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>
    </div>

    <!--2 Bieu do thong so ban hang-->
    <div class="row m-0 mb-3">
        <div class="col-md-6 mb-3">
            <div class="card" style="max-width: 36rem;">
                <div class="card-header">
                    Charts
                </div>

                <div class="card-body">
                    <canvas class="chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card" style="max-width: 36rem;">
                <div class="card-header">
                    Charts
                </div>

                <div class="card-body">
                    <canvas class="chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
