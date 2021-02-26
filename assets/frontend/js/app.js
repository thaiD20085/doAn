$(document).ready(function () {
    $('#carFooter').click(function () {
        $('#bikeList').removeClass('showList');
        $('#lhList').removeClass('showList');
        $('#carList').toggleClass('showList');
        $('#bikeFooter i').removeClass('more');
        $('#lhFooter i').removeClass('more');
        $('#carFooter i').toggleClass('more');
    });
    $('#bikeFooter').click(function () {
        $('#carList').removeClass('showList');
        $('#lhList').removeClass('showList');
        $('#bikeList').toggleClass('showList');
        $('#bikeFooter i').toggleClass('more');
        $('#lhFooter i').removeClass('more');
        $('#carFooter i').removeClass('more');
    });
    $('#lhFooter').click(function () {
        $('#carList').removeClass('showList');
        $('#bikeList').removeClass('showList');
        $('#lhList').toggleClass('showList');
        $('#bikeFooter i').removeClass('more');
        $('#lhFooter i').toggleClass('more');
        $('#carFooter i').removeClass('more');
    });
});