
<section class="row">

 {{-- <div class="row"> --}}
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <p><b>Product Code     :</b> <span>{{$product->code}}</span></p>
      <p><b>Name             :</b> <span>{{$product->name}}</span></p>
      <p><b>MOQ Value        :</b> <span>{{$product->moq}}</span></p>
      <p><b>Quantity         :</b> <span>{{$product->qty}}</span></p>
      <p><b>Price            :</b> <span>Rs. {{number_format($product->price,2)}}</span></p>
      <p><b>Available Status :@if($product->status  == 1)
                              </b> <span>Available</span></p>
                            @else
                              </b> <span>Unavailable</span></p>
                            @endif<br>
  </div>

  <div class="col-md-12" style="text-align:left;">
   <p class="font-bold col-cyan">PRODUCT CATEGORIES</p> 
   <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped" id="areasTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Main Category</th>
                <th>Sub Category</th>
            </thead>
            <tbody>
             @foreach($product->product_categories as $el)
              <tr>
                <td></td>
                <td>{{$el->mainCategory->name}}</td>
                <td>@if($el->subcategory)
                      {{$el->subcategory->name}}
                    @else
                      -
                    @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>


  </div>
  
</section>



