<?php
/**
 * Plugin Name: Clone Page
 * Plugin URI: https://github.com/paulmp-git/ClonePage
 * Description: Lightweight plugin to clone/duplicate pages with one click. Adds a "Clone" link to the page row actions.
 * Version: 1.0.0
 * Author: Paul Pichugin
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

class Clone_Page {

    public function __construct() {
        add_filter('page_row_actions', array($this, 'add_clone_link'), 10, 2);
        add_action('admin_action_clone_page', array($this, 'clone_page'));
    }

    /**
     * Add Clone link to page row actions
     */
    public function add_clone_link($actions, $post) {
        if ($post->post_type !== 'page') {
            return $actions;
        }

        if (!current_user_can('edit_pages')) {
            return $actions;
        }

        $clone_url = wp_nonce_url(
            admin_url('admin.php?action=clone_page&post=' . $post->ID),
            'clone_page_' . $post->ID
        );

        $actions['clone'] = '<a href="' . esc_url($clone_url) . '" title="' . esc_attr__('Clone this page', 'clone-page') . '">' . __('Clone', 'clone-page') . '</a>';

        return $actions;
    }

    /**
     * Clone the page and redirect to editor
     */
    public function clone_page() {
        if (!isset($_GET['post']) || !isset($_GET['_wpnonce'])) {
            wp_die(__('Invalid request.', 'clone-page'));
        }

        $post_id = absint($_GET['post']);
        
        if (!wp_verify_nonce($_GET['_wpnonce'], 'clone_page_' . $post_id)) {
            wp_die(__('Security check failed.', 'clone-page'));
        }

        if (!current_user_can('edit_pages')) {
            wp_die(__('You do not have permission to clone pages.', 'clone-page'));
        }

        $post = get_post($post_id);

        if (!$post || $post->post_type !== 'page') {
            wp_die(__('Page not found.', 'clone-page'));
        }

        $new_post = array(
            'post_title'     => $post->post_title . ' (Copy)',
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_status'    => 'draft',
            'post_type'      => 'page',
            'post_author'    => get_current_user_id(),
            'post_parent'    => $post->post_parent,
            'menu_order'     => $post->menu_order,
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
        );

        $new_post_id = wp_insert_post($new_post);

        if (is_wp_error($new_post_id)) {
            wp_die(__('Failed to clone page.', 'clone-page'));
        }

        // Clone post meta
        $post_meta = get_post_meta($post_id);
        if ($post_meta) {
            foreach ($post_meta as $meta_key => $meta_values) {
                foreach ($meta_values as $meta_value) {
                    add_post_meta($new_post_id, $meta_key, maybe_unserialize($meta_value));
                }
            }
        }

        // Redirect to edit the new page
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    }
}

new Clone_Page();
