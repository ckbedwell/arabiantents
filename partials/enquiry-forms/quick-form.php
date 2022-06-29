<?php
$name = array(
  'id' => 'field_name',
  'label' => 'Your name:',
  'placeholder' => 'Name',
  'type' => 'text',
  'error' => 'Please enter your name',
);

$email = array(
  'id' => 'field_email',
  'label' => 'Your email:',
  'placeholder' => 'john@smith.com',
  'type' => 'email',
  'error' => 'Please enter a valid email address',
);

$tel = array(
  'id' => 'field_telephone',
  'label' => 'Your telephone:',
  'placeholder' => 'telephone',
  'type' => 'tel',
  'error' => 'Please enter a valid telephone number',
);

$date = array(
  'id' => 'field_date',
  'label' => 'When?',
  'type' => 'date',
  'error' => 'Please enter a valid date',
);

$eventType = array(
  'id' => 'field_events',
  'label' => 'What is your event?',
  'options' => array(
    'Wedding',
    'Party',
    'Corporate Event',
    'Festival'
  ),
  'error' => 'Please select an event type',
);

$location = array(
  'id' => 'field_postcode',
  'label' => "What's the location of your venue?",
  'placeholder' => 'Postcode / location',
  'type' => 'text',
  'tooltip' => "If you don't have an exact postcode, give us an indication of whereabouts in the country your venue will be so we can quote for delivery.",
  'error' => 'Please enter a location',
);

$message = array(
  'id' => 'field_message',
  'label' => 'Your message:',
  'error' => 'Please enter a message',
);
?>

<section class="contact-form sectioned highlight-section">
  <div class="width-contain">
    <div class="grid">
      <div>
        <h2 class="secondary contact-form__title">Tell us about your Event!</h2>
        <p>We look forward to hearing what you're planning; when you get in touch do let us know:</p>
        <ul>
          <li>
            the number of guests you're expecting, and whether you need the space to be socially distanced or not
          </li>
          <li>
            what tent/ furniture/ service you are interested in,
          </li>
          <li>
            the date of your event,
          </li>
          <li>
            the delivery location.
          </li>
        </ul>
        <p>
          From 2020 we have limited our delivery distance to within 100 miles within our West Sussex base, to help reduce carbon emissions.</p>
        <p>
          Ask about our Eco tips for your next event.
        </p>
        <p>
          You can contact us directly by calling 0800 193 5229 emailing info@arabiantents.com or you can use the enquiry form opposite.
        </p>
      </div>
      <form action="thank-you" method="post" class="">
        <div class="fields-wrapper">
          <div class="grid-3 grid-1-t gap-2">
            <?php createInputField($name); ?>
            <?php createInputField($email); ?>
            <?php createInputField($tel); ?>
          </div>

          <div>
            <?php createRadioField($eventType); ?>
          </div>
          <div class="grid-2 grid-1-m gap-2">
            <?php createInputField($date); ?>
            <?php createInputField($location); ?>
          </div>
          <?php createTextArea($message); ?>
        </div>

        <input type="hidden" name="which-form" value="Quick Enquiry Form" />
        <input type="hidden" name="page-url" value="<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
        <input type="submit" name="quick-form" data-id="quick-form" id="submit_results" class="action-button" placeholder="Submit" />
      </form>
    </div>
  </div>
</section>
<script>
  let hasListeners = false
  let fieldErrors = {
    field_name: false,
    field_email: false,
    field_telephone: false,
    field_events: false,
    field_date: false,
    field_postcode: false,
    field_message: false
  }

  document.querySelector(".contact-form input[type='submit']").addEventListener("click", (e) => {
    const form = jQuery(e.target).closest("form")
    const nameField = jQuery(form).find("input[name='field_name']")
    const emailField = jQuery(form).find("input[name='field_email']")
    const telephoneField = jQuery(form).find("input[name='field_telephone']")
    const eventField = jQuery(form).find("input[name='field_events']")
    const dateField = jQuery(form).find("input[name='field_date']")
    const locationField = jQuery(form).find("input[name='field_postcode']")
    const messageField = jQuery(form).find("textarea[name='field_message']")

    if (!hasListeners) {
      nameField.on("input", () => {
        hasName(), renderErrors()
      })
      emailField.on("input", () => {
        hasEmail(), renderErrors()
      })
      telephoneField.on("input", () => {
        hasTelephone(), renderErrors()
      })
      eventField.on("input", () => {
        hasEvent(), renderErrors()
      })
      dateField.on("input", () => {
        hasDate(), renderErrors()
      })
      locationField.on("input", () => {
        hasLocation(), renderErrors()
      })
      messageField.on("input", () => {
        hasMessage(), renderErrors()
      })
      hasListeners = true
    }

    hasName()
    hasEmail()
    hasTelephone()
    hasEvent()
    hasDate()
    hasLocation()
    hasMessage()
    renderErrors()
    submit()

    function hasName() {
      if (!nameField.val()) {
        fieldErrors.field_name = true
      } else {
        fieldErrors.field_name = false
      }
    }

    function hasEmail() {
      var value = emailField.val()
      var pattern =
        /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
      var isValid = pattern.test(value);

      if (!isValid) {
        fieldErrors.field_email = true
      } else {
        fieldErrors.field_email = false
      }
    }

    function hasTelephone() {
      if (!telephoneField.val()) {
        fieldErrors.field_telephone = true
      } else {
        fieldErrors.field_telephone = false
      }
    }

    function hasEvent() {
      if (!jQuery(form).find("input[name='field_events']:checked").val()) {
        fieldErrors.field_events = true
      } else {
        fieldErrors.field_events = false
      }
    }

    function hasDate() {
      if (!dateField.val()) {
        fieldErrors.field_date = true
      } else {
        fieldErrors.field_date = false
      }
    }

    function hasLocation() {
      if (!locationField.val()) {
        fieldErrors.field_postcode = true
      } else {
        fieldErrors.field_postcode = false
      }
    }

    function hasMessage() {
      if (!messageField.val()) {
        fieldErrors.field_message = true
      } else {
        fieldErrors.field_message = false
      }
    }

    function renderErrors() {
      Object.entries(fieldErrors).forEach(([key, value]) => {
        if (value) {
          jQuery(form).find(`.${key}`).addClass("error")
        } else {
          jQuery(form).find(`.${key}`).removeClass("error")
        }
      })
    }

    function submit() {
      if (Object.values(fieldErrors).includes(true)) {
        e.preventDefault()
      } else {
        console.log("success")
      }
    }
  })
</script>
<?php
function createInputField($props)
{
  $id = $props['id'];
  $label = $props['label'];
  $placeholder = $props['placeholder'];
  $type = $props['type'];
  $tooltip = $props['tooltip'];
  $error = $props['error'];
  ob_start();
?>
  <div class="input-field <?= $id; ?>">
    <div class="flex gap-1">
      <label class="heading-label"><?= $label; ?></label>
      <?php if (isset($tooltip)) {
        echo createTooltip($tooltip, $id);
      } ?>
    </div>
    <input type="<?= $type; ?>" name="<?= $id; ?>" id="<?= $id; ?>" placeholder="<?= $placeholder; ?>" />
    <?= createError($error); ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>

<?php
function createTextArea($props)
{
  $id = $props['id'];
  $label = $props['label'];
  $placeholder = $props['placeholder'];
  $tooltip = $props['tooltip'];
  $error = $props['error'];
  ob_start();
?>
  <div class="input-field <?= $id; ?>">
    <div class="flex gap-1">
      <label class="heading-label"><?= $label; ?></label>
      <?php if (isset($tooltip)) {
        echo createTooltip($tooltip, $id);
      } ?>
    </div>
    <textarea name="<?= $id; ?>" id="<?= $id; ?>" placeholder="<?= $placeholder; ?>" rows="8"></textarea>
    <?= createError($error); ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>


<?php
function createRadioField($props)
{
  $id = $props['id'];
  $label = $props['label'];
  $options = $props['options'];
  $error = $props['error'];
  ob_start();
?>
  <div class="input-field <?= $id; ?>">
    <label class="heading-label"><?= $label; ?></label>
    <div class="grid-4 grid-2-t gap-2">
      <?php foreach ($options as $option) : ?>
        <input type="radio" name="<?= $id; ?>" value="<?= $option; ?>" id="<?= $option; ?>" />
        <label class="action-button" for="<?= $option; ?>">
          <?= $option; ?>
        </label>
      <?php endforeach; ?>
    </div>
    <?= createError($error); ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>

<?php
function createError($errorMessage)
{
  ob_start();

?>
  <div class="error-message">
    <?= $errorMessage; ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>