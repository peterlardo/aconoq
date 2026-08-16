<!-- ACONOQ Footer -->
<footer id="dynamic-footer" class="footer"></footer>

<style>.acq-consent{position:fixed;left:20px;right:20px;bottom:20px;z-index:10000;display:none;align-items:center;justify-content:space-between;gap:18px;padding:16px 20px;background:#0a4b2a;color:#fff;border-radius:14px;box-shadow:0 12px 35px rgba(0,0,0,.22);font-size:12px}.acq-consent p{margin:0;color:rgba(255,255,255,.82);line-height:1.5}.acq-consent a{color:#f5c908;text-decoration:underline}.acq-consent button{border:0;background:#f5c908;color:#0a4b2a;border-radius:8px;padding:9px 14px;font-weight:800;cursor:pointer;white-space:nowrap}@media(max-width:600px){.acq-consent{left:12px;right:12px;bottom:12px;align-items:flex-start;flex-direction:column}.acq-consent button{width:100%}}</style>
<div id="acq-consent" class="acq-consent"><p>Nous utilisons uniquement des cookies nécessaires au fonctionnement du site. <a href="politique-confidentialite.php">En savoir plus</a></p><button type="button" onclick="acceptAcoqConsent()">J’ai compris</button></div>
<script>function acceptAcoqConsent(){localStorage.setItem('aconoq-consent','accepted');var b=document.getElementById('acq-consent');if(b)b.style.display='none'}(function(){var b=document.getElementById('acq-consent');if(b&&!localStorage.getItem('aconoq-consent'))b.style.display='flex'})();</script><!-- Back to Top -->
<button id="back-to-top" class="btn--back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i class="fas fa-chevron-up" style="font-size:14px;"></i>
</button>

<!-- Supabase SDK + App -->
<script src="js/supabase-js.min.js"></script>
<script src="js/supabase.js"></script>
<script src="js/app.js"></script>

<!-- Scroll Reveal -->
<script>
(function(){
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) { if(e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }});
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal, .acq-reveal').forEach(function(el) { obs.observe(el); });
})();
</script>

<!-- Header scroll -->
<script>
(function(){
    var h = document.getElementById('navbar');
    if(!h) return;
    function update(){
        if(window.scrollY > 60){
            h.classList.add('navbar--scrolled');
        } else {
            h.classList.remove('navbar--scrolled');
        }
    }
    window.addEventListener('scroll', update);
    update();
})();
</script>

<!-- Back to Top visibility -->
<script>
window.addEventListener('scroll', function() {
    var btn = document.getElementById('back-to-top');
    if (!btn) return;
    if (window.scrollY > 400) {
        btn.style.opacity = '1';
        btn.style.pointerEvents = 'auto';
    } else {
        btn.style.opacity = '0';
        btn.style.pointerEvents = 'none';
    }
});
</script>
