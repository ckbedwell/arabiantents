<?

/**
 *
 * Template Name: Thank You Test Page
 */

function handle_error($user_error_message, $system_error_message)
{
  echo '<p>User Error Message: ' . $user_error_message . '</p>';
  echo '<p>System Error Message: ' . $system_error_message . '</p>';
}

get_header();

$which_form = $_POST["which-form"];
$page_url = $_POST["page-url"];

if (isset($_POST["field_events"])) {
  $field_event = $_POST["field_events"];
} else {
  $field_event = "";
}

//POSTCODE
$field_postcode = $_POST["field_postcode"];

// FUNITURE
$furniture_items = "";
$furniture_quantities = "";

if (!empty($_POST["furniture_item"])) {
  foreach ($_POST["furniture_item"] as $furniture_item) {
    $furniture_items .= '<tr><td>' . $furniture_item . '</td></tr>';
  }

  foreach ($_POST["furniture_quantity"] as $furniture_quantity) {
    $furniture_quantities .= '<tr><td>' . $furniture_quantity . '</td></tr>';
  }
}

$field_date = $_POST["field_date"];
$field_name = $_POST["field_name"];
$field_email = $_POST["field_email"];
$field_telephone = $_POST["field_telephone"];
$field_message = $_POST["field_message"];

$field_width = $_POST["field_width"];
$field_length = $_POST["field_length"];
$field_height = $_POST["field_height"];


if ($field_email) {

  $mail_to = "ckbedwell@gmail.com";
  // $mail_to = "info@arabiantents.com, ckbedwell@gmail.com";
  $subject = "Arabian Tents Enquiry from " . $field_name . " (" . $field_date . ")";

  include(locate_template('/partials/email-templates/enquiry-email-test.php'));

  $headers .= "Reply-To: " . $field_email . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  $headers_customer .= "Reply-To: info@arabiantents.com\r\n";
  $headers_customer .= "MIME-Version: 1.0\r\n";
  $headers_customer .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
}
?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <section class="width-contain sectioned text-center">
    <h1 class="page-title">Thank you for your enquiry</h1>
    <p>We have sent a confirmation of your message to the email you have provided (<?= $field_email; ?>).</p>
    <p>We will be in touch shortly.</p>
    <button class="action-button didnt-receive">What if you didn't receive a confirmation email?</button>
    <?= inc('/partials/overlays/didnt-receive-email.php', ['email' => $field_email]); ?>
  </section>
  <style>
  .didnt-receive {
    margin: 0 auto 4rem;
  }
  </style>
  <script>
  jQuery(document).ready(function($) {
    $('.didnt-receive').on('click', function() {
      $('.didnt-receive-email').toggleClass('hide');
    });
  });
  </script>

  <? if (true) : ?>
  <section class="width-contain">
    <h2 class="section-header">Have you thought about any of these for your event?</h2>
    <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'page',
          'post__in' => array(2647, 2672, 2760, 2660),
        ]),
        'ratio' => [1, 1]
      ]); ?>

    <?
      echo $$upload_dir;
      // js-enabled added from js/digicrab.js to try and stop spam bots which have JavaScript disabled
      // disable form submissions that don't originate from  $_SEVER[HTTP_HOST] // e.g. arabiantents.com



      if ($field_email && strpos($field_email, 'example.com') === false && $field_name && $_POST["js-enabled"] && strpos($page_url, $_SERVER["HTTP_HOST"]) !== false) {
        mail($mail_to, $subject, $body_message, $headers);
        mail($field_email, 'Thank you for your enquiry', $body_message, $headers_customer);
      }
      ?>
  </section>
  <? endif; ?>
  <?php
  if ($field_email) {

    if ($which_form == 'Quick Enquiry Form' || $which_form == 'Tent Enquiry Form' || $which_form == 'Furniture Enquiry Form' || $which_form == 'Venue Dressing Form' || $which_form == 'Event Enquiry Form') {
      if (check_member_exists($field_email)) {
        create_opportunity($field_email, $field_name, $field_telephone, $field_message, $files_file, $files_name);
      } else {
        if (create_new_memeber($field_email, $field_name, $field_telephone, $field_message)) {
          create_opportunity($field_email, $field_name, $field_telephone, $field_message, $files_file, $files_name);
        }
      }
    }
  }

  function check_member_exists($user_email)
  {
    $check = false;
    global $created_member_id;
    global $created_memebr_billing_address_id;
    $head = array('Accept' => 'application/json', 'Content-Type' => 'application/json; charset=utf-8', 'X-SUBDOMAIN' => 'houseofhudltd', 'X-AUTH-TOKEN' => 'w-CNX2NmVq7cb_ssxT6Z');
    $url = 'https://api.current-rms.com/api/v1/members?q[work_email_address_eq]=' . $user_email;

    $args = array(
      'headers' => $head,
      'method' => 'GET', // GET, POST, PUT, DELETE, etc.
      'sslverify' => false,
      'timeout' => 30
    );
    $response = wp_remote_request($url, $args);

    if (is_array($response) && isset($response['response']['code'])) {
      $code = $response['response']['code'];
      if ($code == 204) {
        $check = false;
      } else if ($code == 401) {
        $check = false;
      } else {
        $body = json_decode($response['body']);
        if (!empty($body->members)) {
          $created_member_id = $body->members[0]->id;
          $created_memebr_billing_address_id = $body->members[0]->primary_address->id;
          $check = true;
        } else {

          $check = false;
        }
      }
    } else if (is_wp_error($response)) {
      $check = false;
    }

    return $check;
  }
  function create_new_memeber($user_email, $your_name, $field_telephone, $your_message)
  {
    $check = false;
    global $created_member_id;
    global $created_memebr_billing_address_id;
    $data = array(
      "member" => array(
        "name" => $your_name,
        "description" =>  "New Account Created",
        "active" =>  true,
        "bookable" => false,
        "membership_type" =>  "Organisation",
        "custom_fields" => array(),
        "membership" => array(
          "owned_by" =>  1
        ),
        "primary_address" => array(
          "name" =>  $your_name,
          "country_id" => "1",
          "type_id" =>  3001,
          "address_type_name" =>  "Primary",
          "postcode" => $_POST["field_postcode"],
          "created_at" =>  date('d/m/Y'),
          "updated_at" =>  date('d/m/Y'),
        ),
        "emails" =>  array(
          array(
            "address" =>  $user_email,
            "email_type_name" =>  "Work"
          ),
        ),
        "phones" => array(
          array(
            "number" =>  $field_telephone,
            "phone_type_name" =>  "Work",
          ),
        ),
      )
    );

    $head = array('Accept' => 'application/json', 'Content-Type' => 'application/json; charset=utf-8', 'X-SUBDOMAIN' => 'houseofhudltd', 'X-AUTH-TOKEN' => 'w-CNX2NmVq7cb_ssxT6Z');
    $url = 'https://api.current-rms.com/api/v1/members';

    $body = json_encode($data);

    $args = array(
      'body' => $body,
      'headers' => $head,
      'method' => 'POST', // GET, POST, PUT, DELETE, etc.
      'sslverify' => false,
      'timeout' => 30
    );
    $response = wp_remote_request($url, $args);
    //print_r($response);die();
    if (is_array($response) && isset($response['response']['code'])) {
      $code = $response['response']['code'];
      if ($code == 204) {
        $check = false;
      } else if ($code == 401) {
        $check = false;
      } else {
        $body_resp = json_decode($response['body']);
        if (!empty($body_resp->member)) {
          $created_member_id = $body_resp->member->id;
          $created_memebr_billing_address_id = $body_resp->member->primary_address->id;
          $check = true;
        } else {

          $check = false;
        }
      }
    } else if (is_wp_error($response)) {
      $check = false;
    }

    return $check;
  }
  function create_opportunity($field_email, $field_name, $field_telephone, $field_message, $filesfile, $filesname)
  {
    $check = false;
    global $created_member_id;
    global $created_memebr_billing_address_id;
    global $opportunity_id;

    $head = array('Accept' => 'application/json', 'Content-Type' => 'application/json; charset=utf-8', 'X-SUBDOMAIN' => 'houseofhudltd', 'X-AUTH-TOKEN' => 'w-CNX2NmVq7cb_ssxT6Z');
    $url = 'https://api.current-rms.com/api/v1/opportunities';

    if ($_POST["which-form"] == 'Quick Enquiry Form') {
      $data = array(
        "opportunity" => array(
          "project_id" => NULL,
          "member_id" => $created_member_id,
          "billing_address_id" => $created_memebr_billing_address_id,
          "venue_id" => NULL,
          "tax_class_id" => 1,
          "subject" => "Web Enquiry - " . $field_name,
          "description" => $field_message,
          "number" => "",
          "starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "ordered_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "quote_invalid_at" => "",
          "state" => 1,
          "use_chargeable_days" => false,
          "chargeable_days" => 1,
          "open_ended_rental" => false,
          "invoiced" => false,
          "rating" => 4,
          "revenue" => "0",
          "customer_collecting" => false,
          "customer_returning" => false,
          "reference" => "",
          "delivery_instructions" => "",
          "owned_by" => 1,
          "prep_starts_at" => "",
          "prep_ends_at" => "",
          "load_starts_at" => "",
          "load_ends_at" => "",
          "deliver_starts_at" => "",
          "deliver_ends_at" => "",
          "setup_starts_at" => "",
          "setup_ends_at" => "",
          "show_starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "show_ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "takedown_starts_at" => "",
          "takedown_ends_at" => "",
          "collect_starts_at" => "",
          "collect_ends_at" => "",
          "unload_starts_at" => "",
          "unload_ends_at" => "",
          "deprep_starts_at" => "",
          "deprep_ends_at" => "",
          "custom_fields" => array(
            "website_reference" => site_url(),
            "page_reference" => $_POST['page-url'],
            "contact_email" => $field_email,
            "contact_name" => $field_name,
            "contact_number" => $field_telephone,
            "enquiry_message" => $field_message,
            "event_type_and_date" => $_POST["field_events"] . " " . $_POST["field_date"],
            "enquiry_message" => $field_message,
            "venue_postcode" => $_POST["field_postcode"],
          ),
          "participants" => array(
            array(
              "member_id" => 1707,
              "mute" => false,
              "id" => "",
              "member_name" => "Katherine Hudson",
              "assignment_id" => "",
            ),
            array(
              "member_id" => 1,
              "mute" => false,
              "id" => "",
              "member_name" => "Jon Cox",
              "assignment_id" => "",
            ),
          )
        )
      );
    }
    if ($_POST["which-form"] == 'Tent Enquiry Form') {
      $data = array(
        "opportunity" => array(
          "project_id" => NULL,
          "member_id" => $created_member_id,
          "billing_address_id" => $created_memebr_billing_address_id,
          "venue_id" => NULL,
          "tax_class_id" => 1,
          "subject" => "Web Enquiry - " . $field_name,
          "description" => $field_message,
          "number" => "",
          "starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "ordered_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "quote_invalid_at" => "",
          "state" => 1,
          "use_chargeable_days" => false,
          "chargeable_days" => 1,
          "open_ended_rental" => false,
          "invoiced" => false,
          "rating" => 4,
          "revenue" => "0",
          "customer_collecting" => false,
          "customer_returning" => false,
          "reference" => "",
          "delivery_instructions" => "",
          "owned_by" => 1,
          "prep_starts_at" => "",
          "prep_ends_at" => "",
          "load_starts_at" => "",
          "load_ends_at" => "",
          "setup_starts_at" => "",
          "setup_ends_at" => "",
          "show_starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "show_ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "takedown_starts_at" => "",
          "takedown_ends_at" => "",
          "unload_starts_at" => "",
          "unload_ends_at" => "",
          "deprep_starts_at" => "",
          "deprep_ends_at" => "",
          "custom_fields" => array(
            "website_reference" => site_url(),
            "page_reference" => $_POST['page-url'],
            "contact_email" => $field_email,
            "contact_name" => $field_name,
            "contact_number" => $field_telephone,
            "event_type_and_date" => $_POST["field_events"] . " " . $_POST["field_date"],
            "number_of_guests" => $_POST["field_total_guests"],
            "enquiry_message" => $field_message,
            "venue_postcode" => $_POST["field_postcode"],
          ),
          "participants" => array(
            array(
              "member_id" => 1707,
              "mute" => false,
              "id" => "",
              "member_name" => "Katherine Hudson",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
            array(
              "member_id" => 1,
              "mute" => false,
              "id" => "",
              "member_name" => "Jon Cox",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
          )
        )
      );
    }
    if ($_POST["which-form"] == 'Furniture Enquiry Form') {
      $data = array(
        "opportunity" => array(
          "project_id" => NULL,
          "member_id" => $created_member_id,
          "billing_address_id" => $created_memebr_billing_address_id,
          "venue_id" => NULL,
          "tax_class_id" => 1,
          "subject" => "Web Enquiry - " . $field_name,
          "description" => $field_message,
          "number" => "",
          "starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "ordered_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "quote_invalid_at" => "",
          "state" => 1,
          "use_chargeable_days" => false,
          "chargeable_days" => 1,
          "open_ended_rental" => false,
          "invoiced" => false,
          "rating" => 4,
          "revenue" => "0",
          "customer_collecting" => false,
          "customer_returning" => false,
          "reference" => "",
          "delivery_instructions" => "",
          "owned_by" => 1,
          "prep_starts_at" => "",
          "prep_ends_at" => "",
          "load_starts_at" => "",
          "load_ends_at" => "",
          "setup_starts_at" => "",
          "setup_ends_at" => "",
          "show_starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "show_ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "takedown_starts_at" => "",
          "takedown_ends_at" => "",
          "unload_starts_at" => "",
          "unload_ends_at" => "",
          "deprep_starts_at" => "",
          "deprep_ends_at" => "",
          "custom_fields" => array(
            "website_reference" => site_url(),
            "page_reference" => $_POST['page-url'],
            "contact_email" => $field_email,
            "contact_name" => $field_name,
            "contact_number" => $field_telephone,
            "hire_date" => $_POST["field_date"],
            "enquiry_message" => $field_message,
            "venue_postcode" => $_POST["field_postcode"],
          ),
          "participants" => array(
            array(
              "member_id" => 1707,
              "mute" => false,
              "id" => "",
              "member_name" => "Katherine Hudson",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
            array(
              "member_id" => 1,
              "mute" => false,
              "id" => "",
              "member_name" => "Jon Cox",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
          )
        )
      );
    }
    if ($_POST["which-form"] == 'Event Enquiry Form') {
      $data = array(
        "opportunity" => array(
          "project_id" => NULL,
          "member_id" => $created_member_id,
          "billing_address_id" => $created_memebr_billing_address_id,
          "venue_id" => NULL,
          "tax_class_id" => 1,
          "subject" => "Web Enquiry - " . $field_name,
          "description" => $field_message,
          "number" => "",
          "starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "ordered_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "quote_invalid_at" => "",
          "state" => 1,
          "use_chargeable_days" => false,
          "chargeable_days" => 1,
          "open_ended_rental" => false,
          "invoiced" => false,
          "rating" => 4,
          "revenue" => "0",
          "customer_collecting" => false,
          "customer_returning" => false,
          "reference" => "",
          "delivery_instructions" => "",
          "owned_by" => 1,
          "prep_starts_at" => "",
          "prep_ends_at" => "",
          "load_starts_at" => "",
          "load_ends_at" => "",
          "setup_starts_at" => "",
          "setup_ends_at" => "",
          "show_starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "show_ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "takedown_starts_at" => "",
          "takedown_ends_at" => "",
          "unload_starts_at" => "",
          "unload_ends_at" => "",
          "deprep_starts_at" => "",
          "deprep_ends_at" => "",
          "custom_fields" => array(
            "website_reference" => site_url(),
            "page_reference" => $_POST['page-url'],
            "contact_email" => $field_email,
            "contact_name" => $field_name,
            "contact_number" => $field_telephone,
            "event_type_and_date" => $_POST["field_events"] . " " . $_POST["field_date"],
            "number_of_guests" => $_POST["field_total_guests"],
            "enquiry_message" => $field_message,
            "venue_postcode" => $_POST["field_postcode"],
            "number_of_dining_guests" => $_POST["field_dining_guests"],
          ),
          "participants" => array(
            array(
              "member_id" => 1707,
              "mute" => false,
              "id" => "",
              "member_name" => "Katherine Hudson",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
            array(
              "member_id" => 1,
              "mute" => false,
              "id" => "",
              "member_name" => "Jon Cox",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
          )
        )
      );
    }
    if ($_POST["which-form"] == 'Venue Dressing Form') {
      $data = array(
        "opportunity" => array(
          "project_id" => NULL,
          "member_id" => $created_member_id,
          "billing_address_id" => $created_memebr_billing_address_id,
          "venue_id" => NULL,
          "tax_class_id" => 1,
          "subject" => "Web Enquiry - " . $field_name,
          "description" => $field_message,
          "number" => "",
          "starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "ordered_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "quote_invalid_at" => "",
          "state" => 1,
          "use_chargeable_days" => false,
          "chargeable_days" => 1,
          "open_ended_rental" => false,
          "invoiced" => false,
          "rating" => 4,
          "revenue" => "0",
          "customer_collecting" => false,
          "customer_returning" => false,
          "reference" => "",
          "delivery_instructions" => "",
          "owned_by" => 1,
          "prep_starts_at" => "",
          "prep_ends_at" => "",
          "load_starts_at" => "",
          "load_ends_at" => "",
          "setup_starts_at" => "",
          "setup_ends_at" => "",
          "show_starts_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T00:00:00.000Z",
          "show_ends_at" => date('Y-m-d', strtotime($_POST["field_date"])) . "T23:55:00.000Z",
          "takedown_starts_at" => "",
          "takedown_ends_at" => "",
          "unload_starts_at" => "",
          "unload_ends_at" => "",
          "deprep_starts_at" => "",
          "deprep_ends_at" => "",
          "custom_fields" => array(
            "website_reference" => site_url(),
            "page_reference" => $_POST['page-url'],
            "contact_email" => $field_email,
            "contact_name" => $field_name,
            "contact_number" => $field_telephone,
            "venue_requirements" => $_POST["field_width"] . " " . $_POST["field_length"] . " " . $_POST["field_height"],
            "enquiry_message" => $field_message,
            "venue_postcode" => $_POST["field_postcode"],
            "event_type_and_date" => $_POST["field_events"] . " " . $_POST["field_date"],
            "number_of_guests" => $_POST["field_total_guests"],
            "number_of_dining_guests" => $_POST["field_dining_guests"],
          ),
          "participants" => array(
            array(
              "member_id" => 1707,
              "mute" => false,
              "id" => "",
              "member_name" => "Katherine Hudson",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
            array(
              "member_id" => 1,
              "mute" => false,
              "id" => "",
              "member_name" => "Jon Cox",
              "created_at" => date('Y-m-d\TH:i:s', time()),
              "updated_at" => date('Y-m-d\TH:i:s', time()),
              "assignment_id" => "",
            ),
          )

        )
      );
    }
    $body = json_encode($data);
    //var_dump($body);die();
    $args = array(
      'body' => $body,
      'headers' => $head,
      'method' => 'POST', // GET, POST, PUT, DELETE, etc.
      'sslverify' => false,
      'timeout' => 30
    );
    $response = wp_remote_request($url, $args);
    //var_dump($response['body']);die();
    if (is_array($response) && isset($response['response']['code'])) {
      $code = $response['response']['code'];
      if ($code == 204) {
        $check = false;
      } else if ($code == 401) {
        $check = false;
      } else {
        $res_body = json_decode($response['body']);
        if (!empty($res_body->opportunity)) {
          $opportunity_id = $res_body->opportunity->id;
        }
        $check = true;
      }
    } else if (is_wp_error($response)) {
      $check = false;
    }

    return $check;
  }
  ?>
  </div>



  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? include(locate_template('footer.php')); ?>