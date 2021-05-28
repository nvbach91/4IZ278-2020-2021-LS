// enable/disable options
if ($('#delivery-method').val() === 'homeDelivery') {
    $("option[value='cashOnPersonalCollection']").attr("disabled", "disabled");
}
if ($('#delivery-method').val() === 'personalCollection') {
    $("option[value='cashOnHomeDelivery']").attr("disabled", "disabled");
}

$('#delivery-method').on('change', function () {
    if ($(this).val() === 'personalCollection') {
        $('#payment-method').val('bankTransfer');
        $("option[value='cashOnHomeDelivery']")
            .attr("disabled", "disabled").siblings().removeAttr("disabled");
    } else if ($(this).val() === 'homeDelivery') {
        $('#payment-method').val('bankTransfer');
        $("option[value='cashOnPersonalCollection']")
            .attr("disabled", "disabled").siblings().removeAttr("disabled");
    }
});