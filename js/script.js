/**
 * Digital Taverna - Main JavaScript File
 * Handles mobile menu toggling and other interactive elements
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Mobile menu toggle functionality
        const menuToggle = $('.menu-toggle');
        const navLinks = $('.nav-links');
        
        menuToggle.on('click', function() {
            navLinks.toggleClass('active');
            
            // Animate the hamburger icon
            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
                $(this).find('span:nth-child(1)').css('transform', 'rotate(45deg) translate(5px, 5px)');
                $(this).find('span:nth-child(2)').css('opacity', '0');
                $(this).find('span:nth-child(3)').css('transform', 'rotate(-45deg) translate(5px, -5px)');
            } else {
                $(this).find('span').css({
                    'transform': 'none',
                    'opacity': '1'
                });
            }
        });
        
        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!menuToggle.is(e.target) && !menuToggle.has(e.target).length && 
                !navLinks.is(e.target) && !navLinks.has(e.target).length) {
                navLinks.removeClass('active');
                menuToggle.removeClass('active');
                menuToggle.find('span').css({
                    'transform': 'none',
                    'opacity': '1'
                });
            }
        });
        
        // Add scroll event for header styling
        const header = $('header');
        
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });
        
        // Set smooth scrolling for anchor links
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Handle anchor links with offset for fixed header
        function scrollToElementWithOffset(elementId) {
            const element = document.getElementById(elementId);
            if (!element) return;
            
            const headerHeight = document.querySelector('header').offsetHeight;
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerHeight - 100;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
        
        // Manage navigation for internal/external anchor links
        function handleNavigation(href) {
            if (href.includes('.html')) {
                // This is for backward compatibility with original HTML site
                // Convert .html links to WordPress permalinks
                let wpLink = href.replace('.html', '');
                
                // Handle section anchors
                const [page, section] = wpLink.split('#');
                
                if (section) {
                    if (window.location.pathname.includes(page) || page === 'index') {
                        // We're on the same page, just scroll to section
                        scrollToElementWithOffset(section);
                        return;
                    } else {
                        // Store section to scroll to after page load
                        sessionStorage.setItem('scrollToSection', section);
                    }
                }
                
                // Handle index.html specially
                if (wpLink.startsWith('index')) {
                    wpLink = '/';
                }
                
                window.location.href = wpLink;
            } else if (href.startsWith('#')) {
                // Internal page anchor
                const targetId = href.substring(1);
                scrollToElementWithOffset(targetId);
            }
        }
        
        // Add click event to anchor links
        $('a[href^="#"], a[href*=".html#"]').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            handleNavigation(href);
        });
        
        // Check if we need to scroll to a section on page load
        const sectionToScroll = sessionStorage.getItem('scrollToSection');
        if (sectionToScroll) {
            // Short delay to ensure DOM is fully loaded
            setTimeout(() => {
                scrollToElementWithOffset(sectionToScroll);
                sessionStorage.removeItem('scrollToSection');
            }, 500);
        }
        
        // Form submission handling for Contact Form
        $('#digitaltaverna-contact-form').on('submit', function(e) {
            if ($(this).length === 0) return; // Form doesn't exist
            
            e.preventDefault();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $responseMessage = $form.find('.response-message');
            
            // Validate form
            var isValid = true;
            $form.find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });
            
            if (!isValid) {
                $responseMessage.html('<p>Please fill in all required fields.</p>').addClass('error').show();
                return;
            }
            
            // Disable button during submission
            $button.prop('disabled', true).text('Sending...');
            $responseMessage.html('').removeClass('error success').hide();
            
            // Add coin animation
            const coinElements = $('.coin');
            coinElements.each(function() {
                $(this).css('animation', 'coin-spin 2s infinite linear');
            });
            
            // Prepare data for AJAX submission
            var formData = {
                action: 'digitaltaverna_process_contact_form',
                contact_nonce: $form.find('#contact_nonce').val(),
                name: $form.find('#name').val(),
                email: $form.find('#email').val(),
                company: $form.find('#company').val(),
                service: $form.find('#service').val(),
                message: $form.find('#message').val()
            };
            
            // Submit the form
            $.ajax({
                type: 'POST',
                url: ajax_object ? ajax_object.ajax_url : '/wp-admin/admin-ajax.php',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $responseMessage.html('<p>' + response.data + '</p>').addClass('success').show();
                        $form[0].reset();
                        
                        // Show success animation
                        setTimeout(function() {
                            const successMessage = $('<div class="form-success"><p>Message sent successfully! We\'ll get back to you soon.</p></div>');
                            $form.fadeOut(500, function() {
                                $form.replaceWith(successMessage);
                                successMessage.hide().fadeIn(500);
                            });
                        }, 1000);
                    } else {
                        $responseMessage.html('<p>' + (response.data || 'There was an error sending your message. Please try again.') + '</p>').addClass('error').show();
                        $button.prop('disabled', false).text('Send Message');
                    }
                },
                error: function() {
                    $responseMessage.html('<p>An error occurred. Please try again later.</p>').addClass('error').show();
                    $button.prop('disabled', false).text('Send Message');
                }
            });
        });
        
        // Handle form input styling
        $('.contact-form input, .contact-form textarea, .contact-form select').on('focus', function() {
            $(this).parent().addClass('focused');
        }).on('blur', function() {
            if (!$(this).val()) {
                $(this).parent().removeClass('focused');
            }
        });
        
        // Initialize any inputs that already have values
        $('.contact-form input, .contact-form textarea, .contact-form select').each(function() {
            if ($(this).val()) {
                $(this).parent().addClass('focused');
            }
        });
    });
})(jQuery);
