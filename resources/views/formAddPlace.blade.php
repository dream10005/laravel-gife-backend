<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <center>
    <h1> Add Place Form </h1>
    <form method="POST" action="{{ url('/api/place/new') }}" enctype="multipart/form-data" id="add_place">
    @csrf
    Title:<br>
    <input type="text" name="title" value="1st place">
    <br><br>
    Type Id:<br>
    <input type="text" name="type_id" value="1">
    <br><br>
    Banner Image Url:<br>
    <input type="text" name="image_url" value="www.google.com">
    <br><br>
    About:<br>
    <input type="text" name="about" value="very nice place">
    <br><br>
    Contact Info:<br>
    <input type="text" name="contact" value="081-2345678">
    <br><br>
    Open - Close Time:<br>
    <input type="text" name="time" value="10.00AM - 12.00PM">
    <br><br>
    Latitude:<br>
    <input type="text" name="latitude" value="100.10">
    <br><br>
    Longitude:<br>
    <input type="text" name="longitude" value="100.10">
    <br><br>
    Address Description:<br>
    <input type="text" name="address_desc" value="93/188 ซ.เสรีไทย23/1 คลองกุ่ม บึงกุ่ม กรุงเทพ 10240">
    <br><br>
    Price Range Min:<br>
    <input type="text" name="price_min" value="20">
    <br><br>
    Price Range Max:<br>
    <input type="text" name="price_max" value="100">
    <br><br>
    <input type="submit" value="Submit">
    </form> 
    <br>
    <font color="green"> {{ session()->get('success') }} </font>
     {{ session()->forget('success') }}
</body>
</html>