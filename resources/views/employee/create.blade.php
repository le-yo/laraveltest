@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a Employee</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('employee.store') }}">
                    @csrf

                    <label for="first_name">Select Company:</label>
                    <select class="form-control" name="company_id">
                        <option>Select Company</option>
                        @foreach ($companies as $key => $value)
                            <option value="{{ $key }}" {{ ( $key == $selectedCompany) ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-group">

                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name"/>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Add contact</button>
                </form>
            </div>
        </div>
    </div>
@endsection
