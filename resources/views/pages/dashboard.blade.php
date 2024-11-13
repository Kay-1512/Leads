<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @role('admin')
    <h1>We've landed</h1>
    @else
    <h1>We've landed</h1>
    @endrole

</body>
</html>