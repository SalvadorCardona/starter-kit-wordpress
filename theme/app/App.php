<?php
namespace AppWordpress;

use Timber\Site;
use Timber\Menu;

class App extends Site
{
    public function __construct()
    {
        add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );

        new \StarterKitWp\Model\PostType\PostTypeExample();

        parent::__construct();
    }
    public function add_to_context( $context ) {
        $context['menu'] = new Menu();
        $context['site'] = $this;
        return $context;
    }

    public function myfoo( $text ) {
        $text .= ' bar!';
        return $text;
    }

    public function add_to_twig( $twig ) {
        /* this is where you can add your own functions to twig */
        // $twig->addExtension( new \Twig_Extension_StringLoader() );
        // $twig->addFilter('myfoo', new \Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
        return $twig;
    }
}