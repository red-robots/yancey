<?php 
if ( ! function_exists( 'bellaworks_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bellaworks_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on bellaworks, use a find and replace
   * to change 'bellaworks' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'bellaworks', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'bellaworks' ),
    'footer' => esc_html__( 'Footer', 'bellaworks' ),
    'sitemap' => esc_html__( 'Sitemap', 'bellaworks' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  /*
   * Enable support for Post Formats.
   * See https://developer.wordpress.org/themes/functionality/post-formats/
   */
  // add_theme_support( 'post-formats', array(
  //  'aside',
  //  'image',
  //  'video',
  //  'quote',
  //  'link',
  // ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'bellaworks_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );

  // Add theme support for Custom Logo.
  add_theme_support( 'custom-logo', array(
    'width'       => 250,
    'height'      => 250,
    'flex-width'  => true,
    'flex-height' => true,
  ) );

  add_theme_support( 'align-wide' );


  /* CUSTOM COLORS */
  // Try to get the current theme default color palette
  $oldColorPalette = current( (array) get_theme_support( 'editor-color-palette' ) );
  // Get default core color palette from wp-includes/theme.json
  if (false === $oldColorPalette && class_exists('WP_Theme_JSON_Resolver')) {
      $settings = WP_Theme_JSON_Resolver::get_core_data()->get_settings();
      if (isset($settings['color']['palette']['default'])) {
          $oldColorPalette = $settings['color']['palette']['default']; // there is no need to apply translations to color names - they are translated already
      }
  }
  // The new colors we are going to add
  $newColorPalette = [
      [
          'name' => esc_attr__('Orange', 'bellaworks'),
          'slug' => 'orange',
          'color' => '#BF7B2B',
      ],
      [
          'name' => esc_attr__('Dark Blue', 'bellaworks'),
          'slug' => 'dark_blue',
          'color' => '#073253',
      ],
      [
          'name' => esc_attr__('Teal', 'bellaworks'),
          'slug' => 'teal',
          'color' => '#6AA3A1',
      ],
  ];
  // Merge the old and new color palettes
  if (!empty($oldColorPalette)) {
      $newColorPalette = array_merge($oldColorPalette, $newColorPalette);
  }
  // Apply the color palette containing the original colors and 2 new colors:
  add_theme_support( 'editor-color-palette', $newColorPalette);

}
endif;
add_action( 'after_setup_theme', 'bellaworks_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bellaworks_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'bellaworks_content_width', 640 );
}
add_action( 'after_setup_theme', 'bellaworks_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bellaworks_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'bellaworks' ),
    'id'            => 'sidebar-1',
    'description'   => '',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'bellaworks_widgets_init' );


add_action( 'admin_head', 'action_admin_style_2020' );
function action_admin_style_2020(){ ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url') ?>/css/dashicons.min.css">
<?php }
