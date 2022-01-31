<?

$body_message = '<html>

<div marginwidth="0" marginheight="0" style="margin:0px;padding:0px;background-color:rgb(235,235,235);font-family:Helvetica;font-size:12px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;width:100%!important;">
    <center>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="margin:0px;padding:0px;height:100%!important;width:100%!important;/* background-color:rgb(235,235,235); */">
            <tbody>
                <tr>
                    <td align="center" valign="top" style="border-collapse:collapse">
                        <table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid rgb(221,221,221);background-color:rgb(255,255,255);">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse">
                                        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:rgb(247,247,247);border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(220,220,220)">
                                            <tbody>
                                                <tr>
                                                    <td style="border-collapse:collapse;color:rgb(32,32,32);font-family:Arial;font-size:34px;font-weight:bold;line-height:34px;padding:20px;text-align:center;vertical-align:middle">
                                                        <img src="http://arabiantents.com/wp-content/themes/arabiantents/images/arabian-tents-logo.png" style="border:0px;min-height:auto;line-height:34px;outline:none;text-decoration:none;max-width:600px" class="CToWUd">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse">
                                        <table border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="border-collapse:collapse;background-color:rgb(255,255,255)">
                                                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" style="border-collapse:collapse">
                                                                        <div style="color:rgb(80,80,80);font-family:Arial;font-size:14px;line-height:21px;text-align:left">
                                                                        Dear ' . $field_name .',<br/><br/>
                                                                        Thank you very much for your enquiry to <strong>The Arabian Tent Company</strong>. It is landing safely in the In-box of our team at this very moment!<br/><br/>

                                                                        The Arabian Tent Company is part of <strong><a href="https://houseofhud.com/">House of Hud</a></strong> and the email reply you\'ll receive to your enquiry will be from <a href="mailto:info@houseofhud.com">info@houseofhud.com</a>.<br/><br/>

                                                                        To ensure you receive our email reply, please add <a href="mailto:info@houseofhud.com">info@houseofhud.com</a> to your <strong>Safe Senders List</strong>. or check your spam folder in 24 hours for our detailed reply as the email you receive will also contain a link to a tailored Proposal, and potentially Attachments too, which may get filtered into your Junk folder if your Inbox doesn’t recognise the sender.<br/><br />
                                                                        
                                                                        We endeavour to respond to all enquiries within 24 working hours but if you have an urgent matter feel free to call direct on <strong>0800 193 5229</strong>.<br/><br/>

                                                                        Below is the message we have received that we will be responding to. If there is anything you would like to add to this, please email us at <a href="mailto:info@houseofhud.com">info@houseofhud.com</a>. We look forward to working with you.<br/><br/>
                                                                        Warm wishes,<br/><br/>
                                                                        Katherine<br/>
                                                                        Founder and Director - The Arabian Tent Company<br/><br/>';

$body_message .= '<strong>Enquiry Form:</strong> '.$which_form.'<br/>';
$body_message .= '<strong>Sent from:</strong> '.$page_url.'<br/><br/>';

$body_message .= '<strong>From:</strong> '.$field_name. '<br/>';
$body_message .= '<strong>E-mail:</strong> '.$field_email.'<br/><br/>';
$body_message .= '<strong>Telephone:</strong> '.$field_telephone.'<br/><br/>';

if($_FILES['field_file']['name']) {
    $body_message .= '<strong>Venue Image:</strong><br/><img width="100%" src=' . wp_upload_dir()['baseurl'] . '/customer-uploads/' . $now . $_FILES[$image_fieldname]['name'] . '><br/><br/><br/>';
    }

if($field_width || $field_length || $field_height) {
    $body_message .= '<strong>Measurements: </strong> <ul><li>Width: ' . $field_width . '</li><li>Length: ' . $field_length . '</li><li>Height: ' . $field_height . '</li></ul><br/><br/>';
    }

if($field_event) {
    $body_message .= '<strong>Type of event:</strong> '.$field_event.'<br/>';
    }

if($field_total_guests) {
    $body_message .= '<strong>Total Guests:</strong> '. $field_total_guests .'<br/>';
    $body_message .= '<strong>Dining Guests:</strong> '. $field_dining_guests .'<br/>';
    }

if($date_types || $field_date) {
    $body_message .= '<strong>Date:</strong> '. $field_date .' (' . $date_types . ')<br/><br/>';
    }

if($field_postcode) {
    $body_message .= '<strong>Postcode/location:</strong> '. $field_postcode .'<br/><br/>';
    }

$body_message .= '<strong>Message:</strong> '.$field_message.'<br/><br/>';

if($furniture_items) {
    $body_message .= '<table style="float: left; text-align:center; border-collapse: collapse;" width="49%" border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Furniture Item</th>
                </tr>
            </thead>
            <tbody>' .$furniture_items . '</tobdy></table>';

    $body_message .= '<table style="float: left; text-align:center; border-collapse: collapse; border-left: none;" width="49%" border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>' .$furniture_quantities . '</tobdy></table>';
            }
$body_message .='




                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse">
                                        <table border="0" cellpadding="10" cellspacing="0" width="600" style="background-color:rgb(255,255,255);border-top-width:0px">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="border-collapse:collapse">
                                                        <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2" valign="middle" style="border-collapse:collapse;background-color:rgb(250,250,250);border:0px">
                                                                        <div style="color:rgb(112,112,112);font-family:Arial;font-size:10px;line-height:12px;text-align:left"></div>
                                                                        <div style="color:rgb(112,112,112);font-family:Arial;font-size:10px;line-height:12px;text-align:left"><br>
                                                                        This email is a system notification, for questions regarding the website please email us at<span>&nbsp;</span><a href="mailto:info@arabiantents.com" style="color:rgb(51,102,153);font-weight:normal;text-decoration:underline" target="_blank">info@arabiantents.com</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>

</div>';
