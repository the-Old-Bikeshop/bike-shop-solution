<?php
//include_once('../controllers/SessionHandler.php');
//$session = new SessionHandle();
//$session->startSession();

$_SESSION['active_orderID'] = 1244233;

$_SESSION['basket'] = [
    [
        'name' => 'one',
        'quantity' => 2,
        'price' => 200
    ],

    [
        'name' => 'two',
        'quantity' => 1,
        'price' => 1200
    ]
]

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
    <!--[if gte mso 9]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="x-apple-disable-message-reformatting">
      <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
      <title></title>
        <style type="text/css">
            body {
                background: #191414;
                color: #F5F5F5;
                min-height: 100vh;
                padding: 4rem 2rem;
            }
            h1, h2 {
                color: #FFFFFF;
                text-transform: uppercase;
                text-align: center;
            }
            h1  {
                color: #33CC99;

            }
            table {
                margin: 0 auto;
            }
            td, th {
                padding: 3rem 5rem;
                border: 1px solid #33CC99;
                text-align: center;
            }


        </style>
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <td>

                        <h1>Hello <?php  echo $_SESSION['last_name'] ?? "Anonymous" ?>  <?php  echo $_SESSION['first_name'] ??
                                "Anonymous" ?>  Thank you for your order</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>payment for order nr <?php  echo $_SESSION['active_orderID'] ?? "test" ?>
                            was confirmed it will be dispatched as soon as possible</h2>
                    </td>
                </tr>

            </tbody>

        </table>

        <table>
            <tbody>
            <tr>
                <td>
                    <h2>
                        Order Details
                    </h2>
                </td>
            </tr>
            </tbody>

        </table>

        <table>
            <tbody>
            <tr>
                <th>
                   Item
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Price
                </th>
            </tr>
            <?php if(isset($_SESSION['basket'])): ?>
                <?php foreach ($_SESSION['basket']as $product):
                    ?>
                <tr>
                    <td>
                        <?php echo $product['name'] ?? 'name' ?>
                    </td>
                    <td>
                        <?php echo intval($product['quantity'] )?? 1 ?>
                    </td>
                    <td>
                        <?php echo intval($product['price']) * intval($product['quantity']) ?? '1000' ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>


        </table>

    </body>

</html>

