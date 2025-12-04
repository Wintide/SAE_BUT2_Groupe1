document.addEventListener('DOMContentLoaded', () => {


    const openModel = (model) => model.classList.remove('hidden');
    const closeModel = (model) => model.classList.add('hidden');

    const fillConsultModel = (card) => {
        const isUC = card.classList.contains("uc");
        const isMonitor = card.classList.contains("monitor");

        document.querySelectorAll(".field-uc").forEach(el => el.style.display = "none");
        document.querySelectorAll(".field-monitor").forEach(el => el.style.display = "none");

        document.getElementById("model-serial").innerText = card.dataset.serial;
        document.getElementById("model-type").innerText = isUC ? "Unité Centrale" : "Moniteur";

        if (isUC) {
            document.getElementById("model-title").innerText = card.dataset.name;
            document.getElementById("model-name").innerText = card.dataset.name;
            document.getElementById("model-manufacturer").innerText = card.dataset.manufacturer;
            document.getElementById("model-model").innerText = card.dataset.model;
            document.getElementById("model-uctype").innerText = card.dataset.type;
            document.getElementById("model-cpu").innerText = card.dataset.cpu;
            document.getElementById("model-ram").innerText = card.dataset.rammb;
            document.getElementById("model-disk").innerText = card.dataset.diskgb;
            document.getElementById("model-os").innerText = card.dataset.os;
            document.getElementById("model-domain").innerText = card.dataset.domain;
            document.getElementById("model-location").innerText = card.dataset.location;
            document.getElementById("model-building").innerText = card.dataset.building;
            document.getElementById("model-room").innerText = card.dataset.room;
            document.getElementById("model-macaddr").innerText = card.dataset.macaddr;
            document.getElementById("model-purchase").innerText = card.dataset.purchase;
            document.getElementById("model-warranty").innerText = card.dataset.warranty;
            document.querySelectorAll(".field-uc").forEach(el => el.style.display = "block");
        }

        if (isMonitor) {
            document.getElementById("model-title").innerText = card.dataset.modele;
            document.getElementById("model-manu").innerText = card.dataset.manu;
            document.getElementById("model-modele").innerText = card.dataset.modele;
            document.getElementById("model-size").innerText = card.dataset.size + '"';
            document.getElementById("model-resolution").innerText = card.dataset.resolution;
            document.getElementById("model-connector").innerText = card.dataset.connector;
            document.getElementById("model-attachedto").innerText = card.dataset.attachedto;
            document.querySelectorAll(".field-monitor").forEach(el => el.style.display = "block");
        }

        openModel(document.getElementById("model-consulter"));
    };

    const fillEditModel = (card) => {
        const isUC = card.classList.contains("uc");
        const isMonitor = card.classList.contains("monitor");

        document.querySelectorAll(".form-uc").forEach(el => el.style.display = "none");
        document.querySelectorAll(".form-monitor").forEach(el => el.style.display = "none");

        document.getElementById("edit-serial").value = card.dataset.serial;
        document.getElementById("edit-type").value = isUC ? "uc" : "monitor";

        if (isUC) {
            document.querySelectorAll(".form-uc").forEach(el => el.style.display = "block");
            document.getElementById("edit-name").value = card.dataset.name;
            document.getElementById("edit-cpu").value = card.dataset.cpu;
            document.getElementById("edit-rammb").value = card.dataset.rammb;
            document.getElementById("edit-diskgb").value = card.dataset.diskgb;
            document.getElementById("edit-os").value = card.dataset.os;
            document.getElementById("edit-domain").value = card.dataset.domain;
            document.getElementById("edit-location").value = card.dataset.location;
            document.getElementById("edit-building").value = card.dataset.building;
            document.getElementById("edit-room").value = card.dataset.room;
            document.getElementById("edit-warranty").value = card.dataset.warranty;
        }

        if (isMonitor) {
            document.querySelectorAll(".form-monitor").forEach(el => el.style.display = "block");
            document.getElementById("edit-resolution").value = card.dataset.resolution;
            document.getElementById("edit-connector").value = card.dataset.connector;
            document.getElementById("edit-attachedto").value = card.dataset.attachedto;
        }

        openModel(document.getElementById("model-edit"));
    };

    // --- BOUTONS CONSULTER ---
    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', e => {
            const card = e.target.closest('.card');
            if (!card) return;
            fillConsultModel(card);
        });
    });

    // --- BOUTONS MODIFIER ---
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', e => {
            const card = e.target.closest('.card');
            if (!card) return;
            fillEditModel(card);
        });
    });

    // --- FERMETURE MODELS ---
    document.querySelector('.model .close')?.addEventListener('click', () => closeModel(document.getElementById("model-consulter")));
    document.getElementById("model-consulter")?.addEventListener('click', e => {
        if (e.target.id === "model-consulter") closeModel(e.target);
    });

    document.querySelector('.close-edit')?.addEventListener('click', () => closeModel(document.getElementById("model-edit")));
    document.getElementById("model-edit")?.addEventListener('click', e => {
        if (e.target.id === "model-edit") closeModel(e.target);
    });

    // --- SOUMISSION FORMULAIRE MODIFICATION ---
    document.getElementById("edit-form")?.addEventListener("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("modification_equipement.php", { method: "POST", body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    const serial = formData.get("serial");
                    const card = document.getElementById(serial);

                    if (!card) return;

                    if (formData.get("type") === "uc") {
                        card.dataset.name = formData.get("name");
                        card.dataset.cpu = formData.get("cpu");
                        card.dataset.ram_mb = formData.get("ram_mb");
                        card.dataset.disk_gb = formData.get("disk_gb");
                        card.dataset.os = formData.get("os");
                        card.dataset.domain = formData.get("domain");
                        card.dataset.location = formData.get("location");
                        card.dataset.room = formData.get("room");
                        card.dataset.warranty = formData.get("warranty");
                        card.querySelector("h3").innerText = formData.get("name");
                    }

                    if (formData.get("type") === "monitor") {
                        card.dataset.resolution = formData.get("resolution");
                        card.dataset.connector = formData.get("connector");
                        card.dataset.attached_to = formData.get("attached_to");
                        card.querySelector("h3").innerText = formData.get("model");
                    }

                    alert("Mise à jour réussie !");
                    closeModel(document.getElementById("model-edit"));
                } else {
                    alert("Erreur : " + data.message);
                }
            }).catch(err => alert("Erreur de communication avec le serveur."));
    });


});