<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <center>
    <h1> Add Place Form </h1>
    <form method="POST" action="{{ url('/api/place/new') }}" enctype="multipart/form-data" id="add_place">
    @csrf
    <!-- Title:<br>
    <input type="text" name="title" value="1st place" required>
    <br><br>
    Review Url:<br>
    <input type="text" name="review_url" value="www.google.com" required>
    <br><br>
    Banner Image Url:<br>
    <input type="text" name="image_url" value="www.google.com" required>
    <br><br>
    About:<br>
    <input type="text" name="about" value="very nice place" required>
    <br><br>
    Contact Info:<br>
    <input type="text" name="contact" value="081-2345678" required>
    <br><br>
    Open - Close Time:<br>
    <input type="text" name="time" value="10.00AM - 12.00PM" required>
    <br><br>
    Latitude:<br>
    <input type="text" name="latitude" value="100.10" required>
    <br><br>
    Longitude:<br>
    <input type="text" name="longitude" value="100.10" required>
    <br><br>
    Address Description:<br>
    <input type="text" name="address_desc" value="93/188 ซ.เสรีไทย23/1 คลองกุ่ม บึงกุ่ม กรุงเทพ 10240" required>
    <br><br>
    Price Range Min:<br>
    <input type="text" name="price_min" value="20" required>
    <br><br>
    Price Range Max:<br>
    <input type="text" name="price_max" value="100" required>
    <br><br> -->
    <input type="file" name="csv" required>
    <br><br>
    <input type="submit" value="Submit">
    </form> 
    <br>
    @if (session()->get('success') == 'Insert data success')
        <font color="green"> {{ session()->get('success') }} </font><br>
    @else
        <font color="red"> {{ session()->get('success') }} </font><br>
    @endif
    {{ session()->forget('success') }}
</body>
</html>