<?php
/**
 * Template Name: Grocery Homepage
 *
 * Professional online grocery store homepage layout.
 */

get_header(); ?>

<div id="primary" class="content-area" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 16px;">
    <main id="main" class="site-main" role="main">

        <!-- Service Information Strip -->
        <section class="grocery-service-grid" style="margin-top: 24px;">
            <div class="service-item">
                <h4>Scheduled Home Delivery</h4>
                <p>Delivery available Monday through Sunday with selected morning and evening time windows.</p>
            </div>
            <div class="service-item">
                <h4>Free Shipping Over $35</h4>
                <p>Automatic free shipping applied to standard grocery orders exceeding $35.</p>
            </div>
            <div class="service-item">
                <h4>Cold Chain Packaging</h4>
                <p>Dairy, eggs, and fresh produce packed in insulated temperature-regulated bags.</p>
            </div>
            <div class="service-item">
                <h4>Freshness Guarantee</h4>
                <p>Inspect your items on arrival. Report any damaged product for an immediate refund.</p>
            </div>
        </section>

        <!-- Departments Navigation -->
        <section id="departments">
            <div class="section-heading-row">
                <h2>Shop by Department</h2>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">View All Categories</a>
            </div>

            <div class="department-grid">
                <?php
                $departments = array(
                    'fruits'      => 'Fresh Fruits',
                    'vegetables'  => 'Vegetables',
                    'dairy-eggs'  => 'Dairy and Eggs',
                    'bakery'      => 'Bakery and Bread',
                    'pantry'      => 'Pantry and Grains',
                    'beverages'   => 'Juices and Drinks',
                    'snacks'      => 'Snacks and Nuts',
                );

                foreach ($departments as $slug => $label) {
                    $term = get_term_by('slug', $slug, 'product_cat');
                    $link = $term ? get_term_link($term) : get_permalink(wc_get_page_id('shop'));
                    $count_str = $term && $term->count > 0 ? $term->count . ' items' : 'Browse';
                    ?>
                    <a href="<?php echo esc_url($link); ?>" class="department-card">
                        <span class="dept-name"><?php echo esc_html($label); ?></span>
                        <span class="dept-count"><?php echo esc_html($count_str); ?></span>
                    </a>
                    <?php
                }
                ?>
            </div>
        </section>

        <!-- Current Weekly Sale Items -->
        <section style="margin-bottom: 36px;">
            <div class="section-heading-row">
                <h2>Current Discounts and Sales</h2>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">View All Sale Items</a>
            </div>

            <?php
            echo do_shortcode('[products limit="8" columns="4" on_sale="true"]');
            ?>
        </section>

        <!-- Promotion Box -->
        <section class="promo-box">
            <div>
                <h3>Introductory Discount: 20% Off Your Order</h3>
                <p>Enter the promotional code at checkout to apply a 20% discount to eligible grocery items.</p>
                <div class="promo-code-badge">PROMO CODE: FRESH20</div>
            </div>
            <div>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="button">Shop Groceries</a>
            </div>
        </section>

        <!-- Featured Everyday Essentials -->
        <section style="margin-bottom: 40px;">
            <div class="section-heading-row">
                <h2>Pantry and Household Essentials</h2>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Full Inventory</a>
            </div>

            <?php
            echo do_shortcode('[products limit="8" columns="4" orderby="date" order="ASC"]');
            ?>
        </section>

    </main>
</div>

<?php
get_footer();
