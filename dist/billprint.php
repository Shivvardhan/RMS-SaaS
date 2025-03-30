<!DOCTYPE html>
<html lang="en">
<?php include("dbcon.php");?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill | System Vista</title>
    <link rel="icon" type="image/x-icon" href="assets/media/images/logo_w.png">
    <style>
    .bor {
        border-left: 1px solid black;
        border-right: 1px solid black;

    }

    .box {
        border: 1px solid black;
    }

    body {
        font-size: 15px;
    }

    .div1 {
        width: 900px;
        margin: auto;
    }

    @media print {
        .div1 {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="div1">


        <table style="border: none;border-collapse: collapse;width:100%;">
            <tbody>
                <?php 
                $o_id = $_GET['o_id'];
                $sql2 = "SELECT * FROM orders as o LEFT JOIN users as u ON o.uid=u.uid where o.o_id='$o_id';";

                $result = $conn->query($sql2);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { 
                        
                ?>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:35.1pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:#015ABB;font-size:37px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:.5pt solid #015ABB;border-right:none;border-bottom:.5pt solid #015ABB;border-left:.5pt solid #015ABB;width:297pt;padding-left:10px;">
                        <?php echo $row['r_name']; ?></td>
                    <td colspan="2"
                        style="padding:0px;color:white;font-size:37px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:.5pt solid #015ABB;border-right:.5pt solid #015ABB;border-bottom:.5pt solid #015ABB;border-left:none;background:#015ABB;width:214pt;">
                        Order Bill</td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding: 0px;color: rgb(110, 116, 122);font-size:15px;font-weight: 400;font-style: normal;text-decoration: none;font-family: Cambria, sans-serif;vertical-align: top;border: none;">
                        &nbsp;<table>
                            <tbody>
                                <tr>

                                </tr>
                            </tbody>
                        </table>&nbsp;</td>
                    <td
                        style="padding:0px;color:windowtext;font-size:16px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:bottom;border:none;width:65pt;">
                        Date:</td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:left;vertical-align:bottom;border:none;">
                        <?php $timest = $row['timestamp']; $str = explode(" ",$timest); echo $str[0];?></td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:15.0pt;width:16pt;">
                    </td>
                    <td rowspan="3"
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;width:297pt;">
                        <img src="assets/media/stock/etc/logo.png" alt="">
                    </td>
                    <td
                        style="padding:0px;color:windowtext;font-size:16px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:bottom;border:none;width:65pt;">
                        Order Id:</td>
                    <td
                        style="padding:0px;color:windowtext;font-size:16px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;text-align:left;">
                        <?php echo $row['o_id'];?></td>

                </tr>

                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>

                </tr>
                <tr>


                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:15.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:297pt;">
                        Dr. Bhim Rao Ambedkar Polythechnic college</td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:65pt;">
                        <br>
                    </td>

                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:15.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:297pt;">
                        Gwalior&nbsp;474002</td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:65pt;">
                        <br>
                    </td>

                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:14.25pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;text-align:left;width:297pt;">
                        Phone:&nbsp;0751-2320790</td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:65pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:149pt;">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:24.75pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;text-align:left;width:297pt;">
                    </td>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;width:65pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Tahoma, sans-serif;text-align:general;vertical-align:top;border:none;text-align:left;width:149pt;">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:white;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;background:#015ABB;width:297pt;border-top:1.0pt solid #404040;border-right:1.0pt solid #404040;border-bottom:1.0pt solid #404040;border-left:1.0pt solid #404040;">
                        DESCRIPTION</td>
                    <td
                        style="padding:0px;color:white;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:center;vertical-align:middle;border:none;background:#015ABB;border-top:1.0pt solid #404040;border-right:1.0pt solid #404040;border-bottom:1.0pt solid #404040;border-left:none;">
                        QTY</td>
                    <td
                        style="padding:0px;color:white;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:right;vertical-align:middle;border:none;background:#015ABB;border-top:1.0pt solid #404040;border-right: 1.0pt solid #404040;border-bottom:1.0pt solid #404040;border-left:none;">
                        AMOUNT</td>
                </tr>
                <?php $arr = json_decode($row['menu_item'], true); $length = count($arr); 
                
                for ($i = 0; $i < $length; $i++) {
                    $mid = $arr[$i]['id'];

                    $sql1 = "SELECT `m_id`, `uid`, `item`, `price`, `avaibility`, `rating`, `d_price` FROM `r_menu` WHERE m_id ='$mid';";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                            // output data of each row
                            while ($row1 = $result1->fetch_assoc()) {

                ?>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:black;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:.5pt solid #404040;border-right:.5pt solid #015ABB;border-bottom:.5pt solid #015ABB;border-left:  none;width:297pt;text-underline-style:none;text-line-through:  none;background:#F2F2F2;">
                        <?php echo $row1['item'];?></td>
                    <td
                        style="padding:0px;color:black;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:.5pt solid #404040;border-right:.5pt solid #015ABB;border-bottom:.5pt solid #015ABB;border-left:  .5pt solid #015ABB;text-underline-style:none;text-line-through:  none;background:#F2F2F2;">
                        <?php echo $arr[$i]['qty'];?></td>
                    <td
                        style="padding:0px;color:black;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #015ABB;border-left:.5pt solid #015ABB;width:149pt;text-underline-style:  none;text-line-through:none;border-top:.5pt solid #404040;background:#F2F2F2;">
                        ₹<?php echo $arr[$i]['price'];?>.00</td>
                </tr>

                <?php 
                            }
                        }    
                    }
            ?>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;width:297pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:#404040;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;">
                        SUBTOTAL &nbsp;</td>
                    <td
                        style="padding:0px;color:#404040;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, serif;text-align:right;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;">
                        ₹<?php echo $row['total'];?></td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td rowspan="3"
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;width:297pt;padding-right:5px;">
                        Make all checks payable to Restaurant Name. If you have any questions concerning this invoice,
                        contact to <?php echo $row['r_name']; ?> </td>
                    <td
                        style="padding:0px;color:#404040;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;">
                        TAX RATE &nbsp;</td>
                    <td
                        style="padding:0px;color:#404040;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, serif;text-align:right;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;">
                        10.00%</td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:#404040;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;">
                        GST</td>
                    <td
                        style="padding:0px;color:#404040;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, serif;text-align:right;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;">
                        ₹<?php $tax = floatval($row['total']/10.00); echo $tax; $taxTotal = $tax + $row['total'];?></td>
                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>

                </tr>
                <tr>
                    <td
                        style="padding:0px;color:#6E747A;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;height:30.0pt;width:16pt;">
                        <br>
                    </td>
                    <td
                        style="padding:0px;color:#262626;font-size:15px;font-weight:700;font-style:italic;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;width:297pt;">
                        THANK YOU FOR YOUR VISIT!</td>
                    <td
                        style="padding:0px;color:white;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;background:#015ABB;">
                        TOTAL &nbsp;</td>
                    <td
                        style="padding:0px;color:white;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Cambria, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:.5pt solid #404040;border-left:none;background:#015ABB;">
                        ₹<?php echo $taxTotal;?></td>
                </tr>

                <?php 
                 }
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>