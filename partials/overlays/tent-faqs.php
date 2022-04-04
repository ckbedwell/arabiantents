<!--------- TENT FAQS OVERLAY ----->

<div class="overview-info-overlay width-contain hide tent-faqs">
  <a class="icon-cross close" title="Close Information Box"><span>Close</span></a>
  <div class="questions-and-answers">
    <div class="overview-info-questions__questions">
      <h3 class="text-center">Frequently Asked Questions</h3>
      <ul>
        <li class="active">
          <a href="#answer1">What is the maxium capacity of the tent?</a>
        </li>
        <li>
          <a href="#answer2">What spacing requirements should I consider?</a>
        </li>
        <li>
          <a href="#answer3">How long does it take to set up?</a>
        </li>
        <li>
          <a href="#answer4">Are the tents waterproof?</a>
        </li>
        <li>
          <a href="#answer5">Will the tents be warm enough?</a>
        </li>
        <li>
          <a href="#answer6">When would you take them down?</a>
        </li>
        <li>
          <a href="#answer7">Do you need a power supply?</a>
        </li>
        <li>
          <a href="#answer8">How much will it cost?</a>
        </li>
      </ul>
    </div>
    <div class="overview-info-overlay__answers">
      <div class="answer" id="answer1">
        <h4>What is the maximum capacity for the <? the_title(); ?> tent?</h4>
        <h5><span class="branding-color">Answer:</span> <?= get_post_meta(get_the_ID(), 'max-capacity', true); ?> people</h5>
        <p>Depending on how many guests you have, whether you are dining, and if you want a dance floor and other seating and chillout areas, will determine what size of tent you will require.</p>
        <p>This table provides a good reference to work out what kind of space you will need. If you are having an even bigger party than our maximum capacity, we suggest putting more tents together!</p>

        <div class="max-capacity-info">
          <? include(locate_template('/partials/overlays/max-capacity.php')); ?>
        </div>
      </div>

      <div class="answer" id="answer2">
        <h4>What spacing requirements should I consider?</h4>
        <h5><span class="branding-color">Answer:</span> The minimum space you will need is <?= get_post_meta(get_the_ID(), 'min-size', true); ?> for the <? the_title(); ?></h5>
        <p>This area takes into account the tent itself as well as the guide ropes, which need 2 metres around every side to ensure it is set up safely. Use the chart above to work out exactly how much space you will need.</p>
        <p>Being frame structures our tents can be erected on hard standings such as tennis courts, concrete car parks and gravel drives and this requires eye bolts to be drilled into the floor. Because of their construction, they require the area where they are being erected to be level. Scaffolding can be put in place to level areas that have too much of a slope to them. However, if the ground is slightly uneven then a hard-flooring upgrade can be used to level out the floor within the tent.</p>
      </div>

      <div class="answer" id="answer3">
        <h4>How long does it take to set up?</h4>
        <h5><span class="branding-color">Answer:</span> The <? the_title(); ?> takes <?= get_post_meta(get_the_ID(), 'build-time', true); ?> to set up</h5>
        <p>Our tents vary in size, some of our smaller tents can be set up in a few hours, whilst our largest tents can take several days. The build would ideally begin on Monday or Tuesday to ensure everything is ready for a Saturday event.</p>
        <p>To give you an idea of the build and what to expect at your party, here's a time-lapse of one of previous events.</p>

        <div class="responsive-video">
          <div id="player"></div>
          <iframe id="video1" src="//www.youtube.com/embed/b1--nJuvaY0?rel=0&amp;showinfo=0?enablejsapi=1&html5=1" allowfullscreen></iframe>
        </div>
      </div>

      <div class="answer" id="answer4">
        <h4>Are the tents waterproof?</h4>
        <h5><span class="branding-color">Answer:</span> Yes, they are waterproof</h5>
        <p>The exteriors are made from high quality cotton canvas which is regularly waterproofed throughout the season. It is important when positioned on windy sites to put in additional supporting poles inside the tent to support the pyramid ceiling, to ensure they can endure winds of up to 30 mph.</p>
      </div>

      <div class="answer" id="answer5">
        <h4>Will the tents be warm enough?</h4>
        <h5><span class="branding-color">Answer:</span> Yes, they are easily heated</h5>
        <p>Our tents can be easily heated on cool days as their vented elevated ceilings and canvas exteriors are geared towards providing shade on a hot day rather than warmth on a cool one.</p>
      </div>

      <div class="answer" id="answer6">
        <h4>When would you take them down?</h4>
        <h5><span class="branding-color">Answer:</span> The following day</h5>
        <p>We would come and take them down the following day (usually a Sunday).</p>
      </div>

      <div class="answer" id="answer7">
        <h4>Do you need a power supply?</h4>
        <h5><span class="branding-color">Answer:</span> Yes</h5>
        <p>We will always require power. Most lighting can run from a 13-amp domestic supply or a generator. Our cabling is weatherproof.</p>
      </div>

      <div class="answer" id="answer8">
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
              <img data-src="<?= $featuredImage['full_url']; ?>" class="point-five-trans">
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
    jQuery('.overview-info-questions__questions a').click(function() {
      var value = jQuery(this).attr('href');
      var target = jQuery(value).position().top;
      jQuery('.overview-info-overlay__answers').stop().animate({
        scrollTop: target
      }, 500);
      return false;
    });

    var answers = jQuery('.answer');

    jQuery('.overview-info-overlay__answers').scroll(function() {
      var currentScroll = jQuery(this).scrollTop();

      answers.each(function() {
        var divPosition = jQuery(this).position().top - 150;
        var currentAnswer = jQuery(this);

        if (divPosition < currentScroll) {
          var id = currentAnswer.attr('id');
          jQuery('.overview-info-questions__questions a').parent().removeClass('active');
          jQuery(".overview-info-questions__questions [href='#" + id + "']").parent().addClass('active');
        }
      });
    });

    jQuery('[scrollto]').click(function() {
      jQuery('.tent-faqs [data-src]').each(function() {
        var dataLink = jQuery(this).attr('data-src');
        jQuery(this).attr('src', dataLink);
      });

      var scrollto = jQuery(this).attr('scrollto');
      var scrollto = 'a[href="#' + scrollto + '"]';
      setTimeout(function() {
        jQuery(scrollto).click();
      }, 500);
    });
  })
</script>