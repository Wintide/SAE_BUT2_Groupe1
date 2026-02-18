document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".sidebar-btn");
    const sections = document.querySelectorAll(".content-section");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {

            sections.forEach(sec => sec.classList.remove("active"));

            const target = btn.getAttribute("data-target");
            document.getElementById(target).classList.add("active");
        });
    });
});

const toggleUC = document.getElementById("toggle-uc");

if (toggleUC) {
    toggleUC.addEventListener("click", function () {

        const body = document.getElementById("advanced-uc");
        const arrow = document.getElementById("arrow-uc");

        if (body.style.display === "block") {
            body.style.display = "none";
            arrow.textContent = "▼";
        } else {
            body.style.display = "block";
            arrow.textContent = "▲";
        }
    });
}

const toggleMonitor = document.getElementById("toggle-monitor");

if (toggleMonitor) {
    toggleMonitor.addEventListener("click", function () {

        const body = document.getElementById("advanced-monitor");
        const arrow = document.getElementById("arrow-monitor");

        if (body.style.display === "block") {
            body.style.display = "none";
            arrow.textContent = "▼";
        } else {
            body.style.display = "block";
            arrow.textContent = "▲";
        }
    });
}