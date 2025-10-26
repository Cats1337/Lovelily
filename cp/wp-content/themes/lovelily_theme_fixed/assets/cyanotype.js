(function(){
  const fallback = (img)=>{
    const wrap = img.closest('.cyanotype');
    const el = document.createElement('div');
    el.className = 'img-fallback';
    el.textContent = 'Add or fix the image path';
    if (wrap) { wrap.innerHTML = ''; wrap.appendChild(el); }
    else { img.replaceWith(el); }
  };
  const imgs = Array.from(document.querySelectorAll('img[data-src]'));
  const io = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(!e.isIntersecting) return;
      const img = e.target;
      io.unobserve(img);
      img.onload = ()=> img.removeAttribute('data-src');
      img.onerror = ()=> fallback(img);
      img.src = img.getAttribute('data-src');
    });
  }, { rootMargin: '200px 0px' });
  imgs.forEach(i=> io.observe(i));

  window.llbOpenLightbox = function(article){
    const fig = article.querySelector('img');
    if(!fig || !fig.src) return;
    const title = article.getAttribute('data-caption') || '';
    const desc = article.getAttribute('data-description') || '';
    let lb = document.getElementById('llb-lightbox');
    if(!lb){
      lb = document.createElement('div');
      lb.id = 'llb-lightbox';
      lb.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.7);display:flex;align-items:center;justify-content:center;z-index:999;padding:24px';
      lb.innerHTML = '<button aria-label="Close" style="position:absolute;top:16px;right:16px;padding:6px 10px;border:1px solid #ddd;border-radius:10px;background:#fff;cursor:pointer">&times;</button><div style="max-width:min(100%,960px);text-align:center"><img alt="" style="max-width:100%;max-height:80vh;border-radius:12px;display:block;margin:0 auto"><p style="color:#fff;margin-top:10px"></p></div>';
      document.body.appendChild(lb);
      lb.addEventListener('click', e=>{ if(e.target === lb || e.target.tagName === 'BUTTON') lb.remove(); });
    }
    lb.querySelector('img').src = fig.src;
    const p = lb.querySelector('p');
    // render title (bold) and description (block) safely using textContent
    p.innerHTML = '';
    if(title){ const strong = document.createElement('strong'); strong.textContent = title; p.appendChild(strong); }
    if(desc){ const span = document.createElement('span'); span.style.display = 'block'; span.textContent = desc; p.appendChild(span); }
  };
})();
