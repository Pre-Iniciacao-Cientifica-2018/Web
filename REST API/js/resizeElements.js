var mq = window.matchMedia( "(min-width: 1000px)" );
        function resizeElements(){
            if(mq.matches){
    Chart.defaults.global.defaultFontSize = 16;
}
else if( (window.matchMedia( "(min-width: 800px)" )).matches){
    Chart.defaults.global.defaultFontSize = 13;
}
else if((window.matchMedia( "(min-width: 600px)" )).matches){
    Chart.defaults.global.defaultFontSize = 11;
}
            else {
                Chart.defaults.global.defaultFontSize = 9;
            }
        }