<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Auto placeholder left for all inputs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .input-with-placeholder {
      position: relative;
      display: inline-block;
      width: 300px;
      margin-bottom: 1rem;
    }
    .input-with-placeholder input.input-placeholder-left {
      padding-left: 120px; /* space for placeholder */
      text-align: right; /* input text on right */
    }
    .input-with-placeholder .placeholder-text {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
      pointer-events: none;
      font-size: 1rem;
      transition: 0.3s ease all;
      user-select: none;
    }
    .input-with-placeholder input.input-placeholder-left:focus + .placeholder-text,
    .input-with-placeholder input.input-placeholder-left:not(:placeholder-shown) + .placeholder-text {
      color: #495057;
      font-weight: 600;
    }
  </style>
</head>
<body class="p-5">

  <input type="text" class="form-control input-placeholder-left" placeholder="First Name" autocomplete="off" />
  <input type="text" class="form-control input-placeholder-left" placeholder="Last Name" autocomplete="off" />
  <input type="email" class="form-control input-placeholder-left" placeholder="Email Address" autocomplete="off" />

  <script>
    document.querySelectorAll('input.input-placeholder-left').forEach(input => {
      // Create wrapper div
      const wrapper = document.createElement('div');
      wrapper.classList.add('input-with-placeholder');

      // Create span for placeholder text from input placeholder
      const placeholderSpan = document.createElement('span');
      placeholderSpan.classList.add('placeholder-text');
      placeholderSpan.textContent = input.getAttribute('placeholder');

      // Wrap the input
      input.parentNode.insertBefore(wrapper, input);
      wrapper.appendChild(input);
      wrapper.appendChild(placeholderSpan);

      // Clear native placeholder to avoid duplication
      input.setAttribute('placeholder', '');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
