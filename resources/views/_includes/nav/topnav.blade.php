<nav class="flex items-center justify-between flex-wrap bg-blue-500 p-6 mb-10">
  <div class="flex items-center flex-shrink-0 text-white mr-12">
    <span class="font-semibold text-xl tracking-tight">Elliephant Sample Project - Ulrik Wildy</span>
  </div>
  
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-sm lg:flex-grow">
      <a href="{{ route('product.gallery') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
        View All Products
      </a>
      <a href="{{ route('product.create') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
        Add a Product
      </a>
    </div>    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
      @csrf  
    <div>
      <input type="submit" value="Logout" class="cursor-pointer inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white  hover:text-orange-500 mt-4 lg:mt-0">
        
    </div>
  </form>
  </div>
</nav>