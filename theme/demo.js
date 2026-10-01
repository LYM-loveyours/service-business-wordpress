/* This form has no sending code. A local demo status is the only result. */
document.querySelectorAll('.north-form').forEach((form) => {
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const fields = [...form.querySelectorAll('[required]')];
    let first = null;
    fields.forEach((field) => {
      const valid = field.checkValidity() && (field.type === 'checkbox' || field.value.trim().length > 0);
      field.setAttribute('aria-invalid', String(!valid));
      const error = document.getElementById(field.id + '-error');
      if (error) error.textContent = valid ? '' : (field.type === 'checkbox' ? 'Confirm the demonstration notice.' : 'Please complete this field with a valid value.');
      if (!valid && !first) first = field;
    });
    const status = form.querySelector('.status');
    if (first) { status.textContent = 'Please check the highlighted fields.'; status.classList.add('error'); first.focus(); return; }
    form.reset();
    status.classList.remove('error');
    status.textContent = 'Demonstration complete. No message was sent. Your entries have been cleared.';
    status.focus();
  });
});
