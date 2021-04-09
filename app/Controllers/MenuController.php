<?php

namespace IGHUB\Controllers;
class MenuController
{
    /**
     * @var string
     */
    public $prefix = 'wiloke_instaFeedHub';
    public $slug = 'wiloke_instaFeedHub_';

    public function __construct()
    {
        add_action('admin_menu', [$this, 'registerMenu']);
    }

    public function registerMenu()
    {
        add_menu_page(
            'Wiloke InstaFeedHub Setting',
            'Wiloke InstaFeedHub Setting',
            'administrator',
            $this->slug,
            [$this, 'settings']
        );
    }

    public function settings()
    {
        ?>
        <div style="width: 600px;
                    margin: 20px auto;
                    ">
            <a href="<?php echo InstaFeedHubController::getURLAuthorization()?>" style="font-size: 30px">LOGIN</a>
        </div>
        <?php
    }

}