function addFreeBadge(element_id) {
    document.querySelector("#" + element_id).innerHTML = "FREE";
    document.querySelector("#" + element_id).classList.add("free");
    document.querySelector("#" + element_id).classList.remove("block", "invisible");
}

function addBlockBadge(element_id) {
    document.querySelector("#" + element_id).innerHTML = "BLOCK";
    document.querySelector("#" + element_id).classList.add("block");
    document.querySelector("#" + element_id).classList.remove("free", "invisible");
}

function clearElement(element_id) {
    document.querySelector("#" + element_id).innerHTML = "";
    document.querySelector("#" + element_id).classList.remove("block", "free");
    document.querySelector("#" + element_id).classList.add("invisible");
}

function setDisabled(element_id) {
    document.querySelector("#" + element_id).disabled = true;
}

function setEnabled(element_id) {
    document.querySelector("#" + element_id).disabled = false;
}

function add() {
    let cpf = document.querySelector("#txtCpf").value;

    $.ajax({
        method: "POST",
        url: "/blacklist/incluir.php",
        data: { cpf: cpf}
    })
    .success(function( msg ) {
        let json_msg = JSON.parse(msg);
        if (json_msg.status == "error") {
            setDisabled('free');
            setDisabled('block');
            addBlockBadge('badge');
            document.querySelector("#reqMessage").classList.add("danger");
        } else {
            setEnabled('free');
            setDisabled('block');
            addBlockBadge('badge');
            document.querySelector("#reqMessage").classList.add("success");
        }

        document.querySelector("#reqMessage").innerHTML = json_msg.content;
    });
}

function remove() {
    let cpf = document.querySelector("#txtCpf").value;

    $.ajax({
        method: "POST",
        url: "/blacklist/remover.php",
        data: { cpf: cpf}
    })
    .success(function( msg ) {
        let json_msg = JSON.parse(msg);
        if (json_msg.status == "error") {
            setDisabled('free');
            setDisabled('block');
            addBlockBadge('badge');
            document.querySelector("#reqMessage").classList.add("danger");
        } else {
            setEnabled('block');
            setDisabled('free');
            addFreeBadge('badge');
            document.querySelector("#reqMessage").classList.add("success");
        }

        document.querySelector("#reqMessage").innerHTML = json_msg.content;
    });
}

function check() {
    let cpf = document.querySelector("#txtCpf").value;

    if (cpf) {
        $.ajax({
            method: "GET",
            url: "/blacklist/consulta.php",
            data: { cpf: cpf}
        })
            .success(function( msg ) {
                let json_msg = JSON.parse(msg);
                if (json_msg.status == "error") {
                    setDisabled('free');
                    setDisabled('block');
                    addBlockBadge('badge');
                    document.querySelector("#reqMessage").classList.add("danger");
                } else {
                    setEnabled('block');
                    setDisabled('free');
                    addFreeBadge('badge');
                    document.querySelector("#reqMessage").classList.add("success");
                }

                document.querySelector("#reqMessage").innerHTML = json_msg.content;
            });
    }
}