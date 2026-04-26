/**
 * App UI Kit (CodeCanyon Ready)
 * Laravel + Alpine Utilities
 * Dependencies: Alpine.js, Toastify, Tailwind
 */

import './bootstrap';
import Alpine from 'alpinejs';
import '@tailwindplus/elements';
import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';
import collapse from '@alpinejs/collapse';

/* ==================================================
   GLOBAL SETUP
================================================== */

window.Alpine = Alpine;
window.AppUI = {};

/* ==================================================
   OPTIONAL ALPINE PLUGIN (SAFE)
   NOTE: only used if installed
================================================== */

try {
  Alpine.plugin(collapse);
} catch (e) {
  console.warn('Alpine collapse plugin not installed');
}

/* ==================================================
   SIDEBAR
================================================== */

AppUI.sidebarCollapse = ({ defaultOpen = false } = {}) => ({
  open: defaultOpen,
  toggle() {
    this.open = !this.open;
  }
});

AppUI.sidebarDropdownMenu = () => ({
  open: false,
  toggle() {
    this.open = !this.open;
  },
  close() {
    this.open = false;
  }
});

/* ==================================================
   TOAST SYSTEM
================================================== */

AppUI.toast = (type = 'success', message = '') => {
  const isSuccess = type === 'success';

  Toastify({
    text: `
      <div style="display:flex;align-items:center;gap:8px;">
        <span>${isSuccess ? '✔️' : '⚠️'}</span>
        <span>${message}</span>
      </div>
    `,
    duration: 4000,
    gravity: "bottom",
    position: "right",
    stopOnFocus: true,
    escapeMarkup: false,
    style: {
      background: isSuccess ? '#16a34a' : '#dc2626',
      color: '#fff',
      borderRadius: '6px',
      fontSize: '14px'
    }
  }).showToast();
};

window.toast = AppUI.toast;

/* ==================================================
   TAG INPUT
================================================== */

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

/* ==================================================
   CV UPLOADER (PDF ONLY)
================================================== */

AppUI.cvUploader = ({
  inputId = 'about_cv_file',
  maxMB = 5
} = {}) => ({
  inputId,
  maxMB,

  picked: false,
  name: '',
  size: '',
  error: '',

  isPdf(file) {
    return file &&
      (file.type === 'application/pdf' ||
        file.name.toLowerCase().endsWith('.pdf'));
  },

  format(bytes) {
    return (bytes / 1024 / 1024).toFixed(2) + ' MB';
  },

  onPick(e) {
    const file = e.target.files?.[0];
    this.error = '';

    if (!file) return;

    if (!this.isPdf(file)) {
      this.error = 'Only PDF allowed';
      e.target.value = '';
      return;
    }

    if (file.size > this.maxMB * 1024 * 1024) {
      this.error = `Max ${this.maxMB}MB allowed`;
      e.target.value = '';
      return;
    }

    this.picked = true;
    this.name = file.name;
    this.size = this.format(file.size);
  },

  clear() {
    const el = document.getElementById(this.inputId);
    if (el) el.value = '';

    this.picked = false;
    this.name = '';
    this.size = '';
    this.error = '';
  }
});

/* ==================================================
   IMAGE UPLOAD
================================================== */

AppUI.initImageUploads = () => {
  document.querySelectorAll('.js-image-upload').forEach(root => {
    if (root.dataset.bound) return;
    root.dataset.bound = '1';

    const input = root.querySelector('input[type="file"]');
    const previewSel = root.dataset.preview;

    if (!input || !previewSel) return;

    const preview = document.querySelector(previewSel);
    const img = preview?.querySelector('[data-preview-img]');
    const cap = preview?.querySelector('[data-preview-cap]');

    root.addEventListener('dragover', e => {
      e.preventDefault();
      root.classList.add('bg-emerald-500/10');
    });

    root.addEventListener('dragleave', () => {
      root.classList.remove('bg-emerald-500/10');
    });

    root.addEventListener('drop', e => {
      e.preventDefault();

      const file = e.dataTransfer.files?.[0];
      if (!file?.type.startsWith('image/')) return;

      const dt = new DataTransfer();
      dt.items.add(file);

      input.files = dt.files;
      input.dispatchEvent(new Event('change'));
    });

    input.addEventListener('change', () => {
      const file = input.files?.[0];
      if (!file) return;

      if (img) img.src = URL.createObjectURL(file);
      if (cap) cap.textContent = file.name;

      preview?.classList.remove('hidden');
    });
  });
};

/* ==================================================
   SELECT2-LIKE (SAFE SIMPLE VERSION)
================================================== */

AppUI.initSelect2Like = () => {
  document.querySelectorAll('select.select2[multiple]').forEach(select => {
    if (select.dataset.enhanced) return;
    select.dataset.enhanced = '1';

    select.style.display = 'none';

    const wrapper = document.createElement('div');
    const control = document.createElement('div');
    const input = document.createElement('input');
    const dropdown = document.createElement('div');

    wrapper.className = 'relative mt-2';
    control.className = 'flex flex-wrap gap-1 border p-2 rounded';
    input.className = 'flex-1 outline-none';
    dropdown.className = 'absolute w-full bg-white border mt-1 hidden z-50';

    control.appendChild(input);
    wrapper.appendChild(control);
    wrapper.appendChild(dropdown);

    select.parentNode.insertBefore(wrapper, select.nextSibling);

    const options = [...select.options].filter(o => o.value);

    const render = () => {
      dropdown.innerHTML = '';

      options.forEach(o => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = o.text;
        btn.className = 'block w-full text-left p-2 hover:bg-gray-100';

        btn.onclick = () => {
          o.selected = !o.selected;
          select.dispatchEvent(new Event('change', { bubbles: true }));
        };

        dropdown.appendChild(btn);
      });
    };

    input.addEventListener('focus', () => {
      dropdown.classList.remove('hidden');
    });

    document.addEventListener('click', e => {
      if (!wrapper.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });

    render();
  });
};

/* ==================================================
   INIT
================================================== */

document.addEventListener('DOMContentLoaded', () => {
  AppUI.initImageUploads();
  AppUI.initSelect2Like();
});

Alpine.start();