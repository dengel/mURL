document.addEvent('domready', function() {

    dbug.enable();
    dbug.log('Preloading murl.js');

    var OptionsDrawer = new Fx.Slide("options_div");
    OptionsDrawer.hide();

    $('options_link').addEvent('click', function(e){
        e.stop();
        OptionsDrawer.toggle();
    });


});