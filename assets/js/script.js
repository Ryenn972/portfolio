const links = document.querySelectorAll('.dock a[data-section]');
  const sections = Array.from(links).map(l => document.getElementById(l.dataset.section));

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        links.forEach(l => l.classList.remove('active'));
        const active = document.querySelector(`.dock a[data-section="${entry.target.id}"]`);
        if(active) active.classList.add('active');
      }
    });
  }, { rootMargin: '-40% 0px -50% 0px' });

  sections.forEach(s => { if(s) observer.observe(s); });

  const lastLink = links[links.length - 1];
  function checkBottom(){
    const scrolledToBottom = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 4;
    if(scrolledToBottom){
      links.forEach(l => l.classList.remove('active'));
      lastLink.classList.add('active');
    }
  }
  window.addEventListener('scroll', checkBottom, { passive: true });
  window.addEventListener('resize', checkBottom);
  checkBottom();
