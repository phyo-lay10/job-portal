@extends('ui-panel.master')
@section('content')
    <div class="container mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <h3 class="my-5">Application Form</h3>
                <div class="mt-3 card card-body bg-body-tertiary border-info">
                    <h5 class="mb-4 text-center"><b>{{$job->title}}</b></h5>
                        <form action="{{url('apply/store')}}" method="POST" enctype="multipart/form-data"> @csrf
                            <div class="mb-3">
                                <label for="fullName" class="mb-1"><b>Full Name:</b></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="fullName" value="{{Auth::user()->name}}" >
                                @error('name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="mb-1"><b>Email address:</b></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"value="{{ old('email') ?? Auth::user()->email}}" >
                                @error('email')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phoneNumber" class="mb-1"><b>Phone Number:</b></label>
                                <input type="text" value="{{old('phone')}}" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" placeholder="Enter your phone number" >
                                @error('phone')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="mb-1"><b>Address:</b></label>
                                <input type="text" value="{{old('address')}}" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter your address" >
                                @error('address')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="salary" class="mb-1"><b>Salary</b>:</label>
                                <input type="text" name="salary" value="{{$job->salary}}" class="form-control @error('salary') is-invalid @enderror" id="salary">
                                @error('salary')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="mb-1"><b>Gender</b></label>
                                <div class="d-flex justify-content-start gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                        <label class="form-check-label" for="male">
                                          male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                        <label class="form-check-label" for="female">
                                          female
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                        <label class="form-check-label" for="other">
                                          other
                                        </label>
                                    </div> 
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="mb-2"><b>Image</b></label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid  @enderror ">
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <input type="hidden" value="{{$job->id}}" name="job_id">
                            <input type="hidden" value="{{Auth::user()->id}}" name="employee_id">
                            <input type="hidden"  name="accept">

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection