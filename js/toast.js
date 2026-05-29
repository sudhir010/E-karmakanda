(function() {
  const container = document.createElement('div');
  container.className = 'toast-container';
  document.body.appendChild(container);

  window.showToast = function(message, type) {
    type = type || 'info';
    const el = document.createElement('div');
    el.className = 'toast-item toast-' + type;
    el.textContent = message;
    container.appendChild(el);
    setTimeout(function() {
      el.classList.add('toast-out');
      setTimeout(function() { el.remove(); }, 300);
    }, 4000);
  };
})();
