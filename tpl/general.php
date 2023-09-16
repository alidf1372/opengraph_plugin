<?php

if (isset($_POST['og_submit'])) {
    if (isset($_POST['og_nonce']) && wp_verify_nonce($_POST['og_nonce'], 'og_settings_nonce')) {
        $show_opengraph = isset($_POST['opengraph']) && $_POST['opengraph'] === "on" ? 1 : 0;
        update_option('show_opengraph', $show_opengraph);
        update_option('description', sanitize_text_field($_POST['description']));
    } else {
        echo 'درخواست شما معتبر نمی‌باشد.';
    }
}

$show_opengraph = get_option('show_opengraph');
$description = get_option('description');

?>

<div class="wrap og_main_contents">
    <h1 class="wp-heading-inline">عمومی</h1>

    <form action="#" method="post">
        <?php wp_nonce_field('og_settings_nonce', 'og_nonce'); ?>
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row" class="row_label">
                    <label for="opengraph">افزودن تگ های opengraph : </label>
                </th>
                <td scope="row" class="row_input">
                    <input type="checkbox" name="opengraph" id="opengraph" <?php echo $show_opengraph ? 'checked="checked"' : ''; ?>>
                </td>
            </tr>
            <tr>
                <th scope="row" class="row_label">
                    <label for="description">متن جایگزین description : </label>
                </th>
                <td scope="row" class="row_input">
                    <textarea cols="50" rows="8" name="description" class="description"><?php echo esc_textarea($description); ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit">
            <button class="button button-primary" name="og_submit">ذخیره</button>
        </p>
    </form>
</div>
