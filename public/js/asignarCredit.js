const urluser = document.getElementById("userget").value;
const $user = document.getElementById("user");
const $user_id = document.getElementById("userid");
console.log(urluser);
document.addEventListener("click", (e) => {
    if (e.target.matches(".agregarCobrador")) {
        let id = e.target.getAttribute("data-id");
        let data = { id: id };
        fetch(urluser, {
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
                $user.value = json[0].name;
                $user_id.value = json[0].id;
                $("#cobradorModal").modal("hide");
                //activateBtn();
            })
            .catch((err) => {
                alert(err);
            });
    }
});
