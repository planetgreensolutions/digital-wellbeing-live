<!doctype html>
<html lang="en">
<head>
    <title>Certificate</title>
    <meta charset="utf-8">
    <style>
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        body{
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body style="background:#f0f0f0; padding: 0; margin: 0; font-family: 'calibri', Arial, Helvetica, sans-serif;"  >
     <table align="center" style="border: none;height: auto;  border:5px solid #0bbfd7;  padding: 7px; margin-top: 20px; margin-bottom: 20px;" height="860" width="1100">
        <tbody>

            <tr>
                <td>
                    <table style="width: 100%;  background-color: #FFF;  border:5px solid #e6e6e6; padding-left: 20px; padding-right: 20px;">
                        <tbody>
                            <tr>
                                <td colspan="3" style="height: 50px;"></td>
                            </tr>

                            <tr>
                                {{-- <td style="padding-left: 40px; text-align: left"><img src="assets/frontend/dist/images/certificate_assets/logo_11.jpg" style="width: 400px; float: left;"></td> --}}
                                <td style="padding-left: 40px; text-align: left"><img src="assets/frontend/dist/images/certificate_assets/logo_1.jpg" style="width: 400px; float: left;"></td>
                                <td></td>
                                <td style="padding-right: 40px; text-align: right;"><img src="assets/frontend/dist/images/certificate_assets/emblem.jpg" style="width: 90px; float: right;"></td>
                            </tr>

                            <tr>
                                <td colspan="3" style="height: 50px;"></td>
                            </tr>

                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <!-- <h2 style="display: block; text-align: center; font-size: 40px; text-transform: uppercase; color: #00bed6; font-weight: bold;">Positive Digital Citizen Certificate</h2> -->
                                    <img src="assets/frontend/dist/images/certificate_assets/en_heading.png" style="width: 1000px; height: auto;">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" style="height: 70px; text-align: center;padding-top: 50px; ">
                                    <table style="border-bottom: 2px solid #000000; width: 60%; margin-left: auto; margin-right: auto;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                     <h3 style="font-size: 35px; font-weight: bold; margin-top: 0; margin-bottom: 0;   line-height: 65px;">{{$contact_name}}</h3>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" style="height: 40px;"></td>
                            </tr>

                            <tr>
                                <td colspan="3" style=" text-align: center; font-size: 25px; line-height: 1.5; ">
                                    {{-- <strong style="display: block;">For upholding to the guidelines of the United Arab Emirates<br/>Digital Citizenship Values Charter</strong> --}}
                                    <strong style="display: block;">Awarded to those who uphold the principles of the<br/>UAE Positive Digital Citizenship Values ​​Charter.</strong>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" style="height: 150px;"></td>
                            </tr>

                            <tr style="padding-bottom: 30px">
                                <?php
$currDate = strtotime("now");

$date = date('d', $currDate) . " " . Lang::get("messages." . strtolower(date('M', $currDate))) . " " . date('Y', $currDate);
?>

                                 <td style="text-align: center;padding-bottom: 30px; padding-left: 50px;" width="300">
                                   <table >
                                    <tr>
                                        <td>
                                            <p style=" float:left; font-size: 22px; line-height: 1.5;  padding-left: 50px;">{{$date}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style=" float:left; font-size: 22px; line-height: 1.5; display: block; width: 100%;">Date</p>
                                        </td>
                                    </tr>
                                   </table>
                                </td>
                                <td  >
                                     <img src="assets/frontend/dist/images/certificate_assets/bg_new.jpg" style="width: 100%; ">
                                </td>
                                <td style="text-align: center;padding-bottom: 30px; padding-left: 50px;" width="300">
                                   <table >
                                    <tr>
                                        <td>
                                            <img src="assets/frontend/dist/images/certificate_assets/dw_sign_en.jpg" style="width: 300px; float: right;padding-right: 40px;padding-bottom: 30px;">
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>
                                            <p style=" float:left; font-size: 22px; line-height: 1.5; display: block; width: 100%;">Signature</p>
                                        </td>
                                    </tr> --}}
                                   </table>
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
