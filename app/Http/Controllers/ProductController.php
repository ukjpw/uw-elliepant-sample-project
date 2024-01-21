<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProductStatus;
use App\Models\Product;
use App\Services\FileUploadService;
use PDF; 

class ProductController extends Controller
{
    public function gallery()
    {
        $products = Product::all();
        return view('product.gallery')->with('products', $products);
    }    

    public function destroy(Request $request, $id, FileUploadService $fileUploadService)
    {   
        $product = Product::findOrFail($id);
        if($product->user->id != Auth::id()){
            return abort(403);
        }
        
        // Get uploaded images for product so we can delete
        $featureImageFilePath = $product->feature_image_url;
        $galleryImageFilePath = $product->gallery_image_url;

        $product->delete();

        // Delete uploaded images        
        $fileUploadService->deleteFile($featureImageFilePath);
        $fileUploadService->deleteFile($galleryImageFilePath);

        return redirect()->route('product.gallery');
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productStatuses = ProductStatus::all();
        return view('product.create')->with('productStatuses', $productStatuses);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FileUploadService $fileUploadService)
    {
        
        $validated = $request->validate( [
            'name' => "required|min:2|max:255",
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|max:255',
            'shipping_cost' => 'required|numeric|min:0',

            // Make images required
            'feature_image' => 'required|max:8192|mimes:png,jpeg',
            'gallery_image' => 'required|max:8192|mimes:png,jpeg',

        ],['content.required' => 'Content is required']);

        // Handle file uploads
        if ($request->hasFile('feature_image')) {
            $featureImagefilePath = $fileUploadService->uploadFile($request->file('feature_image'));
        }

        if ($request->hasFile('gallery_image')) {
            $galleryImagefilePath = $fileUploadService->uploadFile($request->file('gallery_image'));
        }
             
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->feature_image_url = $featureImagefilePath;
        $product->gallery_image_url = $galleryImagefilePath;
        $product->shipping_cost = $request->shipping_cost;
        $product->product_status_id = $request->product_status;        
        $product->user()->associate(Auth::id());
        $product->save();

        return redirect()->route('product.show',  $product->id);
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\
     * 
     */
    public function show($id)
    {
        // Show product
        $product = Product::with(['product_status', 'user'])->findOrFail($id);
        return view('product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['product_status', 'user'])->findOrFail($id);
        if($product->user->id != Auth::id()){
            return abort(403);
        }
        $productStatuses = ProductStatus::all();
        return view('product.edit')->with('product', $product)->with('productStatuses', $productStatuses);
    }


    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FileUploadService $fileUploadService)
    {   
        $product = Product::findOrFail($id);
        if($product->user->id != Auth::id()){
            return abort(403);
        }

        $validationRules =  [
            'name' => "required|min:2|max:255",
            'price' => 'required|numeric|min:0.01',
            'description' => 'required|max:255',
            'shipping_cost' => 'required|numeric|min:0',
            'product_status' => 'exists:product_statuses,id', // Needs to be existing product status
        ];
        
        // Handle file uploads
        if ($request->hasFile('feature_image')) {
            array_push($validationRules,['feature_image' => 'max:8192|mimes:png,jpeg']);
            $featureImagefile = $request->file('feature_image');
            $newFeatureImagefilePath = $fileUploadService->uploadFile($featureImagefile);
        }

        if ($request->hasFile('gallery_image')) {
            array_push($validationRules,['gallery_image' => 'max:8192|mimes:png,jpeg']);
            $galleryImagefile = $request->file('gallery_image');
            $newGalleryImagefilePath = $fileUploadService->uploadFile($galleryImagefile);
        }

        $validated = $request->validate($validationRules); 
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // Only alter product image URLs if uploaded
        if(isset($newFeatureImagefilePath)) {
            $oldFeatureImageFilePath = $product->feature_image_url; // Store old image url so we can delete from storage
            $product->feature_image_url = $newFeatureImagefilePath;
        }
        
        if(isset($newGalleryImagefilePath)) {
            $oldGalleryImageFilePath = $product->gallery_image_url; // Store old image url so we can delete from storage
            $product->gallery_image_url = $newGalleryImagefilePath;
        }
        
        $product->shipping_cost = $request->shipping_cost;
        $product->product_status_id = $request->product_status;
        $product->save();

        // Now that product updated successfully, delete old images
        if(isset($oldFeatureImageFilePath)) {            
            $fileUploadService->deleteFile($oldFeatureImageFilePath);
        }

        if(isset($oldGalleryImageFilePath)) {
            $fileUploadService->deleteFile($oldGalleryImageFilePath);
        }    

        return redirect()->route('product.show',  $product->id);
    }

    public function generatePDF($id, FileUploadService $fileUploadService)
    {
        $product = Product::with(['product_status', 'user'])->findOrFail($id);

        $additionalData = [
            'title' => "Product Details for $product->name",
            'footer'=> 'Generated by Elliephant Sample Project at ' . Carbon::now()->format('d M Y'),
            'feature_image_url_base64' => base64_encode(file_get_contents(public_path("/storage/$product->feature_image_url")))
        ];

        $pdfData = array_merge($additionalData, $product->toArray());
        $pdf = Pdf::loadView('product/pdf', $pdfData);
        return $pdf->download("Product-$product->id");
    } 
}
