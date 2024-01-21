@extends('template')

@section('content')

<h1 class="md:flex ml-4 mb-8 text-lg font-bold">View Product</h1>

<div class="w-full min-w-sm max-w-xl  p-6">
 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
        Name
     </label>
   </div>
   <div class="min-w-64">
      {{ $product->name }}
  </div>
 </div>
 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="price">
       Price
     </label>
   </div>
   <div class="min-w-64">&#36;{{ $product->price }}</div>
 </div>
 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="shipping_cost">
       Shipping Cost
     </label>
   </div>
   <div class="min-w-56">
    &#36;{{ $product->shipping_cost }}
   </div>
 </div>
 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="description">
       Description
     </label>
   </div>
   <div class="md:w-2/3">
     {{ $product->description }}
   </div>
 </div>

 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="status">
       Status
     </label>
   </div>
   <div class="md:w-2/3">
        {{ $product->product_status->name }}     
   </div>
 </div>

 <div class="md:flex md:items-center mb-6">
  <div class="min-w-56">
    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="status">
      Created By:
    </label>
  </div>
  <div class="md:w-2/3">
    {{ $product->user->name }}, {{ $product->created_at->diffForHumans(); }}
  </div>
</div>
 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="feature_image">
       Feature Image
     </label>
   </div>
   <div class="mb-3">
    <img src="{{ asset("storage/$product->feature_image_url") }}" alt="Image">
   </div>
 </div>
 <div class="md:flex md:items-center mb-6">
   <div class="min-w-56">
     <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="gallery_image">
       Gallery Image
     </label>
   </div>
   <div class="mb-3">
       <img src="{{ asset("storage/$product->gallery_image_url") }}" alt="Image">
   </div>
 </div>

 <form action="{{ route('product.destroy', $product->id) }}" method="POST">
  <div class="md:flex md:items-center">
    <div class="min-w-56"></div>
    
      @method('DELETE')
      {{ csrf_field() }} 
    
    @if($product->user->id == Auth::id())
    <div class="md:w-92">
      <a href="{{ route('product.edit', $product->id) }}">
        <button type="button" value="Update Product" class="shadow bg-blue-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">        
            Edit
        </button>   
      </a>
    </div>  
    
    <input type="submit" value="Delete" class="ml-2 cursor-pointer shadow bg-red-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">        
    @endif  

    <div class="md:w-92 ml-2">
      <a href="{{ route('product.generatepdf', $product->id) }}">
        <button type="button" value="Download PDF" class="shadow bg-cyan-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">        
            PDF
        </button>   
    </a>   
    </div>    
  </div>
</form>
</div>
@endsection