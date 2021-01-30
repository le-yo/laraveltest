@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a contact</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('company.update', $company->id) }}">
                @method('POST')
                @csrf
                <div class="form-group">

                    <label for="name"> Name:</label>
                    <input type="text" class="form-control" name="name" value={{ $company->name }} />
                </div>


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value={{ $company->email }} />
                </div>
                <div class="form-group">
                    <label for="city">Logo:</label>
                    <input type="text" class="form-control" name="city" value={{ $company->logo }} />
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" class="form-control" name="website" value={{ $company->website }} />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
