<?php
function my_login_logo() {
    echo '<style type="text/css">
        body.login {
            background: #1E1450;
        }
        #login h1 a, .login h1 a {
            background-image: url(' . get_stylesheet_directory_uri() . '/src/img/admin_logo.svg);
            height: 65px;
            width: 320px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 20px;
        }
        #login-message {
            border-color: #ef8903;
            background: none;
            color: #fff;
        }
        .login form {
            background: none !important;
            border: 1px solid #ef8903 !important; 
        }
        .login label {
            color: #fff;
        }
    </style>';
}
 


function ec_dashboard_custom_logo() {
    echo '
    <style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
        background-image: url(' . get_bloginfo('stylesheet_directory') . '/src/img/admin_logo.svg)
        !important; background-position: 0 0; color:rgba(0, 0, 0, 0);background-size:cover;
    }
    #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon { background-position: 0 0; }
    </style>
    ';
}