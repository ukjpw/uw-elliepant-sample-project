
<!DOCTYPE html>
<html>
  <head>
      <title>{{ $title }}</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
  <body>
    <div class="container" style="position:relative">
      <div>
        <h1>Details of Product: {{ $name }}</h1>
        <h2>Description: <span style="font-weight:normal">{{ $description }}</span> </h2>
        <h2>Status: <span style="font-weight:normal">{{ $product_status['name'] }}</span> </h2>
        <h2>Price: <span style="font-weight:normal">&#36;{{ $price }}</span></h2>
        <h2>Shipping Cost: <span style="font-weight:normal">&#36;{{ $shipping_cost }}</span></h2>
        <img src="data:image/jpg;base64,{{ $feature_image_url_base64 }}" width="80%" style="image-orientation: from-image;transform: rotate(180deg);"/>    
      </div>  
      <p style="width: 100%;text-align: center; position:fixed; bottom:0; left: 50%;transform: translateX(-50%)">{{ $footer }}</p>
  </div>
  </body>
</html> 

