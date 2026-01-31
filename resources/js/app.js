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
   SIMPLE SELECT2-LIKE (VANILLA) - UPDATED
================================ */

function initSelect2Like() {
  document.querySelectorAll('select.select2[multiple]').forEach(select => {
    if (select.dataset.enhanced) return;
    select.dataset.enhanced = '1';

    select.style.display = 'none';

    const wrapper = document.createElement('div');
    wrapper.className = 'relative mt-2';

    // Top control (tags + input + chevron)
    const control = document.createElement('div');
    control.className =
      'min-h-[44px] w-full rounded-md border border-white/10 bg-slate-950/40 px-2 py-2 flex flex-wrap gap-1.5 items-center text-white';

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = select.options[0]?.text || 'Please Select';
    input.className =
      'flex-1 min-w-[120px] bg-transparent outline-none text-sm placeholder:text-slate-500';

    const chevron = document.createElement('button');
    chevron.type = 'button';
    chevron.className =
      'ml-auto shrink-0 px-2 py-1 rounded hover:bg-white/10 transition-colors';
    chevron.innerHTML = '▼';

    // Dropdown (ALWAYS in DOM, never hidden by outside click)
    const dropdown = document.createElement('div');
    dropdown.className =
      'mt-1 max-h-56 overflow-auto rounded-md border border-white/10 bg-slate-950 shadow-lg z-50';

    wrapper.appendChild(control);
    control.appendChild(input);
    control.appendChild(chevron);
    wrapper.appendChild(dropdown);

    select.parentNode.insertBefore(wrapper, select.nextSibling);

    const options = Array.from(select.options)
      .filter(o => o.value !== '')
      .map(o => ({ value: o.value, label: o.text }));

    let isOpen = true; // dropdown initially open

    function selectedSet() {
      return new Set(Array.from(select.selectedOptions).map(o => o.value));
    }

    function updatePlaceholder() {
      input.placeholder = select.selectedOptions.length ? '' : (select.options[0]?.text || 'Please Select');
    }

    function updateChevron() {
      chevron.innerHTML = isOpen ? '▲' : '▼';
    }

    function toggleDropdown() {
      isOpen = !isOpen;
      dropdown.style.display = isOpen ? 'block' : 'none';
      updateChevron();
      if (isOpen) refreshDropdown(input.value);
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
            'w-full px-3 py-2 text-sm text-left flex items-center justify-between ' +
            'hover:bg-white/10 transition-colors duration-150';

          item.innerHTML = `
            <span class="truncate">${o.label}</span>
            <span class="ml-3 text-xs ${isSelected ? 'opacity-100' : 'opacity-30'}">✓</span>
          `;

          dropdown.appendChild(item);
        });
    }

    function renderTags() {
      control.querySelectorAll('.tag').forEach(t => t.remove());

      Array.from(select.selectedOptions).forEach(o => {
        const tag = document.createElement('span');
        tag.className =
          'tag inline-flex items-center gap-1 rounded-full bg-white/10 px-2 py-0.5 text-[11px] leading-5 ' +
          'border border-white/10';

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
          refreshDropdown(input.value);
        };

        // input এর আগে বসবে (compact pills)
        control.insertBefore(tag, input);
      });
    }

    // typing filter
    input.addEventListener('input', () => {
      if (isOpen) refreshDropdown(input.value);
    });

    // backspace remove last
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value === '') {
        const last = select.selectedOptions[select.selectedOptions.length - 1];
        if (last) {
          last.selected = false;
          select.dispatchEvent(new Event('change', { bubbles: true }));
          renderTags();
          updatePlaceholder();
          refreshDropdown('');
        }
      }
    });

    // click on dropdown => toggle select/unselect (✓ changes, tag add/remove)
    dropdown.addEventListener('click', (e) => {
      const btn = e.target.closest('button[data-value]');
      if (!btn) return;

      const value = btn.dataset.value;
      const opt = select.querySelector(`option[value="${CSS.escape(value)}"]`);
      if (!opt) return;

      opt.selected = !opt.selected; // toggle
      select.dispatchEvent(new Event('change', { bubbles: true }));

      renderTags();
      updatePlaceholder();
      refreshDropdown(input.value);
      input.focus();
    });

    // chevron click => open/close icon change + dropdown show/hide
    chevron.addEventListener('click', (e) => {
      e.preventDefault();
      toggleDropdown();
    });

    // control click => focus + open
    control.addEventListener('click', (e) => {
      // tag এর close (×) এ ক্লিক করলে open/close toggle হবে না
      if (e.target.closest('.tag')) return;
      input.focus();
      if (!isOpen) toggleDropdown();
    });

    // init
    dropdown.style.display = 'block';
    updateChevron();
    renderTags();
    updatePlaceholder();
    refreshDropdown('');
  });
}

document.addEventListener('DOMContentLoaded', initSelect2Like);
