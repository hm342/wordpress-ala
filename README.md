# FreshMart Online Grocery - Project Documentation

A full-featured, professional WordPress and WooCommerce e-commerce website designed specifically for a modern online grocery store and local supermarket.

---

## 1. Quick Access & Credentials

| Resource | Details |
|---|---|
| **Website URL** | [http://localhost/harshit-wp/](http://localhost/harshit-wp/) |
| **Shop Catalog** | [http://localhost/harshit-wp/shop/](http://localhost/harshit-wp/shop/) |
| **Admin Dashboard** | [http://localhost/harshit-wp/wp-admin/](http://localhost/harshit-wp/wp-admin/) |
| **Admin Username** | `admin` |
| **Admin Password** | `adminpassword123` |
| **Database Name** | `harshit_grocery` |
| **Database User** | `root` (no password) |
| **Active Promo Code** | `FRESH20` (20% off all eligible grocery items) |

---

## 2. Technology Stack & Environment

- **CMS**: WordPress 7.1.3
- **E-Commerce Platform**: WooCommerce 11.2.1
- **Parent Theme**: Storefront 4.6.2 (Official WooCommerce parent theme)
- **Active Child Theme**: `Harshit Fresh Grocery` (`wp-content/themes/harshit-theme/`)
- **Server Environment**: Apache 2.4.58 (XAMPP), PHP 8.2.12, MySQL 10.4
- **Typography Stack**: Google Fonts `Inter` (weights 400, 500, 600, 700, 800)
- **Color Theme**: Deep Forest Green (`#155e42`), Crisp White (`#ffffff`), and Warm Slate (`#64748b`)

---

## 3. What Is in the Project

### A. Custom Child Theme (`wp-content/themes/harshit-theme/`)

1. **`style.css`**:
   - **Unified Color Palette**: Consistent green and white scheme across the entire store.
   - **Standard Rectangular Elements**: Clean `border-radius: 4px` buttons and badges (zero pill buttons, zero floating animations).
   - **Proper Product Cards**:
     - Image container with fixed 180px height and subtle background.
     - Uppercase department tag (e.g., `FRESH FRUITS`, `PANTRY & GRAINS`).
     - Bold product title linked directly to the single product page.
     - Net weight / packaging units (e.g., `Net Weight: 1 kg bag`, `400g clamshell`).
     - Stock indicator (`In Stock • Quick Dispatch`).
     - Regular strikethrough price and bold green sale price.
     - Full-width rectangular green `Add to cart` button pinned to the bottom.
   - **Proper Sale Badge Placement**: The red `SALE` badge is anchored with `position: absolute; top: 12px; left: 12px;` over the product image rather than sitting awkwardly inside text.

2. **`functions.php`**:
   - **Unified Hero Generator (`harshit_grocery_render_page_hero`)**: Generates an aligned green-and-white hero banner on **every** store page (Home, Shop, Category Archives, Single Products, Cart, Checkout, My Account, About, Contact, Privacy Policy).
   - **Container Alignment**: All hero elements are aligned to Storefront's `.col-full` width, matching the site logo, navigation, and product grids.
   - **Duplicate Title Elimination**: Suppressed duplicate `<h1>` headers rendered by WooCommerce and default page templates so the green hero banner is the single authoritative header.
   - **Product Card Details Hooks**: Injects department tags and net weight / packaging unit specs into the WooCommerce loop.
   - **Single Product Specifications Box**: Outputs a structured specifications table on single product pages (Department, SKU, Packaging/Unit, Cold-Chain Delivery, Freshness Guarantee).
   - **Top Utility Bar**: Displays standard store delivery hours, customer care hotline, and a link to the customer account portal.
   - **Custom Corporate Footer**: 4-column footer containing Department links, Company links, Customer Service policies, and copyright information.
   - **Favicon Loader**: Enqueues the custom green grocery bag icon in `<head>`.
   - **Generator Tag Removal**: Removes default WordPress meta tags.

3. **`template-grocery-home.php`**:
   - Custom homepage template assigned to the front page:
     - **Service Perks**: Scheduled Home Delivery, Free Shipping Over $35, Cold Chain Packaging, and Freshness Guarantee.
     - **Department Navigation Grid**: 7 departments with product count badges.
     - **Today's Discounts and Sales**: Live WooCommerce feed of on-sale grocery products.
     - **Introductory Promo Box**: Highlights the `FRESH20` promotional code.
     - **Pantry and Household Essentials**: Product feed of everyday staples.

4. **`assets/favicon.png` & `favicon.ico`**:
   - Dedicated 64x64 and root favicon featuring a clean white shopping bag mark on forest green.

---

### B. Product Catalog & Inventory (19 Live Items)

The store includes 19 pre-configured grocery items complete with SKUs, stock levels, net weights, categories, and high-resolution photography:

| Department | Product Name | SKU | Unit / Packaging | Price | Sale Price |
|---|---|---|---|---|---|
| **Fresh Fruits** | Organic Honeycrisp Apples | `FRT-APL-01` | 1 kg bag | $4.99 | $3.99 |
| **Fresh Fruits** | Cavendish Bananas | `FRT-BAN-02` | 1 kg bunch (5-7 bananas) | $1.99 | — |
| **Fresh Fruits** | Fresh Strawberries (400g) | `FRT-STR-03` | 400g clamshell | $5.49 | $4.29 |
| **Fresh Fruits** | Hass Avocados (3-Pack) | `FRT-AVO-04` | Mesh bag of 3 | $4.79 | $3.89 |
| **Fresh Fruits** | Valencia Oranges (1.5 kg) | `FRT-ORG-05` | 1.5 kg mesh bag | $3.99 | $2.99 |
| **Vegetables** | Fresh Broccoli Crowns | `VEG-BRO-01` | Approx. 500g (2 crowns) | $2.89 | $2.19 |
| **Vegetables** | Vine Tomatoes (1 kg) | `VEG-TOM-02` | 1 kg cluster | $3.49 | — |
| **Vegetables** | Pre-Washed Baby Spinach | `VEG-SPN-03` | 300g resealable tub | $3.29 | $2.49 |
| **Vegetables** | Bell Peppers (3-Pack) | `VEG-PEP-04` | Tri-color pack of 3 | $4.29 | — |
| **Vegetables** | Gold Potatoes (2.5 kg Bag) | `VEG-POT-05` | 2.5 kg paper sack | $4.49 | $3.49 |
| **Dairy & Eggs** | Whole Milk Grade A (1 Gallon) | `DAI-MLK-01` | 1 Gallon (3.78L) | $4.99 | $4.19 |
| **Dairy & Eggs** | Large Brown Eggs (12-Count) | `DAI-EGG-02` | 1 Dozen (12 eggs) | $5.49 | — |
| **Dairy & Eggs** | Plain Greek Yogurt (900g) | `DAI-YOG-03` | 900g tub | $4.79 | $3.99 |
| **Bakery & Bread** | Artisan Sourdough Loaf (650g) | `BAK-SDR-01` | 650g loaf, stone-baked | $5.29 | $4.19 |
| **Bakery & Bread** | All-Butter Croissants (4-Pack) | `BAK-CRS-02` | Pack of 4 croissants | $4.99 | — |
| **Pantry & Grains** | Extra Virgin Olive Oil (750ml) | `PAN-OIL-01` | 750ml glass bottle | $14.99 | $11.99 |
| **Pantry & Grains** | Aged Basmati Rice (5 kg) | `PAN-RIC-02` | 5 kg sack | $12.49 | — |
| **Juices & Drinks** | Pure Orange Juice with Pulp | `BEV-OJ-01` | 1 Liter bottle | $4.49 | $3.69 |
| **Snacks & Nuts** | Roasted Salted Almonds (400g) | `SNK-ALM-01` | 400g resealable pouch | $7.99 | $6.29 |

---

### C. Pages & Navigation

1. **[Home](http://localhost/harshit-wp/)**:
   - Homepage with hero, service guarantees, category grid, weekly sales, and promo box.
2. **[Shop Groceries](http://localhost/harshit-wp/shop/)**:
   - Complete grocery catalog with sorting, price display, pagination, and stock status.
3. **Department Pages**:
   - [Fresh Fruits](http://localhost/harshit-wp/product-category/fruits/)
   - [Vegetables](http://localhost/harshit-wp/product-category/vegetables/)
   - [Dairy and Eggs](http://localhost/harshit-wp/product-category/dairy-eggs/)
   - [Bakery and Bread](http://localhost/harshit-wp/product-category/bakery/)
   - [Pantry and Grains](http://localhost/harshit-wp/product-category/pantry/)
   - [Juices and Drinks](http://localhost/harshit-wp/product-category/beverages/)
   - [Snacks and Nuts](http://localhost/harshit-wp/product-category/snacks/)
4. **[About Us](http://localhost/harshit-wp/about-us/)**:
   - Farm sourcing story, cold-chain handling, and grocery inspection standards.
5. **[Contact Us](http://localhost/harshit-wp/contact/)**:
   - Store address, customer hotline, operating hours, delivery dispatch windows, and interactive contact form.
6. **[Privacy Policy](http://localhost/harshit-wp/privacy-policy/)**:
   - Comprehensive food delivery privacy terms (customer data, delivery logistics, payment security, cookie usage, data retention).
7. **[Cart](http://localhost/harshit-wp/cart/) & [Checkout](http://localhost/harshit-wp/checkout/)**:
   - Standard WooCommerce shopping cart, coupon application (`FRESH20`), delivery calculations, and checkout.
8. **[My Account](http://localhost/harshit-wp/my-account/)**:
   - Customer portal for managing previous orders, delivery addresses, and account details.

---

### D. Server Configuration & URL Rewriting

- **`.htaccess`**:
  - Configured with standard Apache `mod_rewrite` rules to support SEO-friendly pretty permalinks (`/%postname%/`).
- **Payment Gateway**:
  - Cash on Delivery (COD) enabled for instant offline/cash testing without requiring credit card APIs.
- **Store Status**:
  - WooCommerce "Coming Soon" mode disabled so live catalog products are publicly accessible.

---

## 4. Directory Structure Map

```text
harshit-wp/
├── .htaccess                             # Apache rewrite rules for clean URLs
├── favicon.ico                           # Root favicon
├── wp-config.php                         # Database connection credentials
├── README.md                             # This documentation file
├── wp-content/
│   ├── themes/
│   │   ├── storefront/                   # WooCommerce base parent theme
│   │   └── harshit-theme/                # Active child theme
│   │       ├── style.css                 # Custom styling, card layout, typography
│   │       ├── functions.php             # Unified hero, hooks, specs, footer
│   │       ├── template-grocery-home.php # Custom grocery homepage template
│   │       └── assets/
│   │           └── favicon.png           # Custom store favicon
│   ├── plugins/
│   │   └── woocommerce/                  # Core e-commerce engine
│   └── uploads/                          # Product photos and media files
└── wp-admin/ & wp-includes/              # WordPress core files
```
