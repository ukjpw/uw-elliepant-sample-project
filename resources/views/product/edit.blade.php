@extends('template')

@section('content')

<h1 class="md:flex ml-4 mb-8 text-lg font-bold">Edit Product</h1>

@if($errors->any())

<div class="ml-20">
    <div class="w-96 bg-red-500 text-white font-bold rounded-t px-4 py-2 text-sm">
      Some errors occurred
    </div>
    @foreach ($errors->all() as $error)
        <div class="w-96 border-t-0 rounded-b bg-red-100 px-4 py-3 text-red-600  text-sm">
            <p>{{ $error }}</p>
        </div>
    @endforeach    
</div>

@endif


<form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="w-full min-w-sm max-w-lg  p-6">
   @method('PUT')
  {{ csrf_field() }}
  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
         Name
      </label>
    </div>
    <div class="min-w-64">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" 
            name="name" id="name" maxlength="100"  type="text" value="{{ old('name', $product->name) }}">
    </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="price">
        Price
      </label>
    </div>
    <div class="min-w-56">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" 
             type="number" name="price" id="price" step=".01" min="0" value="{{ old('price', $product->price) }}">
    </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="shipping_cost">
        Shipping Cost
      </label>
    </div>
    <div class="min-w-56">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" 
             type="number" name="shipping_cost" id="shipping_cost" step=".01" min="0" value="{{ old('shipping_cost', $product->shipping_cost) }}">
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="description">
        Description
      </label>
    </div>
    <div class="md:w-2/3">
      <textarea class="min-h-46 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" 
             name="description" id="description">
             {{ old('description', $product->description) }}
      </textarea>       
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="product_status">
        Status
      </label>
    </div>
    <div class="md:w-2/3">
        <select name="product_status" id="product_status" class="bg-gray-200 border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
            @foreach ($productStatuses as $productStatus)
                <option value="{{ $productStatus->id }}" {{  old('product_status', $product->product_status_id) ===  $productStatus->id ? 'selected' : '' }}> 
                {{ $productStatus->name }} 
                </option>                        
            @endforeach                    
        </select>       
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="feature_image">
        Current Feature Image
      </label>
    </div>
    <div class="mb-3">
     <img src="{{ asset("storage/$product->feature_image_url") }}" alt="Image">
    </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="gallery_image">
        Current Gallery Image
      </label>
    </div>
    <div class="mb-3">
        <img src="{{ asset("storage/$product->gallery_image_url") }}" alt="Image">
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="feature_image">
        Upload New Feature Image
      </label>
    </div>
    <div class="mb-3">
        <input
          class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
          type="file" id="feature_image" name="feature_image" accept="image/png, image/jpeg" />
      </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="min-w-56">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="gallery_image">
        Upload New Gallery Image
      </label>
    </div>
    <div class="mb-3">
        <input
          class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
          type="file" id="gallery_image" name="gallery_image" accept="image/png, image/jpeg" />
      </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="min-w-56"></div>
    <div class="md:w-2/3">
      <input type="submit" value="Update Product" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">        
    </div>
    <div class="md:w-2/3 ml-2">
        <a href="{{ route('product.show', $product->id) }}">
        <button value="Update Product" class="shadow bg-red-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">        
            Cancel     
        </button>   
        </a>
      </div>
  </div>
</form>


@endsection
