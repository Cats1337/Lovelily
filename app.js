const FALLBACK_CHECKOUT_MODE = "payment_links"; // "payment_links" or "server_checkout"
const CHECKOUT_SESSION_API = "/api/create-checkout-session";

// Demo gallery
const galleryItems = [
  { id: "g1", title: "Lily and Meadow", tag: "bouquet", img: "https://images.unsplash.com/photo-1534885320675-b08aa131cc5e?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Njd8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400", alt: "Bouquet with lilies and meadow florals" },
  { id: "g2", title: "Wedding Aisle Florals", tag: "wedding", img: "https://images.unsplash.com/photo-1490750967868-88aa4486c946?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjZ8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400", alt: "Wedding aisle flowers" },
  { id: "g3", title: "Table Centerpiece", tag: "centerpiece", img: "https://images.unsplash.com/photo-1442458017215-285b83f65851?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzV8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400", alt: "Centerpiece with soft tones" },
  { id: "g4", title: "Summer Brights", tag: "bouquet", img: "https://images.unsplash.com/photo-1610397648930-477b8c7f0943?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzl8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400", alt: "Bright summer bouquet" },
  { id: "g5", title: "Bridal Cascade", tag: "wedding", img: "https://images.unsplash.com/photo-1584284621485-c955b915f5cb?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDN8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400", alt: "Bridal bouquet cascade" },
  { id: "g6", title: "Soft Pastel Centerpiece", tag: "centerpiece", img: "https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1600&auto=format&fit=crop", alt: "Pastel centerpiece arrangement" }
];

// Demo products
const products = [
  {
    id: "p1",
    name: "Lovelily Signature Bouquet",
    price: 8500,
    img: "https://plus.unsplash.com/premium_photo-1676478746990-4ef5c8ef234a?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Zmxvd2VyfGVufDB8fDB8fHww&auto=format&fit=crop&q=60&w=400",
    desc: "Seasonal hand-tied bouquet with lilies and garden blooms",
    paymentLink: "#" // replace with Stripe Payment Link
    // stripe_price_id: "price_123"
  },
  {
    id: "p2",
    name: "Classic Lily Arrangement",
    price: 6500,
    img: "https://images.unsplash.com/photo-1538998073820-4dfa76300194?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Zmxvd2VyfGVufDB8fDB8fHww&auto=format&fit=crop&q=60&w=400",
    desc: "Elegant vase arrangement of lilies and greens",
    paymentLink: "#"
  },
  {
    id: "p3",
    name: "Custom Bouquet Voucher",
    price: 12000,
    img: "https://images.unsplash.com/photo-1516205651411-aef33a44f7c2?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8Zmxvd2VyfGVufDB8fDB8fHww&auto=format&fit=crop&q=60&w=400",
    desc: "Gift a custom bouquet. Redeem by email or in studio",
    paymentLink: "#"
  }
];

// Demo classes
const classes = [
  {
    id: "c1",
    title: "Bouquet Basics",
    date: "Nov 16, 10:00 AM",
    img: "https://plus.unsplash.com/premium_photo-1676475964992-6404b8db0b53?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400",
    where: "Lovelily Studio",
    seats: 10,
    bookUrl: "#"
  },
  {
    id: "c2",
    title: "Centerpiece Workshop",
    date: "Dec 7, 1:00 PM",
    img: "https://plus.unsplash.com/premium_photo-1677094766116-aa0f8742d36b?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fGZsb3dlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=400",
    where: "Lovelily Studio",
    seats: 8,
    bookUrl: "#"
  }
];

// DOM helpers
const $ = (sel, root=document) => root.querySelector(sel);
const $$ = (sel, root=document) => Array.from(root.querySelectorAll(sel));

$("#year").textContent = new Date().getFullYear();

// Gallery
const galleryGrid = $("#galleryGrid");
function renderGallery(items){
  galleryGrid.innerHTML = "";
  items.forEach(it=>{
    const card = document.createElement("article");
    card.className = "card product";
    card.innerHTML = `
      <figure class="cyanotype gallery-item"><img src="${it.img}" alt="${it.alt}"></figure>
      <div class="pad">
        <strong>${it.title}</strong>
        <p class="muted" style="margin:4px 0 0;text-transform:capitalize">${it.tag}</p>
      </div>
    `;
    card.addEventListener("click", ()=>openLightbox(it.img, it.title));
    galleryGrid.appendChild(card);
  });
}
renderGallery(galleryItems);

$$(".chip").forEach(btn=>{
  btn.addEventListener("click", ()=>{
    $$(".chip").forEach(b=>b.classList.remove("is-active"));
    btn.classList.add("is-active");
    const tag = btn.dataset.filter;
    if(tag === "all") renderGallery(galleryItems);
    else renderGallery(galleryItems.filter(g=>g.tag === tag));
  });
});

// Lightbox
const lightbox = $("#lightbox");
function openLightbox(src, caption){
  $("#lightboxImg").src = src;
  $("#lightboxCaption").textContent = caption || "";
  lightbox.classList.add("open");
  lightbox.setAttribute("aria-hidden","false");
}
$(".lb-close").addEventListener("click", ()=>{
  lightbox.classList.remove("open");
  lightbox.setAttribute("aria-hidden","true");
});
lightbox.addEventListener("click", e=>{
  if(e.target === lightbox) lightbox.classList.remove("open");
});

// Shop
const productGrid = $("#productGrid");
function money(c){ return `$${(c/100).toFixed(2)}` }
function renderProducts(){
  productGrid.innerHTML = "";
  products.forEach(p=>{
    const el = document.createElement("article");
    el.className = "card product";
    el.innerHTML = `
      <figure class="cyanotype"><img src="${p.img}" alt="${p.name}"></figure>
      <div class="pad">
        <div class="meta">
          <h3 style="margin:0">${p.name}</h3>
          <span class="price">${money(p.price)}</span>
        </div>
        <p class="muted" style="margin:6px 0 10px">${p.desc}</p>
        <div class="meta">
          <button class="btn small add" data-id="${p.id}">Add to cart</button>
          <a href="${p.paymentLink}" class="btn small alt" target="_blank" rel="noopener">Buy now</a>
        </div>
      </div>
    `;
    el.querySelector(".add").addEventListener("click", ()=>addToCart(p.id, 1));
    productGrid.appendChild(el);
  });
}
renderProducts();

// Classes
const classGrid = $("#classGrid");
function renderClasses(){
  classGrid.innerHTML = "";
  classes.forEach(c=>{
    const el = document.createElement("article");
    el.className = "card class-card";
    el.innerHTML = `
      <figure class="cyanotype"><img src="${c.img}" alt="${c.title}"></figure>
      <div class="pad">
        <div class="meta">
          <h3 style="margin:0">${c.title}</h3>
          <span class="muted">${c.date}</span>
        </div>
        <p class="muted">${c.where} • ${c.seats} seats</p>
        <div style="margin-top:8px;display:flex;gap:8px">
          <a class="btn small" href="${c.bookUrl}" target="_blank" rel="noopener">Book seat</a>
        </div>
      </div>
    `;
    classGrid.appendChild(el);
  });
}
renderClasses();

// Cart
const cartKey = "lovelily_cart_v1";
function loadCart(){ try { return JSON.parse(localStorage.getItem(cartKey) || "[]"); } catch { return [] } }
function saveCart(items){ localStorage.setItem(cartKey, JSON.stringify(items)); updateCartUI() }

function addToCart(id, qty){
  const cart = loadCart();
  const found = cart.find(i=>i.id === id);
  if(found) found.qty += qty;
  else cart.push({ id, qty });
  saveCart(cart);
}

function removeFromCart(id){
  saveCart(loadCart().filter(i=>i.id !== id));
}

function setQty(id, qty){
  const cart = loadCart();
  const item = cart.find(i=>i.id === id);
  if(!item) return;
  item.qty = Math.max(1, qty|0);
  saveCart(cart);
}

function cartTotals(){
  const cart = loadCart();
  let subtotal = 0;
  const rows = cart.map(i=>{
    const p = products.find(x=>x.id === i.id);
    const line = p ? p.price * i.qty : 0;
    subtotal += line;
    return { ...i, ...p, line };
  });
  return { rows, subtotal };
}

const cartDrawer = $("#cartDrawer");
$("#cartButton").addEventListener("click", ()=>{
  cartDrawer.classList.add("open");
  cartDrawer.setAttribute("aria-hidden","false");
  renderCart();
});
$("#closeCart").addEventListener("click", ()=>{
  cartDrawer.classList.remove("open");
  cartDrawer.setAttribute("aria-hidden","true");
});

function renderCart(){
  const { rows, subtotal } = cartTotals();
  const list = $("#cartItems");
  list.innerHTML = "";
  rows.forEach(r=>{
    const li = document.createElement("div");
    li.className = "cart-item";
    li.innerHTML = `
      <img src="${r.img}" alt="${r.name}">
      <div>
        <div class="name">${r.name}</div>
        <div class="muted">${money(r.price)} each</div>
      </div>
      <div class="act">
        <div class="qty">
          <button aria-label="Decrease" data-act="dec" data-id="${r.id}">−</button>
          <input type="text" value="${r.qty}" inputmode="numeric" data-id="${r.id}">
          <button aria-label="Increase" data-act="inc" data-id="${r.id}">+</button>
        </div>
        <button class="icon-btn" data-act="del" data-id="${r.id}">Remove</button>
      </div>
    `;
    list.appendChild(li);
  });
  $("#cartSubtotal").textContent = money(subtotal);

  list.addEventListener("click", e=>{
    const id = e.target.getAttribute("data-id");
    const act = e.target.getAttribute("data-act");
    if(!id || !act) return;
    if(act === "del") removeFromCart(id);
    if(act === "dec") setQty(id, (loadCart().find(i=>i.id===id)?.qty || 1) - 1);
    if(act === "inc") setQty(id, (loadCart().find(i=>i.id===id)?.qty || 1) + 1);
    renderCart();
  }, { once:true });

  list.addEventListener("input", e=>{
    const id = e.target.getAttribute("data-id");
    if(!id) return;
    const v = parseInt(e.target.value.replace(/\D/g,"") || "1", 10);
    setQty(id, v);
    renderCart();
  }, { once:true });
}

function updateCartUI(){
  const count = loadCart().reduce((n,i)=>n+i.qty,0);
  $("#cartCount").textContent = String(count);
}
updateCartUI();

// Checkout
$("#checkoutBtn").addEventListener("click", async ()=>{
  const items = cartTotals().rows.map(r=>({
    id: r.id,
    qty: r.qty,
    paymentLink: r.paymentLink
    // stripe_price_id: r.stripe_price_id
  }));
  if(items.length === 0){ alert("Your cart is empty."); return }

  if(FALLBACK_CHECKOUT_MODE === "payment_links"){
    const link = items[0].paymentLink && items[0].paymentLink !== "#" ? items[0].paymentLink : null;
    if(!link){
      alert("Add Stripe Payment Link URLs to products for quick checkout. Or switch to server_checkout.");
      return;
    }
    window.open(link, "_blank", "noopener");
    return;
  }

  try{
    const res = await fetch(CHECKOUT_SESSION_API, {
      method:"POST",
      headers:{ "Content-Type":"application/json" },
      body: JSON.stringify({
        cart: items.map(i=>({ price: i.stripe_price_id, quantity: i.qty })),
        metadata: { source: "lovelily-blooms" }
      })
    });
    const data = await res.json();
    if(data.url) window.location = data.url;
    else alert("Checkout error. Configure your server endpoint.");
  }catch(err){
    console.error(err);
    alert("Could not start checkout.");
  }
});

// Contact form demo
$("#contactForm").addEventListener("submit", e=>{
  e.preventDefault();
  const name = $("#name").value.trim();
  const email = $("#email").value.trim();
  const message = $("#message").value.trim();

  let ok = true;
  $('[data-for="name"]').textContent = name ? "" : "Please enter your name";
  $('[data-for="email"]').textContent = /\S+@\S+\.\S+/.test(email) ? "" : "Enter a valid email";
  $('[data-for="message"]').textContent = message ? "" : "Please write a message";
  ok = name && /\S+@\S+\.\S+/.test(email) && message;

  if(!ok) return;
  $("#contactFeedback").textContent = "Thanks. Your message has been recorded.";
  e.target.reset();
});
