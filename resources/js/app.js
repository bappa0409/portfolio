// app.js
import './bootstrap';

window.sidebarCollapse = function ({ defaultOpen = false } = {}) {
  return {
    open: defaultOpen,
    toggle() { this.open = !this.open; }
  };
};

window.sidebarDropdownMenu = function () {
  return {
    open: false,
    toggle() { this.open = !this.open; },
    close() { this.open = false; }
  };
};


/* ===============================
   SIMPLE SELECT2-LIKE (VANILLA) - FINAL FIX
================================ */

// track currently opened dropdown instance (one at a time)
let __select2LikeOpen = null;

// one-time global outside click handler (capture makes it reliable)
if (!window.__select2LikeOutsideBound) {
  window.__select2LikeOutsideBound = true;

  document.addEventListener(
    'pointerdown',
    (e) => {
      if (!__select2LikeOpen) return;

      const { wrapper, close } = __select2LikeOpen;

      // যদি wrapper এর বাইরে ক্লিক হয় => close
      if (!wrapper.contains(e.target)) {
        close();
        __select2LikeOpen = null;
      }
    },
    true // capture
  );
}

function initSelect2Like() {
  document.querySelectorAll('select.select2[multiple]').forEach(select => {
    if (select.dataset.enhanced) return;
    select.dataset.enhanced = '1';

    // hide native select
    select.style.display = 'none';

    const wrapper = document.createElement('div');
    wrapper.className = 'relative mt-2 overflow-visible';

    const control = document.createElement('div');
    control.className =
      'min-h-[44px] w-full rounded-md border border-white/10 bg-slate-950/40 px-2 py-2 flex flex-wrap gap-1.5 items-center text-white';

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Select Option';
      input.className =
  'select-input flex-1 min-w-[120px] bg-slate-950/40 outline-none border-0 p-0 m-0 text-sm placeholder:text-slate-500 shadow-none focus:outline-none focus:ring-0';


    const chevron = document.createElement('button');
    chevron.type = 'button';
    chevron.className =
      'ml-auto shrink-0 px-2 py-1 rounded hover:bg-[#4b6859a8] transition-colors';
  

    const chevronDownSvg = `
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="#6ee7b7" stroke-width="2" class="w-4 h-4">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
    `;

    const chevronUpSvg = `
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="#6ee7b7" stroke-width="2" class="w-4 h-4 rotate-180">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
    `;

    chevron.innerHTML = chevronDownSvg;

    const dropdown = document.createElement('div');
    dropdown.className =
  'absolute left-0 top-full mt-1 w-full max-h-56 overflow-auto rounded-md border border-white/10 bg-slate-950 shadow-lg z-[9999]';

    wrapper.appendChild(control);
    control.appendChild(input);
    control.appendChild(chevron);
    wrapper.appendChild(dropdown);

    select.parentNode.insertBefore(wrapper, select.nextSibling);

    const options = Array.from(select.options)
      .filter(o => o.value !== '')
      .map(o => ({ value: o.value, label: o.text }));

    let isOpen = false;

    function selectedSet() {
      return new Set(Array.from(select.selectedOptions).map(o => o.value));
    }

    function updatePlaceholder() {
  const realSelectedCount = select.selectedOptions.length;

  input.placeholder = realSelectedCount === 0
    ? 'Select Option'
    : '';
}

    function updateChevron() {
  chevron.innerHTML = isOpen ? chevronUpSvg : chevronDownSvg;
}

    function refreshDropdown(filter = '') {
      dropdown.innerHTML = '';
      const sel = selectedSet();
      const q = filter.trim().toLowerCase();

      options
        .filter(o => o.label.toLowerCase().includes(q))
        .forEach(o => {
          const isSelected = sel.has(o.value);

          const item = document.createElement('button');
          item.type = 'button';
          item.dataset.value = o.value;

          item.className =
            'group w-full px-3 py-2 text-sm text-left flex items-center justify-between ' +
            'hover:bg-white/10 transition-colors duration-150';

          const checkClass = isSelected
            ? 'opacity-100'
            : 'opacity-0 group-hover:opacity-60';

          item.innerHTML = `
            <span class="truncate">${o.label}</span>
            <span class="ml-3 text-xs transition-opacity ${checkClass}">✓</span>
          `;

          dropdown.appendChild(item);
        });
    }

    function renderTags() {
  control.querySelectorAll('.tag').forEach(t => t.remove());

  Array.from(select.selectedOptions).forEach(o => {
    const tag = document.createElement('span');
    tag.className =
      'tag inline-flex items-center gap-1 rounded-full bg-white/10 px-2 py-0.5 text-[11px] leading-5 border border-white/10';

    tag.innerHTML = `
      <span class="max-w-[160px] truncate">${o.text}</span>
      <span class="cursor-pointer text-slate-300 hover:text-white transition-colors">×</span>
    `;

    tag.querySelector('span:last-child').onclick = (e) => {
      e.stopPropagation();
      o.selected = false;
      select.dispatchEvent(new Event('change', { bubbles: true }));
      renderTags();
      updatePlaceholder();
      if (isOpen) refreshDropdown(input.value);
    };

    control.insertBefore(tag, input);
  });
}


    function openDropdown() {
      // close previously open instance (if any)
      if (__select2LikeOpen && __select2LikeOpen.wrapper !== wrapper) {
        __select2LikeOpen.close();
      }

      isOpen = true;
      dropdown.style.display = 'block';
      updateChevron();
      refreshDropdown(input.value);

      __select2LikeOpen = { wrapper, close: closeDropdown };
    }

    function closeDropdown() {
      isOpen = false;
      dropdown.style.display = 'none';
      updateChevron();

      if (__select2LikeOpen && __select2LikeOpen.wrapper === wrapper) {
        __select2LikeOpen = null;
      }
    }

    function toggleDropdown() {
      isOpen ? closeDropdown() : openDropdown();
    }

    /* ---------- EVENTS ---------- */

    // prevent inside clicks from being treated as outside (extra safety)
    wrapper.addEventListener('pointerdown', (e) => e.stopPropagation());

    input.addEventListener('input', () => {
      if (isOpen) refreshDropdown(input.value);
    });

    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value === '') {
        const last = select.selectedOptions[select.selectedOptions.length - 1];
        if (last) {
          last.selected = false;
          select.dispatchEvent(new Event('change', { bubbles: true }));
          renderTags();
          updatePlaceholder();
          if (isOpen) refreshDropdown(input.value);
        }
      }
    });

    // ✅ select/unselect but DO NOT close
    dropdown.addEventListener('click', (e) => {
      const btn = e.target.closest('button[data-value]');
      if (!btn) return;

      const value = btn.dataset.value;
      const opt = select.querySelector(`option[value="${CSS.escape(value)}"]`);
      if (!opt) return;

      opt.selected = !opt.selected;
      select.dispatchEvent(new Event('change', { bubbles: true }));

      renderTags();
      updatePlaceholder();
      refreshDropdown(input.value);

      // keep open
      input.focus();
      openDropdown();
    });

    chevron.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleDropdown();
    });

    control.addEventListener('click', (e) => {
  if (e.target.closest('.tag')) return;
  if (e.target === chevron || chevron.contains(e.target)) return; // ⭐ extra safety
  input.focus();
  if (!isOpen) openDropdown();
});

    /* ---------- INIT ---------- */
    dropdown.style.display = 'none';
    updateChevron();
    renderTags();
    updatePlaceholder();
    refreshDropdown('');
  });
}

document.addEventListener('DOMContentLoaded', initSelect2Like);
