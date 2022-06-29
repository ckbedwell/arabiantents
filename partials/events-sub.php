<?
  $content = "
  <p>We love nothing more than a Memorable Party. We love creating them, decorating them and whenever we can find the time...going to them!</p>
<p>If you are thinking of throwing a party, want it to be unforgettable and fabulous, we are here to help.</p>
<p>We have a wealth of creative knowledge and experience at our finger tips, just waiting for you to tap into.</p>
<p>There are various levels of involvement in our Party Planning services from which to choose, including:</p>
<ul>
<li>Advice on generators, caterers, bar, music, entertainment, photographers and styling</li>
<li>3D CAD design of the tent/ interior featuring all elements to be incorporated in it.</li>
<li>Outsourcing equipment and furniture</li>
<li>Prop sourcing and making</li>
<li>Producing schedules and where necessary risk assessments</li>
<li>Providing an Onsite Coordinator for your event.</li>
</ul>
<p>Contact us with details of what you’re looking for and we will tailor our services to fit.</p>
</div>"
?>

<section class="highlight-section">
  <div class="width-contain">
    <h2 class="section-header">Our additional event management services</h2>
    <div class="row-padding-extra-small">
      <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'page',
          'tax_query' => [
            [
              'taxonomy' => 'page-type',
              'field' => 'slug',
              'terms' => 'additional-service',
            ]
          ]
        ]),
        'ratio' => [1, 1],
      ]); ?>
    </div>
  </div>
  <div class="width-contain-800">
    <?= createTextColumns($content); ?>
  </div>
</section>