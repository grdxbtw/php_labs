$(document).ready(function () {
  function loadCities() {
    $.ajax({
      url: "api_handler.php",
      type: "POST",
      data: { action: "getCities" },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          const cities = response.data;
          $("#city").append(
            cities.map(
              (city) =>
                `<option value="${city.Ref}">${city.Description}</option>`
            )
          );
        } else {
          console.error("Failed to load cities:", response.errors);
        }
      },
      error: function (xhr, status, error) {
        console.error("API request error:", error);
      },
    });
  }

  $("#order-weight, #city, #delivery-type").on("change", function () {
    const weight = parseFloat($("#order-weight").val());
    const cityRef = $("#city").val();
    const deliveryType = weight > 30 ? "warehouse" : $("#delivery-type").val();

    $('#delivery-type option[value="postomat"]').prop("disabled", weight > 30);
    $("#delivery-type").val(deliveryType);

    loadWarehouses(cityRef, deliveryType);
  });

  function loadWarehouses(cityRef, type) {
    $.ajax({
      url: "api_handler.php",
      type: "POST",
      data: { action: "getWarehouses", cityRef: cityRef, type: type },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          const warehouses = response.data;
          $("#delivery_point").empty();
          warehouses.forEach((wh) => {
            $("#delivery_point").append(
              `<option value="${wh.Ref}">${wh.Description}</option>`
            );
          });
        } else {
          console.error("Failed to load warehouses:", response.errors);
        }
      },
      error: function (xhr, status, error) {
        console.error("API request error:", error);
      },
    });
  }

  $("#submit-order").on("click", function () {
    const orderData = {
      order_number: $("#order-number").val(),
      order_weight: $("#order-weight").val(),
      city: $("#city").val(),
      delivery_type: $("#delivery-type").val(),
      delivery_point: $("#delivery_point").val(),
    };

    $.ajax({
      url: "save_order.php",
      type: "POST",
      data: orderData,
      success: function (response) {
        $("#response-message").text(response);
      },
      error: function (xhr, status, error) {
        console.error("Form submission error:", error);
        $("#response-message").text("Form submission error.");
      },
    });
  });

  loadCities();
});
