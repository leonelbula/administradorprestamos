const url = document.getElementById("customercredit").value;
const $fullname = document.getElementById("fullname");
const $balance = document.getElementById("saldo");
const $customer_id = document.getElementById("id");
const $valpay = document.getElementById("valpay");
const $credit_id = document.getElementById("creditid");
const $numcouta = document.getElementById("numcouta");

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
                $balance.value = json[0].balance;
                console.log(json[0]);
                $customer_id.value = json[0].id;
                $numcouta.value = json[0].quota_number_pendieng;
                $credit_id.value = json[0].idcredit;
                let total = Number(json[0].amount) + Number(json[0].utility);
                let value = Number(total) / Number(json[0].quota_number);
                $valpay.value = value;
                $("#customerModal").modal("hide");
                //console.log(json);
            })
            .catch((err) => {
                console.log(err);
            });
    }
});
