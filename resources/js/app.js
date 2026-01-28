// app.js
import './bootstrap';

window.sidebarCollapse = function ({ defaultOpen = false } = {}) {
  return { open: defaultOpen, toggle() { this.open = !this.open } }
}

window.sidebarDropdownMenu = function () {
  return { open: false, toggle() { this.open = !this.open }, close() { this.open = false } }
}

// ---- Cyber Select (Auto Init + Observer) ----
function makeCyberSelect(select) {
  if (!select || select.dataset.cybered === '1') return;
  select.dataset.cybered = '1';

  const placeholder = select.dataset.placeholder || 'Choose...';
  const name = select.getAttribute('name') || '';
  const value = select.value || '';

  const wrap = document.createElement('div');
  wrap.className = 'relative';
  wrap.style.setProperty('--button-width', '100%');

  const hidden = document.createElement('input');
  hidden.type = 'hidden';
  hidden.name = name;
  hidden.value = value;

  select.removeAttribute('name');
  select.classList.add('hidden');

  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className =
    'mt-2 grid w-full cursor-default grid-cols-1 rounded-md ' +
    'border border-white/10 bg-slate-950/40 ' +
    'py-2 pr-2 pl-3 text-left text-white ' +
    'outline-1 -outline-offset-1 outline-white/10 ' +
    'hover:border-emerald-400/25 transition ' +
    'focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-emerald-400/40';

  const label = document.createElement('span');
  label.className = 'col-start-1 row-start-1 flex items-center gap-3 pr-10';
  const labelText = document.createElement('span');
  labelText.className = 'block truncate font-mono text-sm text-slate-200';
  labelText.textContent = placeholder;
  label.appendChild(labelText);

  const chevron = document.createElement('span');
  chevron.className = 'col-start-1 row-start-1 self-center justify-self-end pr-3 text-slate-400';
  chevron.innerHTML = `
    <svg viewBox="0 0 16 16" fill="currentColor" class="size-4">
      <path d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"/>
    </svg>
  `;

  btn.appendChild(label);
  btn.appendChild(chevron);

  const menu = document.createElement('div');
  menu.className =
    'hidden absolute z-30 mt-2 w-full max-h-56 overflow-auto rounded-md ' +
    'border border-white/10 bg-slate-950/95 py-1 text-sm ' +
    'outline-1 -outline-offset-1 outline-white/10 glass cyber-glow';

  const scan = document.createElement('div');
  scan.className = 'absolute inset-0 scanline opacity-20 pointer-events-none rounded-md';
  menu.appendChild(scan);

  const optionEls = Array.from(select.querySelectorAll('option'));
  const items = [];

  optionEls.forEach((opt) => {
    const v = opt.value;
    const t = opt.textContent.trim();

    if (v === '' || opt.disabled) return;

    const item = document.createElement('button');
    item.type = 'button';
    item.className =
  'relative block w-full cursor-default select-none py-2 pr-9 pl-3 text-left ' +
  'bg-slate-950 text-slate-200 ' +
  'hover:bg-blue-600 hover:text-white ' +
  'focus:bg-blue-600 focus:text-white focus:outline-none transition';



    
    item.dataset.value = v;

    item.innerHTML = `
      <div class="flex items-center justify-between gap-3">
        <span class="block truncate font-mono">${t}</span>
        <span class="hidden items-center text-emerald-300" data-check>
          <svg viewBox="0 0 20 20" fill="currentColor" class="size-4">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"/>
          </svg>
        </span>
      </div>
    `;

    items.push(item);
    menu.appendChild(item);
  });

  const paint = (val) => {
    const match = optionEls.find(o => o.value === val);
    if (match && val !== '') {
      labelText.textContent = match.textContent.trim();
      labelText.classList.remove('text-slate-200');
      labelText.classList.add('text-white');
    } else {
      labelText.textContent = placeholder;
      labelText.classList.remove('text-white');
      labelText.classList.add('text-slate-200');
    }

    items.forEach((it) => {
  const isSel = it.dataset.value === val;

  const check = it.querySelector('[data-check]');
  if (check) check.classList.toggle('hidden', !isSel);

  // selected state (solid bg + ring)
it.classList.toggle('bg-slate-800', isSel);
it.classList.toggle('text-emerald-100', isSel);
it.classList.toggle('ring-1', isSel);
it.classList.toggle('ring-emerald-400/30', isSel);
});
  };

  const close = () => menu.classList.add('hidden');
  const toggle = () => menu.classList.toggle('hidden');

  btn.addEventListener('click', toggle);

  menu.addEventListener('click', (e) => {
    const item = e.target.closest('[data-value]');
    if (!item) return;

    const val = item.dataset.value;
    hidden.value = val;
    select.value = val;
    paint(val);
    close();
    select.dispatchEvent(new Event('change', { bubbles: true }));
  });

  document.addEventListener('click', (e) => {
    if (!wrap.contains(e.target)) close();
  });

  // mount
  select.parentNode.insertBefore(wrap, select);
  wrap.appendChild(hidden);
  wrap.appendChild(btn);
  wrap.appendChild(menu);
  wrap.appendChild(select);

  paint(hidden.value || select.value || '');
}

function initCyberSelects(root = document) {
  root.querySelectorAll('select.js-cyber-select').forEach(makeCyberSelect);
}

// Run on initial load
document.addEventListener('DOMContentLoaded', () => initCyberSelects());

// Run again after full page load (extra safe)
window.addEventListener('load', () => initCyberSelects());

// If your site uses Turbo/Inertia/AJAX navigation, this helps too:
document.addEventListener('turbo:load', () => initCyberSelects());

// Auto-detect if selects are added later
const observer = new MutationObserver((mutations) => {
  for (const m of mutations) {
    for (const node of m.addedNodes) {
      if (!(node instanceof HTMLElement)) continue;
      if (node.matches?.('select.js-cyber-select')) makeCyberSelect(node);
      node.querySelectorAll?.('select.js-cyber-select').forEach(makeCyberSelect);
    }
  }
});
observer.observe(document.documentElement, { childList: true, subtree: true });
