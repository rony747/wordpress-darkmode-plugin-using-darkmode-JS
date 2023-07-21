(function ($) {
    'use strict';

    const options = {
        bottom: darkpress['general'].darkpress_position_bottom ? darkpress['general'].darkpress_position_bottom : '32px', // default: '32px'
        right: darkpress['general'].darkpress_position_right ? darkpress['general'].darkpress_position_right : 'unset', // default: '32px'
        left: darkpress['general'].darkpress_position_left ? darkpress['general'].darkpress_position_left : 'unset', // default: 'unset'
        time: '0.5s', // default: '0.3s'
        mixColor: darkpress['color'].darkpress_mix_color ? darkpress['color'].darkpress_mix_color : '#fff', // default: '#fff'
        backgroundColor: darkpress['color'].darkpress_bg_color ? darkpress['color'].darkpress_bg_color : '#fff',  // default: '#fff'
        buttonColorDark: darkpress['color'].darkpress_btn_dark_color ? darkpress['color'].darkpress_btn_dark_color : '#100f2c',  // default: '#100f2c'
        buttonColorLight: darkpress['color'].darkpress_btn_light_color ? darkpress['color'].darkpress_btn_light_color : '#fff', // default: '#fff'
        saveInCookies: !!(darkpress['other'].darkpress_save_cookie && Number(darkpress['other'].darkpress_save_cookie) === 1), // default: true,
        label: darkpress['general'].darkpress_label ? darkpress['general'].darkpress_label : '🌓', // default: ''
        autoMatchOsTheme: !!(darkpress['other'].darkpress_auto_os_theme && Number(darkpress['other'].darkpress_auto_os_theme) === 1) // default: true
    }

    const darkmode = new Darkmode(options);
    darkmode.showWidget();
})(jQuery);
