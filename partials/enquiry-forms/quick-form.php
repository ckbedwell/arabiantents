<?php
$name = array(
  'id' => 'field_name',
  'label' => 'Your name:',
  'placeholder' => 'Name',
  'type' => 'text',
);

$email = array(
  'id' => 'field_email',
  'label' => 'Your email:',
  'placeholder' => 'john@smith.com',
  'type' => 'email',
);

$tel = array(
  'id' => 'field_telephone',
  'label' => 'Your telephone:',
  'placeholder' => 'telephone',
  'type' => 'tel',
);

$date = array(
  'id' => 'field_date',
  'label' => 'When?',
  'type' => 'date',
);

$eventType = array(
  'id' => 'field_events',
  'label' => 'What is your event?',
  'options' => array(
    'Wedding',
    'Party',
    'Corporate Event',
    'Festival'
  )
);

$location = array(
  'id' => 'field_postcode',
  'label' => "What's the location of your venue?",
  'placeholder' => 'Postcode / location',
  'type' => 'text',
  'tooltip' => "If you don't have an exact postcode, give us an indication of whereabouts in the country your venue will be so we can quote for delivery."
);

$message = array(
  'id' => 'field_message',
  'label' => 'Your message:',
);
?>

<section class="contact-form">
  <div class="width-contain">
    
    <div class="grid">
      <div>
        <h2 class="secondary contact-form__title">Tell us about your Event!</h2>
        <p>Due to Covid-19 we may take slightly longer than the usul 24 hours to reply to your enquiry but look forward to hearing what you're planning. When you get in touch do let us know:</p>
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
        <input disabled type="submit" name="quick-form" data-id="quick-form" id="submit_results" class="action-button" placeholder="Submit" />
        <input type="hidden" class="token" />
      </form>
    </div>
  </div>
</section>

<?php
function createInputField($props)
{
  $id = $props['id'];
  $label = $props['label'];
  $placeholder = $props['placeholder'];
  $type = $props['type'];
  $tooltip = $props['tooltip'];
  ob_start();
?>
  <div class="input-field">
    <div class="flex gap-1">
      <label class="heading-label"><?= $label; ?></label>
      <?php if (isset($tooltip)) {
        createTooltip($tooltip, $id);
      } ?>
    </div>
    <input type="<?= $type; ?>" name="<?= $id; ?>" id="<?= $id; ?>" placeholder="<?= $placeholder; ?>" />
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
  ob_start();
?>
  <div class="input-field">
    <div class="flex gap-1">
      <label class="heading-label"><?= $label; ?></label>
      <?php if (isset($tooltip)) {
        createTooltip($tooltip, $id);
      } ?>
    </div>
    <textarea name="<?= $id; ?>" id="<?= $id; ?>" placeholder="<?= $placeholder; ?>" rows="8"></textarea>
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
  ob_start();
?>
  <div class="input-field">
    <label class="heading-label"><?= $label; ?></label>
    <div class="grid-4 grid-2-t gap-2">
      <?php foreach ($options as $option) : ?>
        <input type="radio" name="<?= $id; ?>" value="<?= $option; ?>" id="<?= $option; ?>" />
        <label class="action-button" for="<?= $option; ?>">
          <?= $option; ?>
        </label>
      <?php endforeach; ?>
    </div>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>