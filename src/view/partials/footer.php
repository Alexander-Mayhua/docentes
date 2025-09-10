<?php ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function setupFilter(inputId, itemSelector, fields){
  const input = document.getElementById(inputId);
  if(!input) return;
  input.addEventListener('input', ()=>{
    const q = input.value.trim().toLowerCase();
    document.querySelectorAll(itemSelector).forEach(el=>{
      const text = fields.map(f=> (el.dataset[f]||'').toLowerCase()).join(' ');
      el.style.display = text.includes(q) ? '' : 'none';
    });
  });
}
</script>
</body>
</html>
