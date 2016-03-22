<?php

if (! defined('ABSPATH')) {
    exit;
}

class Plugin_Name_Assets
{
    /**
     * Construct
     */
    function __construct()
    {
        $this->add_public_assets();
        $this->add_admin_assets();
    }

    /**
     * Add public assets.
     */
    public function add_public_assets()
    {
        // Styles
        add_action('wp_enqueue_style', array(&$this, 'register_styles'));
        add_action('wp_enqueue_style', array(&$this, 'enqueue_styles'));

        // PScripts
        add_action('wp_enqueue_scripts', array(&$this, 'register_scripts'));
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
    }

    /**
     * Register public styles.
     *
     * @return void
     */
    public function register_styles()
    {
        wp_register_style('plugin', PLUGIN_URL.'assets/public/css/plugin.css', false, PLUGIN_VERSION, 'screen');
    }

    /**
     * Enqueue public styles.
     *
     * @return void
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('plugin');
    }

    /**
     * Register public scripts.
     *
     * @return void
     */
    public function register_scripts()
    {
        wp_register_script('plugin', PLUGIN_URL.'assets/public/js/plugin.js', null, PLUGIN_VERSION);
    }

    /**
     * Enqueue public scripts.
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('plugin');

        self::localize_public_scripts();
    }

    /**
     * Localize public scripts.
     *
     * @return void
     */
    public function localize_public_scripts()
    {
        wp_localize_script('plugin', 'Plugin', array(
            'home_url'   => get_home_url(),
            'ajax_url'   => admin_url('admin-ajax.php'),
            'wp_version' => get_bloginfo('version'),
        ));
    }
}