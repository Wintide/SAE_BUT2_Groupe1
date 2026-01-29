document.getElementById('userButton')?.addEventListener('click', function(e){
    const ov = document.getElementById('userOverlay');
    if(!ov) return;
        const shown = ov.style.display === 'block';
        ov.style.display = shown ? 'none' : 'block';
        ov.setAttribute('aria-hidden', shown ? 'true' : 'false');
});
document.addEventListener('click', function(e){
    const btn = document.getElementById('userButton');
    if (!btn) return;
    if (e.target !== ov) {
        ov.style.display = 'none';
        ov.setAttribute('aria-hidden', 'true');}
});