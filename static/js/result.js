/**
 * Created with JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 08/05/13
 * Time: 00:28
 * To change this template use File | Settings | File Templates.
 */
$(window).load(function(){
    $(".close").click(function() {
        $(this).parent().parent().parent().hide("slow");
    });

    $(".toggleConsole").click(function() {
        $(this).parent().parent().parent().find('div.console').toggle();
    }).click();
});