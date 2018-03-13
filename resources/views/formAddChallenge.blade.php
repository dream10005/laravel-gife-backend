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
    <h1> Add Challenge Form </h1>
    <form method="POST" action="{{ url('/api/challenge/new') }}" enctype="multipart/form-data" id="add_challenge">
    @csrf
    Title:<br>
    <input type="text" name="title" value="1st challenge">
    <br><br>
    Banner Image Url:<br>
    <input type="text" name="image_url" value="www.google.com">
    <br><br>
    Location Label:<br>
    <input type="text" name="location_label" value="กรุงเทพ">
    <br><br>
    Reward Gife Points:<br>
    <input type="text" name="reward_points" value="100">
    <br><br>
    Goal Description:<br>
    <input type="text" name="goal_desc" value="ไปเที่ยวให้ครบ 5 สถานที่นี้">
    <br><br>
    <input type="submit" value="Submit">
    </form> 
    <br>
    <font color="green"> {{ session()->get('success') }} </font>
     {{ session()->forget('success') }}
</body>
</html>