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