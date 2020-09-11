<h3><?php _e("Mailjet Integration Addon Settings",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></h3>
<p><?php _e("Read the",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?> <a href="https://github.com/Th0masL/swpm-mailjet-integration/" target="_blank"><?php _e("usage documentation",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></a> <?php _e("to learn how to use the Mailjet Integration addon.",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></p>
<table class="form-table">
    <tbody>
        <tr>
            <th scope="row"><?php _e("Enable Mailjet Integration",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></th>
            <td><input type="checkbox" <?php echo $swpm_mji_enable; ?> name="swpm-addon-mailjet-integration-enable" value="checked='checked'" <?php echo $swpm_mji_global_option_edit_status; ?>/>
            	<?php
                if (!$swpm_mji_mailjet_plugin_is_active) {
                	?>
                	<p style="color:red"><b><?php _e("This add-on requires the",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?> <a href='https://wordpress.org/plugins/mailjet-for-wordpress/'><?php _e("Official Mailjet plugin",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></a> <?php _e("to be installed and active.",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></b></p>
                	<?php
                }
                ?>
                <p class="description"><?php _e("Enabling this option will add an extra field on the Registration and on the Profile Edit forms.",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?><br><?php _e("This extra field will allow the",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?> <a href='https://wordpress.org/plugins/mailjet-for-wordpress/'><?php _e("Official Mailjet plugin",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></a> <?php _e("to automatically subscribe/update the newsletter preferences of the SWPM user on the Mailjet Website.",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?><br><?php _e("Enable this option to be able to edit the other settings below.",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Subscription Mode",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></th>
            <td>
                <select name="swpm-addon-mailjet-integration-subscription-mode" <?php echo $swpm_mji_options_edit_status ?>>
                    <option value="hidden"<?php echo $swpm_mji_subscription_mode === 'hidden' ? ' selected' : ''; ?>><?php _e("Invisible and Checked (Force Subscription)",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></option>
                    <option value="checked"<?php echo $swpm_mji_subscription_mode === 'checked' ? ' selected' : ''; ?>><?php _e("Visible and Checked",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></option>
                    <option value=""<?php echo $swpm_mji_subscription_mode === '' ? ' selected' : ''; ?>><?php _e("Visible but Not Checked",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></option>
                </select>
                <p class="description"><?php _e("Select the Subscription Mode on the Registration Form. Default is 'Visible but Not Checked', meaning that the user will have to check the Newsletter checkbox on the Registration Form if he wants to subscribe.",SWPM_MAILJET_INTEGRATION_PLUGIN_NAME); ?></p>
            </td>
        </tr>
    </tbody>
</table>
