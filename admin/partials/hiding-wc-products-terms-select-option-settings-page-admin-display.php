<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://profiles.wordpress.org/vijayrathod245
 * @since      1.0.0
 *
 * @package    Hiding_WC_Products_Terms
 * @subpackage Hiding_WC_Products_Terms/admin/partials
 */
?>
<?php echo Hiding_WC_Products_Terms_Admin::hwpt_submit_category_settings_save_data();
$category_layout_data_values = get_option('hwpt_submit_category_settings_data'); ?>
<div class="wrap"><h1><?php echo esc_html('Settings');?></h1>
    <div class="main-cat-prod-info">
        <form  method="post" name="submit_category_settings_data" class="submit-category-settings-data-form" id="submit_category_settings_data">
            <h2 class="cat-general-info"><?php echo esc_html('General');?></h2>
            <h2 class="cat-layouts-item"><?php echo esc_html('Layout Options');?></h2>
            <table class="submit-category-settings-data">
                <tbody>
                    <tr>
                        <th><?php echo esc_html('Select Category Option');?></th>
                        <td>
                            <fieldset>
                                <label class="cate-value-info"><input type="radio" name="select_hwpt_category" value="yes" <?php echo ($category_layout_data_values=='yes' ? 'checked=checked':''); ?>><?php echo esc_html('Multi Select');?></label>
                                <label class="cate-value-info"><input type="radio" name="select_hwpt_category" value="no" <?php echo ($category_layout_data_values=='no' ? 'checked=checked':''); ?>><?php echo esc_html('Checkbox');?></label>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="cat-submit-data">
                <p>
                    <input type="submit" name="hwpt_submit_category_settings_save" class="button button-primary" value="Save Changes">
                </p>
            </div>
        </form>
    </div>
</div>

