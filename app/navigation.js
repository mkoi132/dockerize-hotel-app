function navigate() {
    let select = document.getElementById("menuSelect");
    let selectedValue = select.options[select.selectedIndex].value;
    if (selectedValue) {
        location.href = selectedValue;
    }
}
$document.ready(function filter() {
    // Event handler for when a dropdown item is clicked
    $('.dropdown-item').click(function () {
        let selectedBedConfig = $(this).data('bed-config');
        // Update the button text with the selected bed configuration
        $('#bedConfigDropdown').text($(this).text());

        // Show all card items initially
        $('.card.item').show();

        // Hide card items that do not match the selected bed configuration
        if (selectedBedConfig !== 'all') {
            $('.card.item').not('[data-bed-config="' + selectedBedConfig + '"]').hide();
        }
    });
});

