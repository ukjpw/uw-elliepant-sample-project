@extends('template')

@section('content')

<h1 class="md:flex ml-4 mb-8 text-lg font-bold">Product Gallery</h1>
<div class="md:flex ml-4 font-sans">

    @foreach ($products as $product)

    <div class="max-w-sm rounded overflow-hidden shadow-lg mb-4 mr-8">
        <img class="w-full" src="{{ asset("storage/$product->feature_image_url") }}" alt="Gallery Image for {{ $product->name}}">

        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{ $product->name}}</div>
          <p class="text-gray-700 text-base">
            {{ $product->description}}
          </p>
          <p class="text-gray-700 text-base italic">
            {{ $product->product_status->name }}
          </p>
          <p class="text-gray-700 text-base">
            Price: &#36;{{ $product->price}}
          </p>
          <p class="text-gray-700 text-base">
            Shipping Cost: &#36;{{ $product->shipping_cost}}
          </p>
        </div>
        <div class="px-6 pt-4 pb-2 mb-4">
            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                @method('DELETE')
                {{ csrf_field() }} 

                <a href="{{ route('product.show', $product->id) }}">
                    <button type="button" value="Download PDF" class="shadow bg-green-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">        
                        View
                    </button>   
                </a>   
                @if($product->user->id == Auth::id())            
                    <a href="{{ route('product.edit', $product->id) }}">
                        <button type="button" value="Update Product" class="shadow bg-blue-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">        
                            Edit
                        </button>   
                    </a>
                    <input type="submit" value="Delete" class="cursor-pointer shadow bg-red-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">        
                @endif 
                <a href="{{ route('product.generatepdf', $product->id) }}">
                    <button type="button" value="Download PDF" class="shadow bg-cyan-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">        
                        PDF
                    </button>   
                </a>    
                  
            </form>   
        </div>
      </div>
    @endforeach

</div>

@endsection