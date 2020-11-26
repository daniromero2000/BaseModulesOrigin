function data(dataId) {
    ontypeServiceSelectedProductEditModal(dataId)
}

function ontypeServiceSelectedProductEditModal(dataId) {
    $('#lead_service_id' + dataId).prop("disabled", true);
    $('#lead_product_id' + dataId).prop("disabled", true);
    $('#employee_id' + dataId).prop("disabled", true);

    var typeServiceEditSelected_id = $("#department_id" + dataId).val();
    $.get('/admin/getDeparment/' + typeServiceEditSelected_id + '', function (data) {
        var html_service = '<option selected value> Selecciona </option>';
        let services = data[0].lead_services;
        for (var i = 0; i < services.length; i++) {
            if ($('#lead_service_id' + dataId).val() == services[i].id) {
                html_service += '<option value="' + services[i].id + '"  selected="selected">' + services[i]
                    .service + '</option>';
            }
            html_service += '<option value="' + services[i].id + '" ">' + services[i].service + '</option>';
        }
        $('#lead_service_id' + dataId).html(html_service);
        $('#lead_service_id' + dataId).prop("disabled", false);

        // Productos
        var html_products = '<option selected value> Selecciona </option>';
        let products = data[0].lead_products;
        for (var i = 0; i < products.length; i++) {
            if ($('#lead_product_id' + dataId).val() == products[i].id) {
                html_products += '<option value="' + products[i].id + '"  selected="selected">' + products[
                    i].product + '</option>';
            }
            html_products += '<option value="' + products[i].id + '" ">' + products[i].product +
                '</option>';
        }
        $('#lead_product_id' + dataId).html(html_products);
        $('#lead_product_id' + dataId).prop("disabled", false);

        // Productos
        var html_employees = '<option selected value> Selecciona </option>';
        let employees = data[0].employees;
        for (var i = 0; i < employees.length; i++) {
            if ($('#employee_id' + dataId).val() == employees[i].id) {
                html_employees += '<option value="' + employees[i].id + '"  selected="selected">' +
                    employees[i].name + '</option>';
            }
            html_employees += '<option value="' + employees[i].id + '" ">' + employees[i].name +
                '</option>';
        }
        $('#employee_id' + dataId).html(html_employees);
        $('#employee_id' + dataId).prop("disabled", false);
    });
};
