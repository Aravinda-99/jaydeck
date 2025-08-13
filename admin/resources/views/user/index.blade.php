@extends('layouts.app')
@section('title', 'Users')
@push('moreCss')
@include('includes.datatables-css')
@include('includes.form-css')
@endpush
@section('pageTitle', 'Dashbord')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>USER MANAGMENT</h2>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <span class="pull-right">
                  @if(Auth::user()->active == 1)
                  <button type="button" class="btn bg-light-blue waves-effect" id="btnCreate" data-toggle="tooltip" data-placement="left" title="" data-original-title="ADD NEW USER" onclick="crud.onclickAdd()">
                    <i class="material-icons">add</i>
                  </button>
                  @endif
                </span>
                    <h2>
                        ALL USERS
                        <small>All the users in the system</small>
                    </h2>
                </div>

                <div class="body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User Role\s</th>
                            <th>Phone No</th>
                            <th>Email</th>
                            <th>Active</th>
                            @if(Auth::user()->status == 1)
                            <th>Action</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  @include('user.modal')
@endsection
@push('moreJs')
  @include('includes.form-js')
  @include('includes.datatables-js')
  <script src="{{ asset('assets/js/user-handler.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/js/user-active.js')}}"></script>
@endpush
