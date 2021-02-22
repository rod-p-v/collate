<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Collate</title>
</head>
<body>
    <?php 
    
    include_once 'products.php';
    
    $products=new Products(3);
    
    ?>

    <div id="container">
        <div id="pages">
           <?php $products->showPages(); ?>
        </div>
            
        <div id="products">
        <?php $products->showProducts(); ?>
        </div>
    </div>
</body>
</html>