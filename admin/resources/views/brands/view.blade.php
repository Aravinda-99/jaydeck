
<section class="row">

 {{-- <div class="row"> --}}
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

      <p><b>Brand Name        :</b> <span>{{$brand->name}}</span></p>

      <p><b>Brand Description        :</b> <span>{{$brand->description}}</span></p>
      
      <p><b>Brand Added Date  :</b> <span>{{$brand->created_at->format('Y-m-d')}}</span></p><br>
  </div>

  <div class="col-md-12" style="text-align:left;">
   <p class="font-bold col-cyan"> PRODUCT IMAGE</p> 
   <img src="../{{$brand->image}}" width="50%">


  </div>
  
</section>



