<style>

    .more-information h2 {
        margin-bottom: 4rem;
    }

    .christmas-steps {
        display: flex;
        flex-wrap: wrap;
    }

    @supports (display: grid) {
        .christmas-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 3rem;
        }
    }

    .christmas-steps  > * {
        flex-basis: 33.33333%;
        min-width: 0; /* https://stackoverflow.com/questions/43311943/prevent-content-from-expanding-grid-items */
        padding: 4rem;
        border: 1px solid lightgrey;
        background-color: #fffdf7;
    }
    
    @media screen and (max-width: 1024px) {
        @supports (display: grid) {
            .christmas-steps {
                grid-template-columns: 1fr;
            }
        }

        .christmas-steps  > * {
            flex-basis: 100%;
            margin-bottom: 4rem;
        }
    }
</style>

<section class="parent-contain row-padding text-center quick-navigation">
    <div class="width-contain more-information">
        <h2>So what’s the next step?</h2>
        <div class="center-items christmas-steps">
            <div>
                <h3>1.Details of your venue</h3>
                <p>First send us the details of your venue – length, width and height for the venue along with a couple of photos. If there are anything else you think we should know, do tell us.</p>
            </div>

            <div>
                <h3>2. Share your vision</h3>
                <p>Share your vision with us – the inspiration behind your theme or what you want to create – or better still tell us with pictures! Take a look at our <a href="https://www.pinterest.co.uk/kathhudson" target="_blank">Pinterest Boards</a> for some inspiration.</p>
            </div>

            <div>
                <h3>3. Tell us your budget</h3>
                <p>Tell us your budget – we work anywhere between £1,500 – £20,000 so a budget helps to guide our ideas. We will provide via email what we are able to supply with pictures and costings.</p>
            </div>
        </div>
        <a href="/contact" class="enquire-button more-info no-margin-bottom" value="quick-enquiry">Tell us about your event</a>
    </div>
</section>
