<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wally's Widgets - Andrew Pinner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="css/foundation.css?v=1">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <h1><i class="fas fa-dolly"></i> Wally's Widgets</h1>
            </div>
        </div>
        <form data-abide method="get" class="ajax-submit" action="action.php">
            <div class="grid-x grid-padding-x">

                <div class="large-8 cell">
                    <div class="callout">
                        <h2>Add New Order: <i class='fas fa-cart-plus'></i></h2>

                        <div class="grid-x grid-padding-x">

                            <div class="large-7 cell">
                                <label>Customer Name</label>
                                <input type="text" required name="customerName" placeholder="Customer Name" />
                            </div>
                            <div class="large-5 cell">
                                <label>Widget Count</label>
                                <input required pattern="number" type="number" name="widgetCount" placeholder="Widget Count" />
                            </div>
                            <div class="large-12 text-center cell">
                                <input type="submit" class='button' name="action" value='Add Order' />
                            </div>
                        </div>

                    </div>
                </div>

                <div class="large-4 cell">
                    <div class="callout">
                        <h3>Available Pack Sizes: <i class='fas fa-box-open'></i></h3>
<textarea rows="10" class="packsizes-output" name="packsizes">250
500
1000
2000
5000</textarea>

                    </div>
                </div>

            </div>
        </form>

        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <div class="callout">
                    <h2>Orders: <i class="fas fa-clipboard-list"></i></h2>
                    <table class="orders-output table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Order QTY</th>
                                <th>Dispatch Packs</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="text-center"><br><a href="#nogo" class="resetOrders button alert small"><i class="fas fa-times-circle"></i> Clear Orders</a></div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>
        var ordernumber = 0; // Start order number at 0. This would be loaded from DB in real life

        $('.resetOrders').click(function() { // Removes orders from the table and resets the order counter
            $('.orders-output tbody').html('');
            ordernumber = 0;
        });

        $('.ajax-submit').submit(function(event) { //Form Submission
            event.preventDefault(); // Forces the form to submit via AJAX. 
            var formdata = $(this).serialize(); // Serialize the form for AJAX submission
            $.get("action.php?action=Add Order&ordernumber=" + ordernumber + "&" + formdata).done(function(data) {
                $('.orders-output tbody').append(data); // Append the output from actions.php to the table
                ordernumber++; // Increment the order number.
            });

        });
    </script>
</body>

</html>
