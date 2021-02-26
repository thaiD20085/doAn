$(document).ready(function () {
    $('#bike').hide();
    $('#btnLuachon1').click(function(){
        $('#btnLuachon2').removeClass('text-primary');
        $('#btnLuachon1').addClass('text-primary');
        $('#bike').hide();
        $('#car').show();
    })
    $('#btnLuachon2').click(function(){
        $('#btnLuachon1').removeClass('text-primary');
        $('#btnLuachon2').addClass('text-primary');
        $('#bike').show();
        $('#car').hide();
    })
    $(window).on("load", function () {
        $('.product-card img').each(function () {
            var width = $(this).width() / $(this).height() * 220 + 'px';
            $(this).css({
                'height': '220px',
                'width': width,
            });
        });
    });
});
