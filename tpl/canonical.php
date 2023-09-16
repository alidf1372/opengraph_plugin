<?php

if (isset($_POST['og_submit'])) {
    if (isset($_POST['og_nonce']) && wp_verify_nonce($_POST['og_nonce'], 'og_settings_nonce')) {
        $current_canonical = get_option('canonical');

        $current_canonical = $current_canonical ? json_decode($current_canonical, true) : [];

        $main_canonical = intval($_POST['main_canonical']);
        $sub_canonical = intval($_POST['sub_canonical']);

        $existing_item = null;
        foreach ($current_canonical as $key => $item) {
            if ($item['main'] === $main_canonical) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {

            if (!in_array($sub_canonical, $current_canonical[$existing_item]['sub'])) {
                $current_canonical[$existing_item]['sub'][] = $sub_canonical;
            }
        } else {
            $current_canonical[] = ['main' => $main_canonical, 'sub' => [$sub_canonical]];
        }

        update_option('canonical', wp_json_encode($current_canonical));
    } else {
        echo 'درخواست شما معتبر نمی‌باشد.';
    }
}


?>

<div class="wrap og_main_contents">
    <h1 class="wp-heading-inline">مدیریت تگ های canonical</h1>

    <p>
        گاهی در وبسایت با صفحاتی مواجه‌ایم که از لحاظ محتوا شباهت زیادی به یکدیگر دارند،
        اما دارای آدرس‌های متفاوتی هستند و در حالت عادی ممکن است که موتورهای جستجو
        در تشخیص صفحه مطلوب ما کمی دچار مشکل شوند و آدرس دیگری را به‌عنوان صفحه اصلی ایندکس کنند.
        در این صورت ما یک صفحه اصلی و تعدادی صفحه فرعی داریم که باید به صفحه اصلی اشاره کنند و مرتورهای جستجو را
        به درستی راهنمایی و هدایت کنند.
    </p>

    <form action="#" method="post">
        <?php wp_nonce_field('og_settings_nonce', 'og_nonce'); ?>
        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row" class="row_label">
                    <label for="main_canonical">شناسه پست مرجع : </label>
                </th>
                <td scope="row" class="row_input">
                    <input type="number" name="main_canonical" id="main_canonical">
                </td>
            </tr>
            <tr>
                <th scope="row" class="row_label">
                    <label for="sub_canonical">شناسه پست کانونیکال : </label>
                </th>
                <td scope="row" class="row_input">
                    <input type="number" name="sub_canonical" id="sub_canonical">
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit">
            <button class="button button-primary" name="og_submit">ذخیره</button>
        </p>
    </form>

    <hr>

    <form action="#" method="post">
        <table class="form-table" role="presentation">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>شناسه پست مرجع</th>
                <th>شناسه پست کانونیکال</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $current_canonical = get_option('canonical');
        $current_canonical = $current_canonical ? json_decode($current_canonical, true) : [];
        $count = 0;
        foreach ($current_canonical as $key => $value) :
            $count++;
        ?>
            <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $value['main'] ?></td>
                <td>
                    <?php foreach ($value['sub'] as $sub_value) : ?>
                        <?php echo $sub_value ?>,
                    <?php endforeach; ?>
                </td>
                <td><a href="<?php echo esc_url(add_query_arg(["action"=>"edit","main"=>$value['main']])) ?>"><span class="dashicons dashicons-edit"></span></a> | <a href="<?php echo esc_url(add_query_arg(["action"=>"delete","main"=>$value['main']])) ?>"><span class="dashicons dashicons-trash"></span></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </form>

</div>