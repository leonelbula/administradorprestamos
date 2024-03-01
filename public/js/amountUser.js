const $amount = document.getElementById("amount").value;
const $deliveredvalue = document.getElementById("deliveredvalue");
const $difference = document.getElementById("difference");

$deliveredvalue.addEventListener("change", () => {
    $difference.value = $deliveredvalue.value - $amount;
});
