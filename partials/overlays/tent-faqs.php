<!--------- TENT FAQS OVERLAY ----->
<div class="overlay"></div>
<div class="overview-info-overlay width-contain hide tent-faqs">
  <a class="icon-cross close" title="Close Information Box"><span>Close</span></a>
  <div class="questions-and-answers">
    <div class="overview-info-questions__questions">
      <h3 class="text-center">Frequently Asked Questions</h3>
      <ul>
        <li class="active">
          <button data-value="answer0">What is the maxium capacity of the tent?</button>
        </li>
        <li>
          <button data-value="answer1">What spacing requirements should I consider?</button>
        </li>
        <li>
          <button data-value="answer2">How long does it take to set up?</button>
        </li>
        <li>
          <button data-value="answer3">Are the tents waterproof?</button>
        </li>
        <li>
          <button data-value="answer4">Will the tents be warm enough?</button>
        </li>
        <li>
          <button data-value="answer5">When would you take them down?</button>
        </li>
        <li>
          <button data-value="answer6">Do you need a power supply?</button>
        </li>
        <li>
          <button data-value="answer7">How much will it cost?</button>
        </li>
      </ul>
    </div>
    <div class="overview-info-overlay__answers">
      <div class="answer" id="answer0">
        <h4>What is the maximum capacity for the <? the_title(); ?> tent?</h4>
        <h5><span class="branding-color">Answer:</span> <?= get_post_meta(get_the_ID(), 'max-capacity', true); ?> people</h5>
        <p>Depending on how many guests you have, whether you are dining, and if you want a dance floor and other seating and chillout areas, will determine what size of tent you will require.</p>
        <p>This table provides a good reference to work out what kind of space you will need. If you are having an even bigger party than our maximum capacity, we suggest putting more tents together!</p>

        <div class="max-capacity-info">
          <? include(locate_template('/partials/overlays/max-capacity.php')); ?>
        </div>
      </div>

      <div class="answer" id="answer1">
        <h4>What spacing requirements should I consider?</h4>
        <h5><span class="branding-color">Answer:</span> The minimum space you will need is <?= get_post_meta(get_the_ID(), 'min-size', true); ?> for the <? the_title(); ?></h5>
        <p>This area takes into account the tent itself as well as the guide ropes, which need 2 metres around every side to ensure it is set up safely. Use the chart above to work out exactly how much space you will need.</p>
        <p>Being frame structures our tents can be erected on hard standings such as tennis courts, concrete car parks and gravel drives and this requires eye bolts to be drilled into the floor. Because of their construction, they require the area where they are being erected to be level. Scaffolding can be put in place to level areas that have too much of a slope to them. However, if the ground is slightly uneven then a hard-flooring upgrade can be used to level out the floor within the tent.</p>
      </div>

      <div class="answer" id="answer2">
        <h4>How long does it take to set up?</h4>
        <h5><span class="branding-color">Answer:</span> The <? the_title(); ?> takes <?= get_post_meta(get_the_ID(), 'build-time', true); ?> to set up</h5>
        <p>Our tents vary in size, some of our smaller tents can be set up in a few hours, whilst our largest tents can take several days. The build would ideally begin on Monday or Tuesday to ensure everything is ready for a Saturday event.</p>
        <p>To give you an idea of the build and what to expect at your party, here's a time-lapse of one of previous events.</p>

        <div class="responsive-video">
          <div id="player"></div>
          <iframe id="video1" src="//www.youtube.com/embed/b1--nJuvaY0?rel=0&amp;showinfo=0?enablejsapi=1&html5=1" allowfullscreen></iframe>
        </div>
      </div>

      <div class="answer" id="answer3">
        <h4>Are the tents waterproof?</h4>
        <h5><span class="branding-color">Answer:</span> Yes, they are waterproof</h5>
        <p>The exteriors are made from high quality cotton canvas which is regularly waterproofed throughout the season. It is important when positioned on windy sites to put in additional supporting poles inside the tent to support the pyramid ceiling, to ensure they can endure winds of up to 30 mph.</p>
      </div>

      <div class="answer" id="answer4">
        <h4>Will the tents be warm enough?</h4>
        <h5><span class="branding-color">Answer:</span> Yes, they are easily heated</h5>
        <p>Our tents can be easily heated on cool days as their vented elevated ceilings and canvas exteriors are geared towards providing shade on a hot day rather than warmth on a cool one.</p>
      </div>

      <div class="answer" id="answer5">
        <h4>When would you take them down?</h4>
        <h5><span class="branding-color">Answer:</span> The following day</h5>
        <p>We would come and take them down the following day (usually a Sunday).</p>
      </div>

      <div class="answer" id="answer6">
        <h4>Do you need a power supply?</h4>
        <h5><span class="branding-color">Answer:</span> Yes</h5>
        <p>We will always require power. Most lighting can run from a 13-amp domestic supply or a generator. Our cabling is weatherproof.</p>
      </div>

      <div class="answer" id="answer7">
        <h4>How much will it cost?</h4>
        <h5><span class="branding-color">Answer:</span> Varies (See examples)</h5>
        <p>Every single party and event is unique, however, we have given a few examples below to give you an idea of how much it might cost.</p>

        <?
        $args = array(
          'post' => 'layout',
          'orderby' => 'meta_value_num',
          'meta_key' => 'example-price',
          'order' => 'ASC',
          'tax_query' => array(
            array(
              'taxonomy' => 'example_layout',
              'field' => 'slug',
              'terms' => 'price-example'
            )
          )
        );
        $examples = new WP_Query($args);
        while ($examples->have_posts()) : ?>
          <?
          $examples->the_post();
          $postID = get_the_ID();
          $featuredImage = get_the_featured_image($postID);

          $title = get_post_meta($post->ID, 'example-title', true);
          $price = get_post_meta($post->ID, 'example-price', true);
          $maxCapacity = get_post_meta($post->ID, 'max-capacity', true);
          $maxDining = get_post_meta($post->ID, 'max-dining-capacity', true);
          ?>
          <div class="">
            <div class="">
              <img src="<?= $featuredImage['full_url']; ?>" class="point-five-trans">
            </div>
            <div class="">
              <h3><?= $title; ?></h3>
              <? if ($price) : ?>
                <h6><span class="branding-color">Price:</span> £<?= number_format($price); ?> <span class="small-font">plus delivery &amp; VAT</span></h6>
              <? endif; ?>
              <? if ($maxCapacity || $maxDining) : ?>
                <ul class="">
                  <? if ($maxCapacity) : ?><li>Max capacity: <?= $maxCapacity; ?></li><? endif; ?>
                  <? if ($maxDining) : ?><li>Dining capacity: <?= $maxDining;  ?></li><? endif; ?>
                </ul>
              <? endif; ?>
            </div>
            <div class="">
              <? the_content(); ?>
            </div>
          </div>
        <? endwhile; ?>
      </div>
    </div>
  </div>
</div>

<script>
  jQuery(document).ready(($) => {
    var answersPositions
    var active = 0

    jQuery('[data-value]').click(function() {
      open_overlay()
      var answers = jQuery('.answer');

      if (!answersPositions) {
        answersPositions = answers.map(function() {
          return jQuery(this).outerHeight();
        });
      }

      var value = jQuery(this).attr('data-value');
      var target = jQuery('#' + value).position().top;

      jQuery('.overview-info-overlay__answers').stop().animate({
        scrollTop: jQuery('.overview-info-overlay__answers').scrollTop() + target
      }, 500);
    });

    jQuery('.overview-info-overlay__answers').scroll(function() {
      var currentScroll = jQuery(this).scrollTop();
      var current = 0
      var runningTotal = 0

      for (let i = 0; i < answersPositions.length; i++) {
        runningTotal += answersPositions[i]

        if (currentScroll < runningTotal) {
          current = i

          if (active !== current) {
            active = current
            jQuery('.overview-info-questions__questions .active').removeClass('active');
            jQuery('.overview-info-questions__questions button[data-value="answer' + current + '"]').parent().addClass('active');
          }
          break
        }
      }
    });

    jQuery('.tent-faqs .close').click(function() {
      close_overlays()
    });

    jQuery(document).keydown(function (e) {
      // ESCAPE key pressed
      if (e.keyCode == 27) {
        close_overlays()
      }
    });
  })

function open_overlay() {
  jQuery("html").addClass("active-overlay");
  jQuery(".tent-faqs").removeClass("hide").addClass("active");
}

function close_overlays() {
  jQuery("html").removeClass("active-overlay");
  jQuery('.tent-faqs').removeClass("active").addClass("hide");
}
</script>