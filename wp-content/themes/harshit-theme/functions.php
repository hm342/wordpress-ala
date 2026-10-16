<?php
/**
 * Harshit Fresh Grocery Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Enqueue Google Font 'Inter' and Stylesheets
add_action('wp_enqueue_scripts', 'harshit_grocery_enqueue_styles', 99);
function harshit_grocery_enqueue_styles() {
    wp_enqueue_style(
        'harshit-grocery-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_style('storefront-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('harshit-grocery-style', get_stylesheet_uri(), array('storefront-style', 'harshit-grocery-fonts'), '1.3.0');
}

// 2. Favicon in Header
add_action('wp_head', 'harshit_grocery_add_favicon');
function harshit_grocery_add_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/assets/favicon.png';
    echo '<link rel="shortcut icon" href="' . esc_url($favicon_url) . '" type="image/png" />' . "\n";
    echo '<link rel="icon" href="' . esc_url($favicon_url) . '" type="image/png" />' . "\n";
}

// 3. Remove default Storefront breadcrumbs and duplicate WooCommerce shop titles
add_action('init', 'harshit_grocery_adjust_storefront_hooks');
function harshit_grocery_adjust_storefront_hooks() {
    // Remove default breadcrumbs
    remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
    
    // Suppress default WooCommerce duplicate page title on shop and archives
    add_filter('woocommerce_show_page_title', '__return_false');

    // Remove Storefront default out-of-place sale flash in loop
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
    // Add sale flash cleanly before loop item title so it is absolutely positioned over the image
    add_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);

    // Remove duplicate default page headers so the green hero banner is the single authoritative header
    remove_action('storefront_page', 'storefront_page_header', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

    // Replace footer credit
    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_footer', 'harshit_grocery_custom_footer', 20);
}

// 4. Clean Top Utility Bar
add_action('storefront_before_header', 'harshit_grocery_utility_bar');
function harshit_grocery_utility_bar() {
    ?>
    <div class="grocery-utility-bar">
        <div class="col-full">
            <div class="utility-bar-flex">
                <div>
                    <span>Standard delivery: Monday to Sunday, 8:00 AM to 9:00 PM</span>
                </div>
                <div>
                    <span style="margin-right: 20px;">Customer Support: +1 (800) 555-0199</span>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('myaccount'))); ?>">Customer Account</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// 5. Unified Consistent Green and White Hero Section Across ALL Pages
add_action('storefront_before_content', 'harshit_grocery_render_page_hero', 5);
function harshit_grocery_render_page_hero() {
    $title = '';
    $subtitle = '';
    $badge = 'FreshMart Online Grocery';
    $show_cta = false;

    if (is_front_page()) {
        $title = 'Fresh Groceries Delivered to Your Door';
        $subtitle = 'Browse our weekly selection of fresh produce, dairy, bakery goods, and pantry staples. Select home delivery or store pickup.';
        $show_cta = true;
    } elseif (is_shop()) {
        $title = 'Grocery Shop and Catalog';
        $subtitle = 'Browse our complete inventory of organic fruits, vegetables, dairy, artisan bakery, and daily staples.';
    } elseif (is_product_category()) {
        $term = get_queried_object();
        $title = $term->name;
        $subtitle = !empty($term->description) ? $term->description : 'Browse all available products in ' . $term->name . '.';
        $badge = 'Department Catalog';
    } elseif (is_product()) {
        $title = get_the_title();
        $cats = wc_get_product_category_list(get_the_ID(), ', ');
        $subtitle = 'Department: ' . strip_tags($cats) . ' | Inspected Fresh & Guaranteed';
        $badge = 'Product Specifications';
    } elseif (is_cart()) {
        $title = 'Your Shopping Cart';
        $subtitle = 'Review your selected grocery items and calculate delivery options.';
        $badge = 'Order Review';
    } elseif (is_checkout()) {
        $title = 'Checkout and Delivery';
        $subtitle = 'Enter your delivery address and choose Cash on Delivery or online payment.';
        $badge = 'Secure Order';
    } elseif (is_account_page()) {
        $title = 'Customer Account';
        $subtitle = 'Manage your grocery orders, saved addresses, and profile details.';
        $badge = 'Customer Portal';
    } elseif (is_page('about-us')) {
        $title = 'About FreshMart Grocery';
        $subtitle = 'Connecting regional growers, family dairies, and customers with fresh food daily.';
        $badge = 'Our Store';
    } elseif (is_page('contact')) {
        $title = 'Contact and Store Locations';
        $subtitle = 'Customer service desk open 7 days a week for order assistance and delivery inquiries.';
        $badge = 'Customer Care';
    } elseif (is_page('privacy-policy')) {
        $title = 'Privacy Policy';
        $subtitle = 'Information concerning data privacy, customer records, and grocery delivery security.';
        $badge = 'Store Policy';
    } elseif (is_page()) {
        $title = get_the_title();
        $subtitle = 'FreshMart Grocery - Quality and Service Guaranteed.';
    } elseif (is_search()) {
        $title = 'Search Results for: ' . get_search_query();
        $subtitle = 'Displaying matching grocery items from our catalog.';
        $badge = 'Catalog Search';
    } else {
        $title = get_the_title();
        $subtitle = 'FreshMart Online Grocery';
    }

    if (empty($title)) {
        return;
    }
    ?>
    <section class="site-page-hero">
        <div class="col-full">
            <div class="hero-inner-content">
                <span class="hero-dept-badge"><?php echo esc_html($badge); ?></span>
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
                <p class="hero-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php if ($show_cta) : ?>
                    <div class="hero-actions">
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn-hero-primary">Browse All Groceries</a>
                        <a href="#departments" class="btn-hero-secondary">View Departments</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}

// 6. Product Card Category Tag (above title)
add_action('woocommerce_shop_loop_item_title', 'harshit_grocery_card_category', 5);
function harshit_grocery_card_category() {
    global $product;
    if (!$product) {
        return;
    }
    $cats = wc_get_product_category_list($product->get_id(), ', ');
    if ($cats) {
        echo '<span class="product-card-category">' . strip_tags($cats) . '</span>';
    }
}

// 7. Product Card Details & Stock (below title)
add_action('woocommerce_after_shop_loop_item_title', 'harshit_grocery_card_details', 5);
function harshit_grocery_card_details() {
    global $product;
    if (!$product) {
        return;
    }
    $short = $product->get_short_description();
    if ($short) {
        $unit_text = wp_strip_all_tags($short);
        echo '<div class="product-card-unit">' . esc_html($unit_text) . '</div>';
    }
    echo '<div class="product-card-stock">In Stock &bull; Quick Dispatch</div>';
}

// 8. Single Product Page: Structured Specifications Table
add_action('woocommerce_single_product_summary', 'harshit_grocery_single_specs', 25);
function harshit_grocery_single_specs() {
    global $product;
    if (!$product) {
        return;
    }
    ?>
    <div class="grocery-specs-box">
        <h4>Product Details and Specifications</h4>
        <table class="grocery-specs-table">
            <tbody>
                <tr>
                    <th>Department</th>
                    <td><?php echo wc_get_product_category_list($product->get_id(), ', '); ?></td>
                </tr>
                <tr>
                    <th>Item Code (SKU)</th>
                    <td><?php echo esc_html($product->get_sku() ?: 'N/A'); ?></td>
                </tr>
                <tr>
                    <th>Packaging / Unit</th>
                    <td><?php echo esc_html(wp_strip_all_tags($product->get_short_description()) ?: 'Standard retail pack'); ?></td>
                </tr>
                <tr>
                    <th>Fulfillment</th>
                    <td>Same-day delivery or pickup with cold-chain insulated handling</td>
                </tr>
                <tr>
                    <th>Freshness Guarantee</th>
                    <td>100% money back or direct replacement upon delivery receipt</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

// 9. Clean Corporate 4-Column Footer
function harshit_grocery_custom_footer() {
    ?>
    <div class="footer-links-grid">
        <div class="footer-col">
            <h4>FreshMart Grocery</h4>
            <p style="color: #9aa7b5; line-height: 1.6; margin: 0 0 12px;">Local supermarket delivery offering pantry goods, dairy, bakery items, and fresh agricultural produce.</p>
            <p style="color: #9aa7b5; margin: 0;">124 Fresh Green Way, Organic Valley</p>
        </div>
        <div class="footer-col">
            <h4>Departments</h4>
            <ul>
                <li><a href="<?php echo esc_url(get_term_link('fruits', 'product_cat')); ?>">Fresh Fruits</a></li>
                <li><a href="<?php echo esc_url(get_term_link('vegetables', 'product_cat')); ?>">Vegetables</a></li>
                <li><a href="<?php echo esc_url(get_term_link('dairy-eggs', 'product_cat')); ?>">Dairy and Eggs</a></li>
                <li><a href="<?php echo esc_url(get_term_link('bakery', 'product_cat')); ?>">Bakery and Bread</a></li>
                <li><a href="<?php echo esc_url(get_term_link('pantry', 'product_cat')); ?>">Pantry and Grains</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Company</h4>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Our Store</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact and Locations</a></li>
                <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">All Products</a></li>
                <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('cart'))); ?>">Shopping Cart</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Customer Service</h4>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a></li>
                <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('myaccount'))); ?>">Manage Account</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Order Inquiries</a></li>
                <li><span>Store Hours: 7:00 AM - 10:00 PM</span></li>
            </ul>
        </div>
    </div>
    <div class="site-info">
        <div class="col-full" style="padding-top: 16px;">
            <p style="margin: 0; text-align: center;">&copy; <?php echo date('Y'); ?> FreshMart Online Grocery. All rights reserved. Commercial registration and food safety compliant.</p>
        </div>
    </div>
    <?php
}

// 10. Standards & Generator Removal
add_action('after_setup_theme', 'harshit_grocery_setup');
function harshit_grocery_setup() {
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('title-tag');
    remove_action('wp_head', 'wp_generator');
}
