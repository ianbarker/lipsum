<?php
/**
 * @author: ianbarker <ian@theorganicagency.com>
 * @date:   29/05/2014
 *
 */

?>
<div class="wrap">

    <h2>Dummy Content</h2>

    <p>Use the form below to generate dummy posts or pages. Large numbers will take some time to generate.</p>

    <form method="post">

        <input type="hidden" name="submit_dummy_content" value="true">

        <table class="form-table">

            <tr>
                <th>Post type</th>
                <td>
                    <select name="post_flavour">
                        <option value="post">Post</option>
                        <option value="page">Page</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Quantity</th>
                <td><input type="number" name="qty" value="9" style="width: 3em;"></td>
            </tr>

            <tr>
                <th>Images theme</th>
                <td>
                    <select name="image_type">
                        <option value="">Random</option>
                        <option value="abstract">Abstract</option>
                        <option value="animals">Animals</option>
                        <option value="business">Business</option>
                        <option value="cats">Cats</option>
                        <option value="city">City</option>
                        <option value="food">Food</option>
                        <option value="fashion">Fashion</option>
                        <option value="nightlife">Nightlife</option>
                        <option value="people">People</option>
                        <option value="nature">Nature</option>
                        <option value="sports">Sports</option>
                        <option value="technics">Technics</option>
                        <option value="transport">Transport</option>
                    </select>

                    <p class="description">This uses lorempixel.com to get random images.</p>
                </td>
            </tr>

            <tr>
                <th>Image size</th>
                <td>
                    <input type="number" name="image_width" value="<?= LoremPixel::getWidth() ?>" style="width:4em;">x<input type="number" name="image_height" value="<?= LoremPixel::getHeight() ?>" style="width:4em;">
                </td>
            </tr>

        </table>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Generate">
        </p>

    </form>
</div>
