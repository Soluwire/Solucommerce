@extends("layout.base")
@section('base.title')
{{$product->product_name}}
@endsection

@section('base.css')
<link rel="stylesheet" href="{{asset('/css/fotorama.css')}}">
@endsection

@section('base.meta')
<meta name="keywords" content="{{$product->product_name}},{{env('APP_NAME')}}">
<meta name="description" content="{{$product->product_description}}">
<meta property="og:url"                content="{{URL::full()}}" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="{{$product->product_name}}" />
<meta property="og:description"        content="{{$product->product_description}}" />
@if($product->Variants()->exists())
<meta property="og:image" content="{{asset($product->Variants()->first()->Picture()->first()->path)}}" />
@endif
@endsection
@section('base.content')
<section id="category" class="flex flex-col px-2">
   <div class="flex xl:flex-row lg:flex-row md:flex-row sm:flex-col flex-col" id="app">

      <div class="xl:w-1/2 lg:w-1/2 md:w-1/2 sm:w-full w-full xl:order-1 lg:order-1 md:order-1 sm:order-2 order-2">
         <div class="container w-full h-full mx-auto">
           <div class="flex flex-col h-full w-full justify-center items-center p-10">
              
            <div class="p-3 w-full">
            <h1>{{$product->product_name}}</h1>

            </div>
             <div class="p-3 w-full">
                <h3>Product Description</h3>
                <p>{{$product->product_description}}</p>
             </div>
             
            
               @if($product->has_variants==true)
               <div class="p-3 w-full">
               <h3>Available Variants</h3>
             <select name="" id="" v-model="variantSelected" v-on:change="changePicture()" class="bg-gray-200 p-2">
                 <option v-for="(variant,key) in variants" :value="key"> @{{variant.variant_name}} </option>
             </select>
            </div>
            <div class="p-3 w-full">
             <h3>Variant Description</h3>
             @{{variants[variantSelected].variant_description}}
            </div>
            
            <div class="p-3 w-full">
               <h3>Variant Stock</h3>
               @{{variants[variantSelected].variant_stock}}
              </div>
             @else
             {{-- Standard product, need to code --}}
             @endif
      
    
             <div class="p-3 w-full">
                <h3> Price</h3>
              <p class="text-2xl font-bold text-blue-500">  {{$currency}} @{{variants[variantSelected].variant_price}}</p>
                <label for="quantity" class="block">Quantity</label>
                <input type="number" name="quantity" v-model="quantity"  class="bg-gray-200 p-2">
                <button class="rounded shadow bg-blue-400 p-2 block mt-2" @click="addtoCart()">
                   ADD TO CART
                </button>
             </div>
           </div>
         </div>
       </div>

      <div class="xl:w-1/2 lg:w-1/2 md:w-1/2 sm:w-full w-full xl:order-2 lg:order-2 md:order-2 sm:order-1 order-1">
         @if($product->has_variants==true)
         <div class="fotorama">
            @foreach($product->Variants()->get() as $variant)
             @foreach($variant->Picture()->get() as $picture)
             <img src="{{$picture->path}}" data-name="{{$variant->variant_name}}">
             @endforeach
           @endforeach
         </div>

         @endif
      </div>
 
   </div>
   @if(count($related)>0)
    <h2>Related Products</h2>
    @else
    <h2>No related products to show.</h2>
   @endif
</section>
@endsection


@section('base.js')
@if($product->Variants()->exists())
<script type="application/ld+json">
   {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{$product->product_name}}",
      "image": [
      @foreach($product->Variants()->get() as $variant)
         @foreach($variant->Picture()->get() as $picture)
        "{{asset($picture->path)}}"
         @endforeach
      @endforeach
       ],
      "description": "{{$product->product_description }}",
      "sku": "{{$product->product_code}}",
      "mpn": "{{$product->product_code}}",
      "brand": {
        "@type": "Thing",
        "name": "ACME"
      },
      "offers": {
        "@type": "Offer",
        "url": "{{URL::full()}}",
        "priceCurrency": "GBP",
        "price": "{{$product->Variants()->first()->variant_price }}",

        "priceValidUntil": "2020-11-05",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "{{env("APP_NAME")}}"
        }
      }
    }
   </script>
@endif
<script src="{{asset('/js/fotorama.js')}}"></script>
<script>
var product_id =  {{$product->id}};
var variants = {!! json_encode($product->Variants()->get()) !!}
new Vue({
   el:'#app',
   mounted : function(){
    var $fotoramaDiv = $('.fotorama').fotorama();
    this.foto = $fotoramaDiv.data('fotorama');
    console.log(this.foto);
   },
   data : function(){
      return {
         foto : null,
         variants : variants,
         variantSelected: 0,
         quantity: 1,
      }
   },
   methods : {
      changePicture: function(){
         for (let photo in this.foto.data){
            console.log(this.foto.data[photo].name)
            if(this.foto.data[photo].name == this.variants[this.variantSelected].variant_name ){
             this.foto.show(photo);
             break
            }
         }
      },
      addtoCart: function(){
         let self = this;
         if(this.variants[this.variantSelected].variant_stock<this.quantity){
            alert("We don't have this amount in stock");
         }else {
            axios.post("/addtocart/product/variant",{variant_id: this.variants[this.variantSelected].id, product_id: product_id, quantity : this.quantity}).then(function(res) {
            if(res.status==200){
               if(res.data=="Success"){
                  toastr.success(self.quantity + " x " +self.variants[self.variantSelected].variant_name + " added to cart!");
               }
            }
         })
         }
 
      }
   },


})
</script>
@endsection