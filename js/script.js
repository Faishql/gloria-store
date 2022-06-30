// (function ($) {
//     $(document).ready(function () {
//         // hide .navbar first
//         $(".navbar").hide();

//         // fade in .navbar
//         $(function () {
//             $(window).scroll(function () {
//                 // set distance user needs to scroll before we start fadeIn
//                 if ($(this).scrollTop() > 100) {
//                     $(".navbar").fadeIn();
//                 } else {
//                     $(".navbar").fadeOut();
//                 }
//             });
//         });
//     });
// })(jQuery);

$(document).on("click", "button.cart", function () {
    var myBookId = $(this).data("id-product");
    $(".modal-body #id_product").val(myBookId);
    // As pointed out in comments,
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});

$("#exampleModalCenter").hide(400, removeHashFromUrl());

function removeHashFromUrl() {
    window.location.hash = "";
}

$(".carousel-item:first-child").one().addClass("active");
