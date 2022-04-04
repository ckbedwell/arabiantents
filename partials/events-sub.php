<section class="width-contain sectioned">
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
</section>