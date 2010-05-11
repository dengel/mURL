document.addEvent('domready', function() {

    dbug.enable();
    dbug.log('Preloading murl.js');

    // Options link to toggle options div.
    var OptionsDrawer = new Fx.Slide("options_div");
    OptionsDrawer.hide();

    $('options_link').addEvent('click', function(e){
        e.stop();
        OptionsDrawer.toggle();
    });

    // Beta link to toggle beta div.
    var BetaDrawer = new Fx.Slide("beta_div");
    BetaDrawer.hide();

    $('beta_link').addEvent('click', function(e){
        e.stop();
        BetaDrawer.show();
    });

});