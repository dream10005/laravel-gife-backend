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
    <h1> Add Reward Form </h1>
    <form method="POST" action="{{ url('/api/reward/new') }}" enctype="multipart/form-data" id="add_reward">
    @csrf
    Title:<br>
    <input type="text" name="title" value="1st Reward">
    <br><br>
    Banner Image Url:<br>
    <input type="text" name="image_url" value="www.google.com">
    <br><br>
    External Url:<br>
    <input type="text" name="external_url" value="www.google.com">
    <br><br>
    Description:<br>
    <input type="text" name="reward_desc" value="Sample Reward">
    <br><br>
    Required Gife Points:<br>
    <input type="text" name="required_points" value="10">
    <br><br>
    <input type="submit" value="Submit">
    </form> 
    <br>
    <font color="green"> {{ session()->get('success') }} </font>
    {{ session()->forget('success') }}
</body>
</html>