const $amount = document.getElementById("amount");
const $total = document.getElementById("total");
const $interest = document.getElementById("interest");
const $quota_number = document.getElementById("quota_number");
const $btnSave = document.getElementById("btnSave");

$btnSave.disabled = true;

$amount.addEventListener("change", () => {
    if ($interest.value !== "") {
        let valor = Number(($amount.value * $interest.value) / 100);
        let total = Number($amount.value) + valor;
        $total.value = total;
        activateBtn();
    } else {
        $total.value = $amount.value;
        activateBtn();
    }
    console.log("e");
});

$total.addEventListener("change", () => {
    let valor = Number($total.value - $amount.value);
    let interes = parseInt(Number((valor / $amount.value) * 100));
    $interest.value = interes;
    activateBtn();
});

$interest.addEventListener("change", () => {
    let valor = Number(($amount.value * $interest.value) / 100);
    let total = Number($amount.value) + valor;
    $total.value = total;
    activateBtn();
});

$quota_number.addEventListener("change", () => {
    activateBtn();
});

function activateBtn() {
    if (
        $amount.value !== "" &&
        $total.value !== "" &&
        $interest.value !== "" &&
        $quota_number.value !== ""
    ) {
        $btnSave.disabled = false;
    } else {
        $btnSave.disabled = true;
    }
}
