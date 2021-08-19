<?php
    //get the data from the form
    $product_description = filter_input(INPUT_POST,'product_description');
    $list_price = filter_input(INPUT_POST,'list_price', FILTER_VALIDATE_FLOAT);
    $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);
    
    //validate product
    if( empty($product_description)){
        $error_message = 'You must enter a product description.';
    }else if( empty($list_price) || !is_numeric($list_price) || $list_price <= 0 ){
        $error_message = 'You must enter a valid list price.';
    }else if( empty($discount_percent) || !is_numeric($discount_percent) || $discount_percent <= 0){
        $error_message = 'You must enter a discount percent.';
    }else {
        $error_message = '';
    }
   if($error_message != ''){
       include('index.php');
       exit();
   }

    //calculate the discount and discounted price
    $discount = $list_price * $discount_percent * .01;
    $sales_tax_rate = 8;
    $discount_price = $list_price - $discount;
    $added_tax_price = $discount_price * .08;
    $amount_due = $discount_price + $added_tax_price;

    //apply currency formatting to the dollar and percent amounts
    $list_price_f = "$".number_format($list_price, 2);
    $discount_percent_f = $discount_percent."%";
    $discount_f = "$".number_format($discount, 2);
    $sales_tax_rate_f = $sales_tax_rate."%";
    $discount_price_f = "$".number_format($discount_price, 2);
    $added_tax_price_f = "$".number_format($added_tax_price, 2);
    $amount_due_f = "$".number_format($amount_due, 2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
    <div id="content">
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br />

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_f); ?></span><br />

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_f); ?></span><br />

        <label>Discount Amount:</label>
        <span><?php echo htmlspecialchars($discount_f); ?></span><br />

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br />

        <label>Sale Tax Rate:</label>
        <span><?php echo htmlspecialchars($sales_tax_rate_f); ?></span><br />

        <label>Sales Tax:</label>
        <span><?php echo htmlspecialchars($added_tax_price_f); ?></span><br />

        <label>Amount Due:</label>
        <span><?php echo htmlspecialchars($amount_due_f); ?></span><br />

        <p>&nbsp;</p>
    </div>
</body>
</html>