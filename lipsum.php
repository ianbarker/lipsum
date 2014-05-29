<?php
/*
Plugin Name: Lorem Ipsum generator
Plugin URI: http://theorganicagency.com
Description: Generates dummy posts
Version: 1.0.0
Author: The Organic Agency
Author URI: http://theorganicagency.com
License: GPLv2 or later
*/

require_once 'classes/BaconIpsum.php';
require_once 'classes/LoremPixel.php';

add_action('admin_menu', function () {

    add_options_page('dummy-content', __('Dummy Content'), 'manage_options', 'dummy-content', function () {

        // check that the user has the required capability
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        if (isset($_POST['submit_dummy_content'])) {

            $post_type = $_POST['post_flavour'];
            $quantity = (int) $_POST['qty'];
            $image_type = $_POST['image_type'];
            $image_width = $_POST['image_width'];
            $image_height = $_POST['image_height'];

            $posts_created = 0;

            if ($quantity > 0) {

                for ($i = 0; $i < $quantity; $i++) {

                    $title = BaconIpsum::getInstance()->getCopy(1);
                    $title = wp_trim_words(substr($title[0], 0, strpos($title[0], '.')), 12, '');

                    $content = implode("\n", BaconIpsum::getInstance()->getCopy(rand(5, 10)));

                    $post = array(
                        'post_title'   => $title,
                        'post_content' => $content,
                        'post_author'  => get_current_user_id(),
                        'post_type'    => $post_type,
                        'post_status'  => 'publish',
                    );

                    $post_id = wp_insert_post($post);

                    if ($post_id !== 0) {

                        $image_data = LoremPixel::getInstance()->getImage($image_type, $image_width, $image_height);
                        if ($image_data) {
                            $img = imagecreatefromstring($image_data);

                            $uploads_dir = wp_upload_dir();
                            $path = $uploads_dir['path'] . '/' . $post_id . '.jpg';
                            imagejpeg($img, $path, 85);

                            $attachment = array(
                                'guid'           => $uploads_dir['url'] . '/' . basename($path),
                                'post_mime_type' => 'image/jpeg',
                                'post_title'     => basename($path),
                                'post_content'   => '',
                                'post_status'    => 'inherit',
                            );

                            $attachment_id = wp_insert_attachment($attachment, $path, $post_id);

                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                            $attachment_data = wp_generate_attachment_metadata($attachment_id, $path);
                            wp_update_attachment_metadata($attachment_id, $attachment_data);
                            update_post_meta($post_id, '_thumbnail_id', $attachment_id);

                            $posts_created++;

                        } else {

                            // delete the post as there's no image for it
                            wp_delete_post($post_id, true);

                        }


                        sleep(1);


                    }

                }

                echo '<div class="updated"><p><strong>Created ' . $posts_created . ' ' . $post_type . 's</strong></p></div>';

            }

        }

        include plugin_dir_path(__FILE__) . 'templates/form.php';


    });

});
