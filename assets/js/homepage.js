(() => {
  const app = document.querySelector("#homepage-app");
  const country = document.querySelector("#homepage-country");

  if (!app || !country) return;

  const baseUrl = app.dataset.baseUrl;
  const savedCountry = document.cookie.match(/(?:^|; )ga_user_country=([^;]*)/);
  const savedTrack = document.cookie.match(/(?:^|; )ga_user_track=([^;]*)/);
  if (savedCountry) country.value = decodeURIComponent(savedCountry[1]);

  const audienceSwitch = app.querySelector(".ga-audience-switch");
  const mobileLayout = window.matchMedia("(max-width: 580px)");
  let activeAudience = savedTrack ? decodeURIComponent(savedTrack[1]) : "business";

  function setCookie(name, value) {
    document.cookie = `${name}=${encodeURIComponent(value)}; path=/; SameSite=Lax; max-age=2592000`;
  }

  function updateAudience() {
    app.querySelectorAll(".ga-path").forEach((card) => {
      card.hidden = mobileLayout.matches && card.id !== `${activeAudience}-option`;
    });
    audienceSwitch.querySelectorAll("[role=tab]").forEach((tab) => {
      tab.setAttribute("aria-selected", String(tab.dataset.audienceToggle === activeAudience));
    });
  }

  function updateRegion() {
    app.querySelector(".ga-region").textContent = country.value === "au" ? "Australia" : "New Zealand";
  }

  country.addEventListener("change", () => {
    setCookie("ga_user_country", country.value);
    updateRegion();
  });

  audienceSwitch.addEventListener("click", (event) => {
    const tab = event.target.closest("[data-audience-toggle]");
    if (!tab) return;
    activeAudience = tab.dataset.audienceToggle;
    updateAudience();
  });

  mobileLayout.addEventListener("change", updateAudience);
  window.addEventListener("resize", updateAudience);

  app.addEventListener("click", (event) => {
    const link = event.target.closest("a[data-track]");
    if (!link) return;

    const track = link.dataset.track;
    const service = link.dataset.service;
    const isAustralia = country.value === "au";
    activeAudience = track;
    updateAudience();
    setCookie("ga_user_track", track);
    setCookie("ga_user_country", country.value);
    setCookie("ga_gate", `${track === "firm" ? "accountant" : "business"}_${country.value}`);
    if (service) setCookie("ga_user_service", service);

    if (isAustralia) {
      event.preventDefault();
      const query = new URLSearchParams({ track });
      if (service) query.set("service", service);
      window.location.href = `${baseUrl}australia.php?${query}`;
    }
  });

  updateRegion();
  updateAudience();
})();