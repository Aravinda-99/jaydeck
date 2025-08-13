@extends('layouts.app')

@section('content')
<style>
  .view-count {
      font-weight: normal;
      font-size: 26px;
      margin-top: -4px;
      color: #fff; 
    }

</style>
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>Dashbord</h2>
      </div>
      <div class="row clearfix">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
          <div class="icon">
            <i class="material-icons">home_work</i>
          </div>
          <div class="content">
            <div class="text">PRODUCTS</div>
            <span class="view-count">{{$proCount}}</span>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
          <div class="icon">
            <i class="material-icons">playlist_add_check</i>
          </div>
          <div class="content">
            <div class="text">MAIN CATEGORIES</div>
            <span class="view-count">{{$mainCatCount}}</span>
          </div>
        </div>
      </div>
      
    </div>
    </div>
  </section>  
@stop

@push('moreJs')
  <script src="{{ asset('assets/plugins/jquery-countto/jquery.countTo.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/js/dashbord.js') }}" charset="utf-8"></script>
@endpush


