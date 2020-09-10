<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
        rel="stylesheet" /> -->
    <!-- FontAwsome     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <!-- Bootsterap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <title>Order food & drinks</title>
</head>

<body>
    <div class="container jumbotron">
        <h1 class="text-center">Order food in restaurant <i class="fas fa-utensils"></i> <br /> "the Personal Ham
            Processors"</h1>
        <nav>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="?food=1">Order food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?food=0">Order drinks</a>
                </li>
            </ul>
        </nav>
        <?php echo $errMessage ?>
        <form method="post" action="">
            <div class=" form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $email;?>" />
                </div>
                <div></div>
            </div>
            <fieldset>
                <legend>Address</legend>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control"
                            value="<?php echo $addressStreet;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control"
                            value="<?php echo $streetNumber;?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php echo $city;?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control"
                            value="<?php echo $zipCode;?>">
                    </div>
                </div>
            </fieldset>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <fieldset>
                        <legend>Products</legend>
                        <?php foreach ($products AS $i => $product): ?>
                        <label>
                            <input type="checkbox" value="1" name="products[<?php echo $i ?>]"
                                <?php  echo isset($selectedProducts[$product['name']]) ? "checked" : ""; ?> />
                            <?php echo $product['name'] ?> -
                            &euro; <?php echo number_format($product['price'], 2) ?></label><br />
                        <?php endforeach; ?>
                    </fieldset>
                </div>
                <div class="form-group col-md-6">
                    <fieldset>
                        <div class="card text-white bg-info mb-3 float-right" style="max-width: 20rem;">
                            <div class="card-header">Delivery Options</div>
                            <div class="card-body">
                                <p class="card-text">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="delivery" value="normal"
                                        class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="customRadio1">Normal delivery (2
                                        Hrs.)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="delivery" value="express"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Express delivery (45
                                        mins.)</label>
                                </div>
                                </p>
                            </div>
                    </fieldset>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Order!</button>
                    </div>
                </div>
        </form>

        <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food
            and
            drinks.</footer>

    </div>

    <style>
    footer {
        text-align: center;
    }
    </style>
</body>

</html>