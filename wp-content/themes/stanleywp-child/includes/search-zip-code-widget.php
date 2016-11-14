<div class="searchbox-container">
    <?php if (!is_user_logged_in()) { $logged = "log"; } ?>
    <div class="searchbox <?php echo $logged; ?>">

        <h1> <?php echo get_field("homepage_search_heading", get_option( 'page_on_front' )); ?></h1>

        <form action="/find-child-care/" method="POST">

            <a><input name="zip_code" class="field zip" type="text" value="<?php echo get_field("homepage_zipcode_text", get_option( 'page_on_front' )); ?>"></a>
            <div class="clearfix"></div>
            <div style="color:#fff">*Email Address Required</div>
            <input name="from_home" value="from_home" hidden>

            <a href="#"><input class="submit" type="submit" value="<?php echo get_field("homepage_search_button", get_option( 'page_on_front' )); ?>"></a>

        </form>

        <div class="clearfix"></div>
    </div>
</div>