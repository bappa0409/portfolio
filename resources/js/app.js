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
