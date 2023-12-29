@extends('admin.layouts.app')

@section('content')

{{-- <div class="container-fluid mt-4">
    <div class="row">
        <!-- Users Table -->
        <div class="col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Users</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Workers Table -->
        <div class="col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Workers</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $index => $worker)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $worker->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular News Section -->
    <div class="border border-danger mb-5 p-3">
        <h5>Popular News</h5>
        <ul>
            @foreach ($popularNews as $popularNew)
            <li>
                <strong>{{ $popularNew->category->name }}</strong>
                <p>{{ $popularNew->title }}</p>
            </li>
            @endforeach
        </ul>
    </div>
</div> --}}

<div class="container-fluid my-5">
    <div class="row">
    <h3 class="mt-3 mb-4 fw-bold">Reports</h3>
        <!-- Users Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bold">Applicants</h5>
                    @if ($applicants->isEmpty())
                        <p class="mt-5 text-danger fw-bold fs-6">No applicants available !</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($applicants as $index => $applicant)
                                <li class="list-group-item border-bottom fw-bold 
                                @if ($applicant->accept === null)
                                    text-warning
                                @elseif($applicant->accept === 0)
                                    text-danger
                                @elseif($applicant->accept == 1)
                                    text-success
                                @endif
                                ">{{ ++$index }}. {{ $applicant->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Workers Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bold">Workers</h5>
                    @if ($workers->isEmpty())
                    <p class="mt-5 text-danger fw-bold fs-6">No workers available !</p>
                    @else
                    <ul class="list-group  list-group-flush">
                        @foreach ($workers as $index => $worker)
                            <li class="list-group-item border-bottom">{{ ++$index }}. {{ $worker->name }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Popular News Section Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bold">Popular News</h5>
                    @if ($popularNews->isEmpty())
                    <p class="mt-5 text-danger fw-bold fs-6">No popular news available !</p>
                    @else
                    <ul class="list-group  list-group-flush">
                        @foreach ($popularNews as $index => $popularNew)
                            <li class="list-group-item border-bottom">
                                {{++$index}}. {{ $popularNew->category->name }}
                                ({{ $popularNew->title }})
                            </li>
                        @endforeach
                    </ul>
                @endif
                </div>
            </div>
        </div>

    </div>
</div>

<div class="d-flex justify-content-end">
    <ul class="list-unstyled">
        <h6 class="fw-bold mb-3 fs-5">Tips ~</h6>
        <li><span class="text-danger fw-bold">- Red</span> is for the ones who get rejected</li>
        <li><span class="text-warning fw-bold">- Yellow</span> is for the ones who are pending</li>
        <li><span class="text-success fw-bold">- Green</span> is for the ones who get accepted</li>
    </ul>
</div>
@endsection




