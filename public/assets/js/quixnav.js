
(function($) {
    "use strict"

    //all value should be lowercase
    new quixSettings({
        version: "light",                //  "light" || "dark"
        layout: "horizontal",             //  "vertical" || "horizontal"
        navheaderBg: "color_7",         //  "color_1" to "color_10"
        headerBg: "color_7",            //  "color_1" to "color_10"
        sidebarStyle: "full",           //  "full" || "compact" || "mini" || "overlay"
        sidebarBg: "color_7",           //  "color_1" to "color_10"
        sidebarPosition: "fixed",      //  "static" || "fixed"
        headerPosition: "fixed",       //  "static" || "fixed"
        containerLayout: "boxed",        //  "boxed" ||  "wide" || "wide-boxed"
        direction: "ltr"                //  "ltr" || "rtl"
    });

})(jQuery);