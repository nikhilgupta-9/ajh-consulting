/* Finbiz inline helpers — replaces what used to live in inline <script> tags
   plus the small chunks of Bootstrap JS that the template still relied on.
   Loaded last in <body> so all targets exist in the DOM. */
(function () {
  "use strict";

  // 1. Fill <span class="current-year"></span> with the current year.
  var year = String(new Date().getFullYear());
  var yearNodes = document.querySelectorAll(".current-year");
  for (var i = 0; i < yearNodes.length; i++) {
    yearNodes[i].textContent = year;
  }

  // 1b. Auto-generate aria-labels for form buttons without explicit labels.
  //     Makes existing buttons accessible without requiring manual aria-label edits.
  var formButtons = document.querySelectorAll("form button, form input[type='submit']");
  for (var j = 0; j < formButtons.length; j++) {
    var btn = formButtons[j];
    if (!btn.getAttribute("aria-label") && !btn.getAttribute("aria-labelledby")) {
      var btnText = btn.value || btn.textContent || "";
      btnText = btnText.trim();
      if (btnText) {
        btn.setAttribute("aria-label", btnText);
      }
    }
  }

  // 1c. Drag-and-drop: when button is dragged into form, remove previous default button.
  var forms = document.querySelectorAll("form");
  for (var k = 0; k < forms.length; k++) {
    var form = forms[k];
    form.addEventListener("dragover", function (e) {
      e.preventDefault();
      e.dataTransfer.dropEffect = "move";
      this.style.borderColor = "#df0a0a";
      this.style.borderWidth = "2px";
      this.style.borderStyle = "dashed";
    });
    form.addEventListener("dragleave", function () {
      this.style.borderColor = "";
      this.style.borderWidth = "";
      this.style.borderStyle = "";
    });
    form.addEventListener("drop", function (e) {
      e.preventDefault();
      this.style.borderColor = "";
      this.style.borderWidth = "";
      this.style.borderStyle = "";
      var draggedElement = e.dataTransfer.getData("text/html");
      if (draggedElement.includes("button") || draggedElement.includes("submit")) {
        var existingButtons = this.querySelectorAll("button[type='submit'], input[type='submit']");
        for (var b = 0; b < existingButtons.length; b++) {
          existingButtons[b].remove();
        }
      }
    });
  }

  // Make buttons draggable
  var allButtons = document.querySelectorAll("button[type='submit'], input[type='submit']");
  for (var b = 0; b < allButtons.length; b++) {
    allButtons[b].draggable = true;
    allButtons[b].addEventListener("dragstart", function (e) {
      e.dataTransfer.effectAllowed = "move";
      e.dataTransfer.setData("text/html", this.outerHTML);
    });
  }

  // 2. Smooth collapse animation helpers (Bootstrap-style height transition).
  //    During animation the element carries only `.collapsing` (not `.collapse`)
  //    so `.collapse:not(.show) { display:none }` does not fire.
  function slideDown(el) {
    if (el.classList.contains("collapsing")) return;
    // Remove .collapse so display:none rule no longer matches, then measure.
    el.classList.remove("collapse", "show");
    el.classList.add("collapsing");
    el.style.height = "0";
    void el.offsetHeight; // force reflow
    var naturalH = el.scrollHeight;
    el.style.height = naturalH + "px";
    el.addEventListener(
      "transitionend",
      function handler() {
        el.removeEventListener("transitionend", handler);
        el.classList.remove("collapsing");
        el.classList.add("collapse", "show");
        el.style.height = "";
      },
      { once: true }
    );
  }

  function slideUp(el) {
    if (el.classList.contains("collapsing")) return;
    el.style.height = el.scrollHeight + "px";
    el.classList.remove("collapse", "show");
    el.classList.add("collapsing");
    void el.offsetHeight; // force reflow
    el.style.height = "0";
    el.addEventListener(
      "transitionend",
      function handler() {
        el.removeEventListener("transitionend", handler);
        el.classList.remove("collapsing");
        el.classList.add("collapse");
        el.style.height = "";
      },
      { once: true }
    );
  }

  // 3. Bootstrap-style accordion: data-bs-toggle="collapse" + data-bs-target="#id".
  document.addEventListener("click", function (evt) {
    var trigger =
      evt.target.closest && evt.target.closest('[data-bs-toggle="collapse"]');
    if (!trigger) return;
    var sel =
      trigger.getAttribute("data-bs-target") || trigger.getAttribute("href");
    if (!sel || sel.charAt(0) !== "#") return;
    var target = document.querySelector(sel);
    if (!target) return;
    evt.preventDefault();

    var isOpen = target.classList.contains("show");

    // Close open siblings inside the same parent accordion.
    var parentSel = target.getAttribute("data-bs-parent");
    if (parentSel) {
      var parent = document.querySelector(parentSel);
      if (parent) {
        var openSiblings = parent.querySelectorAll(".accordion-collapse.show");
        for (var s = 0; s < openSiblings.length; s++) {
          if (openSiblings[s] !== target) {
            slideUp(openSiblings[s]);
            var sibTrigger = parent.querySelector(
              '[data-bs-target="#' + openSiblings[s].id + '"]'
            );
            if (sibTrigger) {
              sibTrigger.classList.add("collapsed");
              sibTrigger.setAttribute("aria-expanded", "false");
            }
          }
        }
      }
    }

    if (isOpen) {
      slideUp(target);
      trigger.classList.add("collapsed");
      trigger.setAttribute("aria-expanded", "false");
    } else {
      slideDown(target);
      trigger.classList.remove("collapsed");
      trigger.setAttribute("aria-expanded", "true");
    }
  });

  // 4. Bootstrap-style tabs / pills: data-bs-toggle="tab" or "pill".
  document.addEventListener("click", function (evt) {
    var trigger =
      evt.target.closest &&
      (evt.target.closest('[data-bs-toggle="tab"]') ||
        evt.target.closest('[data-bs-toggle="pill"]'));
    if (!trigger) return;
    var sel =
      trigger.getAttribute("data-bs-target") || trigger.getAttribute("href");
    if (!sel || sel.charAt(0) !== "#") return;
    var pane = document.querySelector(sel);
    if (!pane) return;
    evt.preventDefault();

    var tabList =
      trigger.closest('[role="tablist"]') ||
      trigger.closest(".nav-tabs") ||
      trigger.closest(".nav-pills") ||
      trigger.parentElement;
    if (tabList) {
      var siblings = tabList.querySelectorAll(
        '[data-bs-toggle="tab"], [data-bs-toggle="pill"]'
      );
      for (var i = 0; i < siblings.length; i++) {
        siblings[i].classList.remove("active");
        siblings[i].setAttribute("aria-selected", "false");
      }
    }
    trigger.classList.add("active");
    trigger.setAttribute("aria-selected", "true");

    var paneParent = pane.parentElement;
    if (paneParent) {
      var panes = paneParent.querySelectorAll(".tab-pane");
      for (var j = 0; j < panes.length; j++) {
        panes[j].classList.remove("active", "show");
      }
    }
    pane.classList.add("active", "show");
  });
})();
