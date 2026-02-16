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

const toggleUC = document.getElementById("toggle-advanced-uc");
if (toggleUC) {
    const contentUC = document.getElementById("advanced-fields-uc");
    const arrowUC = toggleUC.querySelector(".arrow");

    toggleUC.addEventListener("click", () => {
        contentUC.classList.toggle("open");
        arrowUC.classList.toggle("rotate");
    });
}