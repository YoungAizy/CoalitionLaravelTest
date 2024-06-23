<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Coalition Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="p-3">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class= "my-3">
        <form class="d-flex flex-sm-row flex-column justify-content-between" id="myform" action="" method="post">
            <div class="form-group col-sm-3 col-6">
                <label for="product_name">product name:</label>
                <input class="form-control" type="text" name="product_name" id="product_name">
            </div>
            <div class="form-group col-sm-3 col-6">
                <label for="quantity">quantity in stock:</label>
                <input class="form-control" type="number" name="product_quantity" id="quantity">
            </div>
            <div class="form-group col-sm-3 col-6">
                <label for="price">price per item:</label>
                <input class="form-control" type="number" name="product_price" id="price">
            </div>
            <input class="btn btn-primary align-self-sm-end align-self-start mt-sm-0 mt-2 " id="submit_btn" type="submit" value="Add">
        </form>
    </div>
    <div id="products-container">
        <x-product-table />
    </div>
</body>
</html>