<section class="contact-sub">
    <div class="width-contain-1000">
        <div class="full no-padding additional-info">
            <!--<ul class="dropdown-menu" role="menu">-->
                <!--<li data-submenu-id="submenu-enquire">-->
                    
                    <!--<span class="targeter maintainHover"><a href="/contact" onclick="return false">Send Enquiry</a></span>-->
                    <!--<div class="point-three-trans popover text-center submenu-enquire"  style="display: block;">-->
                        <!--<h3>What kind of enquiry would you like to make?</h3>-->
                    <div class="fifth-margined no-padding contact-block">
                        <a href="" class="fifth-margined no-padding more-info" value="quick-enquiry">
                            <span class="icon-envelop"></span>
                            Send Enquiry
                        </a>
                    
                        <!--<a href="" class="fifth-margined no-padding more-info" value="event-selection">-->
                        <!--    <span class="icon-glass"></span>-->
                        <!--    Event planning-->
                        <!--</a>-->

                        <!--<a href="" class="fifth-margined no-padding more-info" value="tent-selection">-->
                        <!--    <span class="icon-arabian-tent"></span>-->
                        <!--    Tent Hire Enquiry-->
                        <!--</a>-->

                        <!--<a href="" class="fifth-margined no-padding  more-info" value="venue-dressing-selection">-->
                        <!--    <span class="icon-lamp"></span>-->
                        <!--    Venue Dressing Enquiry-->
                        <!--</a>-->

                        <!--<a href="" class="fifth-margined no-padding more-info" value="furniture-selection">-->
                        <!--    <span class="icon-furniture"></span>-->
                        <!--    Furniture Hire Enquiry-->
                        <!--</a>-->
                    </div>
                <!--</li>-->

                <!--<li data-submenu-id="submenu-contact">-->
                
                    <!--<span class="targeter"><a href="/contact" onclick="return false">Call or Email Us</a></span>-->
                    <!--<div class="point-three-trans popover submenu-contact">-->
                    <div class="fifth-margined no-padding contact-block">
                        <h3>Get in touch</h3>
                        <? if (is_active_sidebar('contact-details')) {
                            dynamic_sidebar('contact-details');
                        } ?>
                    </div>
                <!--</li>-->

                <!--<li data-submenu-id="submenu-find">-->
                    <!--<span class="targeter"><a href="/contact" onclick="return false">Find Us</a></span>-->
                    <!--<div class="point-three-trans popover submenu-find">-->
                    <div class="fifth-margined no-padding contact-block">
                        <h3>Where you will find us</h3>
                        <span class="alignleft full wrapper"><? if (is_active_sidebar('address-details') || is_active_sidebar('address-details')) {
                         dynamic_sidebar('address-details');
                    } ?></span>
                        <a href="/contact/#directions" class="clearleft get-directions">Get Directions</a>
                    </div>
                <!--</li>-->


            <!--</ul>-->
        </div>
    </div>
</section>
