<?php
/**
 * Template Name: Contact Page
 *
 * The template for displaying the contact page
 *
 * @package Digital_Taverna
 */

get_header();
?>

<!-- Contact Hero -->
<section class="page-hero contact-hero">
    <div class="pixel-overlay"></div>
    <div class="hero-content">
        <h1 class="pixel-text"><?php the_title(); ?></h1>
        <?php if (function_exists('get_field')) : ?>
            <p><?php echo esc_html(get_field('contact_subtitle')); ?></p>
        <?php else : ?>
            <p>Let's build something great together</p>
        <?php endif; ?>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-intro">
            <?php if (function_exists('get_field')) : ?>
                <h2><?php echo esc_html(get_field('contact_heading')); ?></h2>
                <p><?php echo esc_html(get_field('contact_intro_text')); ?></p>
            <?php else : ?>
                <h2>Ready to Take Your iGaming Brand to the Next Level?</h2>
                <p>Partner with Digital Taverna and let's craft a winning strategy together. Fill out the form below, and one of our digital tavern keepers will get back to you shortly.</p>
            <?php endif; ?>
        </div>
        
        <div class="contact-grid">
            <div class="contact-form-container">
                <?php
                if (function_exists('shortcode_exists') && shortcode_exists('contact-form-7') && function_exists('get_field') && get_field('contact_form_shortcode')) :
                    // If Contact Form 7 is installed and there's a shortcode set
                    echo do_shortcode(get_field('contact_form_shortcode'));
                else :
                    // Custom contact form with AJAX handling
                ?>
                <form id="digitaltaverna-contact-form" class="contact-form pixel-form">
                    <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="company">Company Name</label>
                        <input type="text" id="company" name="company" placeholder="Enter your company name">
                    </div>
                    <div class="form-group">
                        <label for="service">Service of Interest</label>
                        <select id="service" name="service">
                            <option value="">Select a service</option>
                            <option value="crm">CRM: Building Player Loyalty</option>
                            <option value="seo">SEO & SEM: Maximize Your Reach</option>
                            <option value="marketing">Digital Marketing</option>
                            <option value="branding">Branding & Design</option>
                            <option value="ai">AI & Future</option>
                            <option value="multiple">Multiple Services</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Tell us about your project or requirements" required></textarea>
                    </div>
                    <div class="response-message"></div>
                    <button type="submit" class="pixel-btn">Send Message</button>
                </form>
                <?php endif; ?>
            </div>
            
            <div class="contact-info">
                <div class="contact-info-card">
                    <div class="pixel-icon-medium">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-email.png'); ?>" alt="Email">
                    </div>
                    <h3>Email Us</h3>
                    <p><?php echo esc_html(get_theme_mod('contact_email', 'info@digitaltaverna.com')); ?></p>
                </div>
                <div class="contact-info-card">
                    <div class="pixel-icon-medium">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/img/icon-phone.png'); ?>" alt="Phone">
                    </div>
                    <h3>Call Us</h3>
                    <p><?php echo esc_html(get_theme_mod('contact_phone', '+1 (123) 456-7890')); ?></p>
                </div>
                <div class="pixel-character-contact">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/img/tavern-keeper.png'); ?>" alt="Digital Taverna Keeper" class="pixel-character-img-large">
                    <div class="pixel-speech-bubble">
                        <p><?php echo esc_html(get_theme_mod('contact_speech_bubble', 'Ready to welcome you to our digital taverna!')); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FAQ Section -->
        <div class="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">
                <?php
                // Use ACF FAQ repeater if available
                if (function_exists('get_field') && have_rows('faqs')) :
                    while (have_rows('faqs')) : the_row();
                        $faq_question = get_sub_field('faq_question');
                        $faq_answer = get_sub_field('faq_answer');
                        ?>
                        <div class="faq-item">
                            <h3><?php echo esc_html($faq_question); ?></h3>
                            <p><?php echo esc_html($faq_answer); ?></p>
                        </div>
                        <?php
                    endwhile;
                else : // Fallback FAQs
                ?>
                    <div class="faq-item">
                        <h3>What industries do you specialize in?</h3>
                        <p>We specialize in the iGaming sector, providing marketing, branding, and support services tailored specifically for gaming operators.</p>
                    </div>
                    <div class="faq-item">
                        <h3>How quickly can you start working on our project?</h3>
                        <p>Typically, we can begin work within 1-2 weeks of finalizing project details and completing the onboarding process.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Do you offer custom packages?</h3>
                        <p>Absolutely! We create tailored solutions based on your specific business goals and requirements.</p>
                    </div>
                    <div class="faq-item">
                        <h3>How do you measure success?</h3>
                        <p>We establish clear KPIs at the start of each project and provide regular reporting to track progress and ROI.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php if (!function_exists('shortcode_exists') || !shortcode_exists('contact-form-7')) : ?>
<script>
jQuery(document).ready(function($) {
    $('#digitaltaverna-contact-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $button = $form.find('button[type="submit"]');
        var $message = $form.find('.response-message');
        
        // Disable the submit button and show loading state
        $button.prop('disabled', true).text('Sending...');
        $message.html('').removeClass('error success');
        
        // Collect form data
        var formData = {
            action: 'digitaltaverna_process_contact_form',
            contact_nonce: $form.find('#contact_nonce').val(),
            name: $form.find('#name').val(),
            email: $form.find('#email').val(),
            company: $form.find('#company').val(),
            service: $form.find('#service').val(),
            message: $form.find('#message').val()
        };
        
        // Submit the form data
        $.ajax({
            type: 'POST',
            url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $message.html('<p>' + response.data + '</p>').addClass('success');
                    $form[0].reset();
                } else {
                    $message.html('<p>' + (response.data || 'An error occurred. Please try again.') + '</p>').addClass('error');
                }
            },
            error: function() {
                $message.html('<p>An error occurred. Please try again later.</p>').addClass('error');
            },
            complete: function() {
                $button.prop('disabled', false).text('Send Message');
            }
        });
    });
});
</script>

<style>
.response-message {
    margin: 15px 0;
    padding: 10px;
    border-radius: 4px;
}

.response-message.success {
    background-color: rgba(40, 167, 69, 0.2);
    border: 1px solid #28a745;
    color: #fff;
}

.response-message.error {
    background-color: rgba(220, 53, 69, 0.2);
    border: 1px solid #dc3545;
    color: #fff;
}
</style>
<?php endif; ?>

<?php
get_footer();
