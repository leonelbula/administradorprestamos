const url = document.getElementById("customerget").value;
const $fullname = document.getElementById("fullname");
const $customer_id = document.getElementById("id");

document.addEventListener("click", (e) => {
    if (e.target.matches(".agregarCliente")) {
        let id = e.target.getAttribute("data-id");
        let data = { id: id };
        fetch(url, {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "aplication/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            redirect: "follow",
            referrerPolicy: "no-referrer",
            body: JSON.stringify(data),
        })
            .then((res) => {
                return res.json();
            })
            .then((json) => {
                $fullname.value = json[0].fullname;
                $customer_id.value = json[0].id;
                $("#customerModal").modal("hide");
                activateBtn();
            })
            .catch((err) => {
                alert(err);
            });
    }
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
