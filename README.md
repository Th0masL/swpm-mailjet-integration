# Mailjet Integration addon for SWPM (Simple WordPress Membership)

This is repository contains a WordPress plugin/addon that you can install to be able to use [Mailjet](https://www.mailjet.com/) with [Simple WordPress Membership plugin](https://simple-membership-plugin.com/).

## General Information

This document will help you understand what this addon can do, and will help you configure it.

## What is it for / Why did I wrote this WordPress plugin

- I was looking for a way to easily send Email Marketing campaigns to the users of my WordPress website.
- The existing Newsletter / Email Markerting Addons available for **Simple WordPress Membership** did not seemed to provide the functionalities I was looking for
- I wanted to be able to automatically maintain a fully up-to-date list of contacts (email addresses) of my the users of my WordPress website.
- I wanted to avoid having to do some manual/hard-to-maintain customization to the PHP code of the original **Simple WordPress Membership** plugin or the original **Mailjet** plugin.
- I like the pricing model of Mailjet, which is not charging by list of contacts but by number of emails you send. I value quality over quantity, so the other pricing models does not makes sense to me.
- I was curious to learn how to write a WordPress plugin

## Requirements

- A working [WordPress website](https://www.wordpress.com)
- Basic understanding about how to install and configure WordPress plugins
- The official [Simple WordPress Membership plugin](https://simple-membership-plugin.com/)
- The official [Mailjet Plugin for WordPress](https://www.mailjet.com/integration/wordpress/)

## Installation

1) First, make sure that you have installed and configured [Simple WordPress Membership plugin](https://simple-membership-plugin.com/)

2) Then install [Mailjet Plugin for WordPress](https://www.mailjet.com/integration/wordpress/), create your [Mailjet](https://www.mailjet.com) account, and configure the **Mailjet Plugin for WordPress** following the [official documentation](https://www.mailjet.com/guides/wordpress-user-guide/)

    - Create a Mailjet account and generate your **API Keys**
    - Declare your **API Keys** in the **Official Mailjet Plugin**

    ![01-mailjet-plugin.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/01-mailjet-plugin.png)

3) Download this addon, either by cloning this Github repository, or by downloading the latest ZIP file from the [Release Page](https://github.com/Th0masL/swpm-mailjet-integration/releases)

4) Uncompress the ZIP file, and rename the folder to make sure it is named `swpm-mailjet-integration`

5) Move the folder `swpm-mailjet-integration` into the WordPress plugin folder, in `wp-content/plugins`

    ```
    # Expected folder structure :
    \wp-content
          \plugins
                \example-of-plugin-1
                \example-of-plugin-2
                \swpm-mailjet-integration
                      \swpm-mailjet-integration.php
                \example-of-plugin-3
    ```

6) Configure **Mailjet Plugin for WordPress**

    - Select/Create the **Contact List** where you will want to export the WordPress contacts to :

    ![02-mailjet-plugin.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/02-mailjet-plugin.png)

7) Go to the Plugins page of your WordPress website, and enable this plugin **SWPM Mailjet Integration**

    ![03-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/03-swpm-mailjet-integration.png)

8) Then go to the **WP Membership** settings, and go to the page **Addons Settings**

    ![04-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/04-swpm-mailjet-integration.png)

    ![05-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/05-swpm-mailjet-integration.png)

9) Enable the **Mailjet Integration** option and chose the **Susbscription Mode**

    ![06-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/06-swpm-mailjet-integration.png)

    ![07-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/07-swpm-mailjet-integration.png)

    Note: For verification purposes, we suggest you to first **Show the Newsletter checkbox** on the SWPM forms. Once everything is working fine, you can then decide to change the settings to hide the **Newsletter checkbox**.

10) Verify that the **Newsletter** checkbox is visible on the **SWPM Registration** and **SWPM Profil Edit** page

    ![08-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/08-swpm-mailjet-integration.png)

    ![09swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/09-swpm-mailjet-integration.png)

    ![10-swpm-mailjet-integration.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/10-swpm-mailjet-integration.png)

11) Verify that the Contacts / Email addresses are added to the Mailjet Contact List, on Mailjet's website

    ![11-mailjet-contact-list.png](https://github.com/Th0masL/swpm-mailjet-integration/blob/master/images/11-mailjet-contact-list.png)

## Troubleshooting / Problems

You will find below some basic help about the most commons problems.

#### Problem 1 : I don't see the Mailjet Integration addon in the WordPress Plugin page
  - Verify that you have uncompressed the ZIP file and named the folder correctly : `swpm-mailjet-integration`
  - Verify that it is in the path `/wp-content/plugins/swpm-mailjet-integration`
  - Verify that there isn't another sub-folder called `swpm-mailjet-integration` inside `/wp-content/plugins/swpm-mailjet-integration` (exemple: `/wp-content/plugins/swpm-mailjet-integration/swpm-mailjet-integration`)

#### Problem 2 : The Newsletter checkbox is not visible on the Simple WordPress Membership form pages
  - Verify that you are indeed using [Simple WordPress Membership plugin](https://simple-membership-plugin.com/) and not another Membership plugin
  - Verify that the SWPM plugin is up to date
  - Verify that the **Mailjet Integration Addon** is globally enabled on the **WordPress Plugins page**
  - Verify that the **Mailjet Integration Addon** is also set to **enabled** in the page **Simple WordPress Membership** > **Settings** > **Addons Settings**
  - Verify that the **Subscription Mode** is not set to **Invisible**

#### Problem 3 : The users does not seems to be added to the Contact List on my Mailjet Account
  - Verify that the **official Mailjet plugin** is installed, enabled and configured correctly
  - Log into your Mailjet account and make sure that you don't see any error messages
  - Make sure that the **Contact List** that you have configured in WordPress is indeed visible on the Mailjet website
  - On the **Mailjet website**, verify the properties of the **Contact List** and make sure that the property **email** is present (should be here by default, don't remove it)

### Note regarding email delivery issues :

Your WordPress website is not in charge of the email delivery. Your website is only in charge of syncing the contacts into the **Mailjet Contact List**.

For any email delivery problems, please verify your **Mailjet Account** and use **Mailjet's support** to assist you in the troubleshooting.

## Thanks

  - The people at [Simple WordPress Membership](https://simple-membership-plugin.com/), for having created such a nice Membership plugin
  - The people at [Mailjet](https://www.mailjet.com), for providing a great tool to manage Newsletters and Email Marketing

## Contribution / Bugs / Improvements

Please report any bug, and feel free to fork the project to add some improvements. Pull Requests are welcome :)

## Authors

* **Thomas L.** - *Original version* - [Th0masL](https://github.com/Th0masL)
