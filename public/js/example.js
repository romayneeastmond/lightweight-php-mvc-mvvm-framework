$(document).ready(function () {
    $('#ExampleViewModelAnnotatedOptions a, #ExampleViewModelAnnotatedOptionsSmall a').on("click", function (e) {
        e.preventDefault();

        $('#ExampleViewModelAnnotatedOptions li, #ExampleViewModelAnnotatedOptionsSmall li').removeClass("active");
        $('.' + $(this).attr("class") ).parent().addClass("active");

        $('.example-panel').addClass("hidden");

        $('#' + $(this).attr("data-target")).removeClass("hidden");
    });
});