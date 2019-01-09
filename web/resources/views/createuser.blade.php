@extends('template\main')

@section('title')
    Create New User
@endsection

@section('message')
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <span class="label label-danger">
                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i> {{ $error }}
            </span>
        @endforeach
    @endif
@endsection

@section('content')
    <form id="create-user-form" class="form-horizontal" role="form" action="/save-user" method="POST">
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="username">Username</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="text" name="username" id="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="name">Name</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="text" name="name" id="name" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="email">Email</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="email" name="email" id="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="password">Password</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="password" name="password" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="cpassword">Confirm Password</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="gender">Gender</label>
            <div class="col-sm-9">
                <select name="gender" id="form-field-select-1" class="col-xs-10 col-sm-5">
                    <option value="male">&male; Male</option>
                    <option value="female">&female; Female</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="role">Role</label>
            <div class="col-sm-9">
                <select name="role" id="role" class="col-xs-10 col-sm-5">
                    @php
                        foreach($role as $r){
                            echo "<option value='".$r['_id']."'>".$r['name']."</option>";
                        }
                    @endphp
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="address">Address</label>
            <div class="col-sm-9">
                <input class="col-xs-10 col-sm-5" type="text" name="address" id="address" placeholder="Address">
            </div>
        </div>
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" form="create-user-form">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>
    </form>
@endsection