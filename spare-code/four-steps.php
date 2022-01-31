<div class="scrollto-padding" id="scrollto-enquire"></div>
            <section class="parent-contain no-padding drop-off">
                <div class="full quote-bar text-center point-four-trans sticky">
                    <div class="width-contain">
                        <a class="quarter step-one-track active" href="#scrollto-step-one">
                            <span class="icon-number1"></span>
                            <strong>How many guests</strong>
                        </a>

                        <a class="quarter step-two-track" href="#scrollto-step-two">
                            <span class="icon-number2"></span>
                            <strong>Choose Tents</strong>
                        </a>

                        <a class="quarter step-three-track" href="#scrollto-step-three">
                            <span class="icon-number3"></span>
                            <strong>Choose Layout</strong>
                        </a>

                        <a class="quarter step-four-track" href="#scrollto-step-four">
                            <span class="icon-number4"></span>
                            <strong>Get Quote</strong>
                        </a>

                    </div>
                </div>

                <div class="parent-contain row-padding-small form-intro" data-bg="<? if(!empty($CTAimages)) { foreach ($CTAimages as $image) { echo $image['full_url']; } } ?>">
                    <div class="width-contain">
                        <div class="three-fifths">
                            <h2><?= get_post_meta(get_the_ID(), 'form-header', true); ?></h2>
                            <h3>Tell us your <?= $desc; ?> plans</h3>
                            <p>To make your <?= $desc; ?> the best it can possibly be, we want you to tell us exactly what you want. We've created a simple four-step form, <strong>which takes no longer than two minutes to fill out</strong>, where you can give us an exact idea of what you want at your <?= $desc; ?>.</p>
                            <a href="#scrollto-step-one" class="clearleft enquire-button next-step clickable fade-move-left">Let's get started</a>
                        </div>
                    </div>
                </div>

                <form action="/thank-you" method="post" onsubmit="return validateEvent()">
                    <div class="parent-contain scrollto-padding step-one" id="scrollto-step-one">
                        <div class="width-contain step-one-track active">
                            <div class="moving-progress-arrow"></div>
                            <div class="third">
                                <div class="fifth no-padding">
                                    <div class="vertical-progress-bar point-eight-trans"></div>
                                    <span class="icon-number1"></span>
                                </div>
                                <div class="four-fifths">
                                    <h3>How many guests are you planning for?</h3>
                                    <p>Tell us how many guests you are expecting at your <?= $desc; ?>. If you are having a formal dinner don't forget to tell us how many guests will be eating!</p>
                                    <a href="#scrollto-step-two" class="alignleft enquire-button next-step clickable fade-move-left">Great! Let's look at tents.</a>
                                </div>
                            </div>
                            <div class="two-thirds text-center">
                                <div class="half iconwrapper point-five-trans total-guests">
                                    <span class="icon-man-woman"></span>
                                    <label>Total amount of guests</label>
                                    <input type="number" min="0" name="field_total_guests" class="text-center" id="field_total_guests">
                                </div>

                                <div class="half alignright iconwrapper point-five-trans dining-guests">
                                    <span class="icon-fork-knife"></span>
                                    <label>How many of these are dining?</label>
                                    <input type="number" min="0" value="0" name="field_dining_guests" class="text-center" id="field_dining_guests">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="parent-contain row-padding-small step-two" id="scrollto-step-two">
                        <div class="width-contain step-two-track">
                            <div class="moving-progress-arrow"></div>
                            <div class="third">
                                <div class="fifth no-padding">
                                    <div class="vertical-progress-bar point-eight-trans"></div>
                                    <span class="icon-number2"></span>
                                </div>
                                <div class="four-fifths">
                                    <h3>Which tent or tents do you like the look of?</h3>
                                    <p>Usually you'll only need one tent, but if you are planning something really extravagant (or haven't made your mind up yet), pick as many as you like and we can work out which is best suited for you later on.</p>


                                    <div class="alignleft full tip-box row-padding-extra-small">
                                        <a class="icon-cross close" title="Close Tip Box"></a>
                                        <h4 class="branding-color text-center">Tip</h4>
                                        <div class="quarter no-padding text-center"><span class="icon-search"></span></div>
                                        <div class="three-quarters no-padding">
                                            <p class="no-margin">Click on these icons to see more details about each tent.</p>
                                        </div>
                                    </div>
                                    <a href="#scrollto-step-three" class="alignleft enquire-button next-step clickable fade-move-left">Fantastic! Let's see layouts.</a>
                                </div>
                            </div>

                            <div class="two-thirds">
                               <?
                                $tent_types = get_post_meta(get_the_ID(), 'type-of-tents', false);
                                $tent_types = explode(',', $tent_types[0]);

                                foreach($tent_types as $tent_type) {
                                    $tent_type = get_term($tent_type);
                                    $title = $tent_type->name;
                                    $lower = strtolower($title);
                                    $friendlyTitle = str_replace(" ", "-", $lower);
                                    $description = $tent_type->description;
                                    echo '<div class="alignleft full row-padding-extra-small"><h2 class="alignleft">' . $title . '<button type="button" class="more-info icon-plus-circle" value="' . $friendlyTitle . '-info"></button></h2>';

                                    $tent_type = $tent_type->slug;
                                    $args = array(
                                        'post_type' => 'tent',
                                        'tent_type' => $tent_type,
                                       );

                                    $query = new WP_Query($args);
                                    if (have_posts())  : ?>
                                        <? while ($query->have_posts()) : $query->the_post(); ?>
                                                <?
                                                    $postID = get_the_ID();
                                                    $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
                                                    $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
                                                    $imgURL = $featuredImage[0]; //get the url of the image out of the array
                                                    $lower = strtolower(get_the_title());
                                                    $friendlyTitle = str_replace(" ", "-", $lower);
                                                    $terms = get_the_terms($post->ID , 'tent_type');
                                                    foreach($terms as $term) {
                                                        $termName = $term->name;
                                                        $termName = strtolower($termName);
                                                        $termName = str_replace(" ", "-", $termName);
                                                        unset($term);
                                                        }

                                                ?>
                                                <div class="third" id="post-<? the_ID(); ?>">
                                                    <input type="checkbox" name="field_tents[]" value="<? the_title(); ?>" id="<?= $friendlyTitle; ?>" tent="<?= $termName; ?>">
                                                    <label for="<?= $friendlyTitle; ?>" class="display-card featured-image" data-bg="<?= $imgURL; ?>">
                                                        <div class="overlay-information">
                                                            <h3><? the_title(); ?></h3>
                                                        </div>
                                                        <a class="iframe-loader view-more-link" href="<? the_permalink(); ?>" title="View <? the_title(); ?>"></a>
                                                    </label>

                                                </div>
                                                <? endwhile; ?>
                                                <? wp_reset_postdata(); endif; echo '</div>'; } ?>
                            </div>
                        </div>
                    </div>

                    <div class="parent-contain row-padding-small step-three" id="scrollto-step-three">
                        <div class="width-contain step-three-track">
                            <div class="moving-progress-arrow"></div>
                            <div class="third">
                                <div class="fifth no-padding">
                                    <div class="vertical-progress-bar point-eight-trans"></div>
                                    <span class="icon-number3"></span>
                                </div>
                                <div class="four-fifths">
                                    <h3>Which layouts do you like?</h3>
                                    <p>Based on what you have chosen above, these are the best layouts we have found for you. Pick which one you like best (or as many as you like if you can't decide!).</p>

                                    <div class="full tip-box row-padding-extra-small hide fade-move-left">
                                        <a class="icon-cross close" title="Close Note Box"></a>
                                        <h4>Note</h4>
                                        <p>As you have chosen tents from pole tents and framed tents, you need to choose a layout for each of them. If this is too much choice, just <a href="#scrollto-step-two">go back to step two</a> and deselect all the tents from one of the categories.</p>
                                    </div>

                                    <a href="#scrollto-step-four" class="alignleft enquire-button next-step clickable fade-move-left">Almost done! Last few details.</a>
                                </div>
                            </div>
                            <div class="two-thirds">
                                <div class="alignleft full tent-layouts pole-layouts">
                                    <h2>Pole Tent Layouts</h2>
                                    <p class="your-choice">Your selection: <span class="selected branding-color"></span></p>
                                    <div class="results">

                                    </div>
                                </div>

                                <div class="alignleft full tent-layouts framed-layouts">
                                    <h2>Framed Tent Layouts</h2>
                                    <p class="your-choice">Your selection: <span class="selected branding-color"></span></p>
                                    <div class="results">
                                    </div>
                                </div>

                                <div class="alignleft full hide stretch-layouts">
                                    <h2>Stretch Tent Layouts</h2>
                                    <div class="results">
                                        <p>We don't have any set layouts for stretch tents, and will look to utilise whatever space there is available when setting up your stretch tent.</p>
                                    </div>
                                </div>

                                <div class="full loading-placeholder">
                                    <div class="full vertical-align">
                                        <img class="aligncenter" src="/wp-content/themes/arabiantents/images/arabian-tents-logo.png">
                                        <p class="max-width-600 aligncenter">Give us some details above and we'll find the best layouts for your event.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="parent-contain row-padding-small step-four" id="scrollto-step-four">
                        <div class="width-contain step-four-track">
                            <div class="third">
                                <div class="fifth no-padding">
                                    <span class="icon-number4"></span>
                                </div>
                                <div class="four-fifths">
                                    <h3>Last few details</h3>
                                    <p>Now just fill in the last few details. If there's anything else, just add a message and let us know.</p>
                                    <p class="alignleft black-button next-step fade-move-left">That's it! Just hit submit below and we'll get back to you within 24 hours!</p>
                                </div>
                            </div>
                            <div class="two-thirds">
                                <div class="full date-field">
                                    <div class="sixth text-center">
                                        <span class="icon-calendar"></span>
                                    </div>
                                    <div class="five-sixths hidden-fields">
                                        <label class="heading-label">Do you have a date?</label>
                                        <input type="checkbox" value="Exact Date" name="date[]" id="date_yes" class="show_option">
                                        <label for="date_yes" class="input-button clickable">Yes</label>

                                        <input type="checkbox" value="Rough date" name="date[]" id="date_roughly" class="show_option">
                                        <label for="date_roughly" class="input-button clickable">Roughly</label>

                                        <input type="checkbox" value="No date yet" name="date[]" id="date_no">
                                        <label for="date_no" class="input-button clickable">Not yet</label>

                                        <input type="text" name="field_date" id="field_date" class="option-box hide fade-move-left" placeholder="When?">
                                    </div>
                                </div>

                                <div class="full name-field">
                                    <div class="sixth text-center">
                                        <span class="icon-vcard"></span>
                                    </div>
                                    <div class="five-sixths">
                                        <label class="heading-label">Your name:</label>
                                        <input type="text" name="field_name" id="field_name" placeholder="Name" />
                                    </div>
                                </div>

                                <div class="full email-field">
                                    <div class="sixth text-center">
                                        <span class="icon-at-sign"></span>
                                    </div>
                                    <div class="five-sixths">
                                        <label class="heading-label">Your email:</label>
                                        <input type="email" name="field_email" id="field_email" placeholder="Email" />
                                    </div>
                                </div>

                                <div class="full message-field">
                                    <div class="sixth text-center">
                                        <span class="icon-envelop"></span>
                                    </div>
                                    <div class="five-sixths hidden-fields">
                                        <div class="full ">
                                            <label class="heading-label">Would you like to add a message?</label>
                                            <input type="radio" name="message-option" id="message_yes" class="show_option">
                                            <label for="message_yes" class="input-button clickable">Yes</label>

                                            <input type="radio" name="message-option" id="message_no" checked="checked">
                                            <label for="message_no" class="input-button clickable">No</label>
                                        </div>

                                        <textarea name="option_box" id="field_message" class="full option-box fade-in move-left hide" rows="8" placeholder="Your message"></textarea>
                                    </div>
                                </div>

                                <div class="full">
                                    <div class="five-sixths alignright">
                                        <input type="submit" name="event-form" id="submit_results" class="enquire-button" placeholder="Submit"/>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                </form>
            </section>
