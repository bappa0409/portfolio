// app.js
import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

import '@tailwindplus/elements'
import Toastify from 'toastify-js'
import 'toastify-js/src/toastify.css'

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

// ---- Toastify helper
window.Toastify = Toastify 
window.toast = (type, message) => {
  const isSuccess = type === 'success'

  Toastify({
    text: `
      <div style="display:flex;align-items:baseline;gap:6px;">
        <span style="font-size:15px;">
          ${isSuccess ? '✔️' : '⚠️'}
        </span>
        <span>${message}</span>
      </div>
    `,
    duration: 5000,
    gravity: "bottom",
    position: "right",
    close: false,
    stopOnFocus: true,
    escapeMarkup: false,
    style: {
      background: isSuccess ? '#16a34a' : '#dc2626',
      color: '#ffffff',
      borderRadius: '0.375rem',
      fontSize: '14px',
    },
  }).showToast()
}

// ==================================================
// ✅ GLOBAL REUSABLE TAG INPUT (Alpine)
// ==================================================
window.tagInput = function ({
  initial = [],
  namePrefix = 'tags',
  placeholder = 'Write here..',
  trim = true,
  lowercase = false,
  unique = true,
} = {}) {
  return {
    // --- STATE ---
    tags: Array.isArray(initial) ? [...initial].filter(v => v !== null && v !== undefined && v !== '') : [],
    q: '',
    namePrefix,
    placeholder,
    error: '',

    // --- HELPERS ---
    normalize(v) {
      let s = String(v ?? '');
      if (trim) s = s.trim();
      if (lowercase) s = s.toLowerCase();
      return s;
    },

    // --- ACTIONS ---
    add() {
      const t = this.normalize(this.q);

      // empty
      if (!t) {
        this.q = '';
        this.error = '';
        return;
      }

      // unique
      if (unique && this.tags.includes(t)) {
        this.error = 'This tag already exists.';
        this.q = '';
        return;
      }

      this.tags.push(t);
      this.q = '';
      this.error = '';

      this.$nextTick(() => this.$refs?.input?.focus());
    },

    remove(i) {
      if (i < 0 || i >= this.tags.length) return;
      this.tags.splice(i, 1);
      this.error = '';
      this.$nextTick(() => this.$refs?.input?.focus());
    },
  };
};

// ==================================================
// ✅ GLOBAL IMAGE UPLOAD (preview + drag/drop)
// ==================================================
function initImageUploads() {
  document.querySelectorAll('.js-image-upload').forEach((root) => {
    if (root.dataset.bound === '1') return; // prevent double bind
    root.dataset.bound = '1';

    const input = root.querySelector('input[type="file"]');
    if (!input) return;

    const previewSel = root.getAttribute('data-preview');
    if (!previewSel) return;

    const prev = document.querySelector(previewSel);
    const img = prev?.querySelector('[data-preview-img]');
    const cap = prev?.querySelector('[data-preview-cap]');

    const setActive = (on) => {
      root.classList.toggle('border-emerald-400/50', on);
      root.classList.toggle('bg-emerald-400/5', on);
    };

    ['dragenter', 'dragover'].forEach((evt) => {
      root.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        setActive(true);
      });
    });

    ['dragleave', 'drop'].forEach((evt) => {
      root.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        setActive(false);
      });
    });

    root.addEventListener('drop', (e) => {
      const files = Array.from(e.dataTransfer?.files || []).filter((f) =>
        f.type.startsWith('image/')
      );
      if (!files.length) return;

      const dt = new DataTransfer();
      dt.items.add(files[0]);
      input.files = dt.files;
      input.dispatchEvent(new Event('change', { bubbles: true }));
    });

    input.addEventListener('change', () => {
      const file = input.files?.[0];
      if (!file || !file.type.startsWith('image/')) {
        prev?.classList.add('hidden');
        return;
      }

      if (img) img.src = URL.createObjectURL(file);
      if (cap) cap.textContent = file.name;

      prev?.classList.remove('hidden');
    });
  });
}

// global expose (optional)
window.initImageUploads = initImageUploads;
document.addEventListener('DOMContentLoaded', initImageUploads);


Alpine.start()

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
      'select2-like-control min-h-[44px] w-full rounded-md border border-white/10 bg-slate-950/40 px-2 py-2 flex flex-wrap gap-1.5 items-center text-white';

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


/* ===============================
   VALIDATION (GLOBAL)
================================ */
(function () {
  const SELECTOR_INVALID = 'input:invalid, select:invalid, textarea:invalid';
  const SELECTOR_FIELD   = 'input, select, textarea';

  function isJquerySelect2(selectEl) {
    return !!(window.jQuery &&
      selectEl &&
      selectEl.tagName === 'SELECT' &&
      window.jQuery(selectEl).hasClass('select2-hidden-accessible'));
  }

  // ✅ your vanilla select2-like
  function isSelect2Like(selectEl) {
    return !!(
      selectEl &&
      selectEl.tagName === 'SELECT' &&
      selectEl.classList.contains('select2') &&
      selectEl.multiple &&
      selectEl.dataset.enhanced === '1'
    );
  }

  // 🔥 IMPORTANT: আপনার initSelect2Like() এ control এ একটা class দিন:
  // control.className = 'select2-like-control ...'
  function getSelect2LikeControl(selectEl) {
    const wrapper = selectEl?.nextElementSibling;
    if (!wrapper) return null;
    return wrapper.querySelector('.select2-like-control');
  }

  function markOne(el, force = false) {
    if (!el) return;

    const form = el.form;
    const touched = el.dataset.touched === '1';
    const submitted = !!form?.dataset.submitted;

    // ✅ force = submit time (mark all)
    // ✅ otherwise: only mark if touched or submitted
    const shouldValidateNow = force || touched || submitted;

    // ignore disabled fields
    if (el.disabled) return;

    if (!shouldValidateNow) return;

    if (!el.checkValidity()) {
      el.classList.add('is-invalid');

      // jQuery select2
      if (isJquerySelect2(el)) {
        const $sel = window.jQuery(el);
        $sel.next('.select2-container').find('.select2-selection').addClass('is-invalid');
      }

      // select2-like
      if (isSelect2Like(el)) {
        const control = getSelect2LikeControl(el);
        control?.classList.add('is-invalid');
      }
    } else {
      el.classList.remove('is-invalid');

      // jQuery select2
      if (isJquerySelect2(el)) {
        const $sel = window.jQuery(el);
        $sel.next('.select2-container').find('.select2-selection').removeClass('is-invalid');
      }

      // select2-like
      if (isSelect2Like(el)) {
        const control = getSelect2LikeControl(el);
        control?.classList.remove('is-invalid');
      }
    }
  }

  function clearInvalid(form) {
    if (!form) return;

    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.select2-selection.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.select2-like-control.is-invalid').forEach(el => el.classList.remove('is-invalid'));
  }

  function markInvalid(form) {
    if (!form) return null;

    const invalids = form.querySelectorAll(SELECTOR_INVALID);
    invalids.forEach(el => markOne(el, true));
    return invalids[0] || null;
  }

  function attachLiveCleanup(form) {
    if (!form || form.__invalidBound) return;
    form.__invalidBound = true;

    // user typed/changed => live validate (touched/submitted হলে)
    form.addEventListener('input', (e) => {
      const el = e.target;
      if (!(el instanceof HTMLElement)) return;
      if (!el.matches(SELECTOR_FIELD)) return;
      markOne(el, false);
    }, true);

    form.addEventListener('change', (e) => {
      const el = e.target;
      if (!(el instanceof HTMLElement)) return;
      if (!el.matches(SELECTOR_FIELD)) return;
      markOne(el, false);
    }, true);

    // blur => touched = true => এরপর থেকে live validate হবে
    form.addEventListener('blur', (e) => {
      const el = e.target;
      if (!(el instanceof HTMLElement)) return;
      if (!el.matches(SELECTOR_FIELD)) return;
      el.dataset.touched = '1';
      markOne(el, false);
    }, true);

    // jQuery select2 events
    if (window.jQuery) {
      window.jQuery(form).on('select2:select select2:unselect', 'select', function () {
        this.dataset.touched = '1';
        markOne(this, false);
      });
    }
  }

  function handleInvalidSubmit(e) {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;

    attachLiveCleanup(form);
    form.dataset.submitted = '1';

    clearInvalid(form);
    const firstInvalid = markInvalid(form);

    if (!form.checkValidity()) {
      form.reportValidity();

      const label =
        firstInvalid?.closest('div')?.querySelector('label')?.innerText?.trim() || 'This field';

      window.dispatchEvent(new CustomEvent('global-form-invalid', {
        detail: { message: `${label} is required.` }
      }));
    }
  }

  // invalid event (mainly submit time)
  document.addEventListener('invalid', function (e) {
    const el = e.target;
    const form = el?.form;
    if (!form) return;

    attachLiveCleanup(form);
    form.dataset.submitted = '1';
    markOne(el, true);
  }, true);

  // submit attempt -> mark all invalid
  document.addEventListener('submit', function (e) {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;

    attachLiveCleanup(form);

    if (!form.checkValidity()) {
      e.preventDefault();
      handleInvalidSubmit(e);
    }
  }, true);

  // helper for AJAX/Alpine submit (@submit.prevent)
  window.validateFormAndMark = function (formElOrId) {
    const form = typeof formElOrId === 'string'
      ? document.getElementById(formElOrId)
      : formElOrId;

    if (!form) return true;

    attachLiveCleanup(form);
    form.dataset.submitted = '1';

    clearInvalid(form);

    if (!form.checkValidity()) {
      const firstInvalid = markInvalid(form);
      form.reportValidity();

      const label =
        firstInvalid?.closest('div')?.querySelector('label')?.innerText?.trim() || 'This field';

      window.dispatchEvent(new CustomEvent('global-form-invalid', {
        detail: { message: `${label} is required.` }
      }));

      return false;
    }
    return true;
  };
})();
