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
            document.getElementById("model-local").innerText = card.dataset.local;
            document.getElementById("model-year").innerText = card.dataset.year;
            document.querySelectorAll(".field-uc").forEach(el => el.style.display = "block");
        }

        if (isMonitor) {
            document.getElementById("model-title").innerText = card.dataset.model;
            document.getElementById("model-model").innerText = card.dataset.model;
            document.getElementById("model-size").innerText = card.dataset.size + '"';
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
            document.getElementById("edit-local").value = card.dataset.local;
            document.getElementById("edit-year").value = card.dataset.year;
        }

        if (isMonitor) {
            document.querySelectorAll(".form-monitor").forEach(el => el.style.display = "block");
            document.getElementById("edit-model").value = card.dataset.model;
            document.getElementById("edit-size").value = card.dataset.size;
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
                        card.dataset.local = formData.get("local");
                        card.dataset.year = formData.get("year");
                        card.querySelector("h3").innerText = formData.get("name");
                    }

                    if (formData.get("type") === "monitor") {
                        card.dataset.model = formData.get("model");
                        card.dataset.size = formData.get("size");
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