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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php   
echo Hiding_WC_Products_Terms_Admin::hwpt_multi_select_save_submit_data();
echo Hiding_WC_Products_Terms_Admin::hwpt_check_box_save_submit_data();
$category_layout_data = get_option('hwpt_submit_category_settings_data'); 
?>
<div class="sp_cat_hide">
    <h1><?php echo esc_html('Categories');?></h1>
</div>
<div class="cat-top-main">
<?php if($category_layout_data === 'yes'){ ?>
    <form  method="post" name="hwpt_multi_select_save_submit_data" id="hwpt_multi_select_save_submit_data" novalidate>
        <div class="cate-full-info">
            <div class="cate-lable-item">
                <h2><?php echo esc_html('Select categories'); ?></h2>
            </div>
            <div class="multiple-select-item">
                <select data-placeholder="Select Categories" required="true" multiple class="chosen-select" name="multi_select_category[]">
                    <option value=""></option>
                    <?php 
                    $select_values = get_option('hide_wc_products_terms_list');
                    $list_category = Hiding_WC_Products_Terms_Admin::hwpt_list();
                    foreach($list_category as $key => $show_category){
                        $result = array_intersect((array)$list_category[$key],(array)$select_values);               
                            if($show_category['slug'] == isset($result['slug'])){?>
                                <option value="<?php echo esc_attr($show_category['slug']) ?>" selected><?php echo esc_html($show_category['name']); ?></option>
                        <?php }else{ ?>
                                <option value="<?php echo esc_attr($show_category['slug']) ?>"><?php echo esc_html($show_category['name']); ?></option>
                        <?php }            
                        } ?>
                </select>
            </div>
        </div>
        <div class="cat-submit-data">
            <p>
                <input type="submit" name="hwpt_multi_select_save_submit" class="button button-primary" value="Save Changes">
            </p>
        </div>
    </form>
    <?php } else { ?>
    <form  method="post" name="hwpt_save_checkbox_value" id="hwpt_save_checkbox_value">
        <div class="cate-no-data">
            <div class="cate-lable-item">
                <h2><?php echo esc_html('Select Category');?></h2>
            </div>
            <div class="cate-list-item">
                <?php 
                $select_values = get_option('hide_wc_products_terms_list');
                $list_category = Hiding_WC_Products_Terms_Admin::hwpt_list();
                foreach($list_category as $key => $show_category){
                    $result = array_intersect((array)$list_category[$key],(array)$select_values);
                    if($show_category['slug'] == isset($result['slug'])){ ?>
                        <label><input type="checkbox" name="check_box_category[]" value="<?php echo esc_attr($show_category['slug']) ?>" checked><?php echo esc_html($show_category['name']); ?></label>
                <?php }else{ ?>
                        <label><input type="checkbox" name="check_box_category[]" value="<?php echo esc_attr($show_category['slug']) ?>"><?php echo esc_html($show_category['name']); ?></label>
                <?php }
                    } ?>
            </div>                                     
        </div>
        <div class="cat-submit-data">
            <p>
                <input type="submit" name="hwpt_save_checkbox_value" class="button button-primary" value="Save Changes">
            </p>
        </div>
    </form>
    <?php } ?>
</div>