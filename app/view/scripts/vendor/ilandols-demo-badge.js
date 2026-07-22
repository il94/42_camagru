/*
 * ilandols-demo-badge 0.4.3 (https://www.npmjs.com/package/ilandols-demo-badge)
 *
 * Bundle ESM copie tel quel depuis dist/ : le projet est en PHP, sans npm ni
 * bundler, et la CSP (script-src 'self') interdit de le charger depuis un CDN.
 * Ne pas editer : pour mettre a jour, recopier le dist de la nouvelle version.
 */
// src/default-icon.ts
var DEFAULT_ICON = "data:image/png;base64,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";

// src/index.ts
var TAG_NAME = "ilandols-demo-badge";
var DISMISS_LABELS = {
  fr: "J'ai compris !",
  en: "Got it !"
};
var COPY_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>';
var CHECK_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
function isCredential(item) {
  const cred = item;
  return typeof cred?.label === "string" && typeof cred?.value === "string";
}
function toCredentials(items) {
  return Array.isArray(items) ? items.filter(isCredential) : [];
}
function normalizeAccounts(input) {
  if (!Array.isArray(input) || input.length === 0) return [];
  const isMulti = input.some((item) => Array.isArray(item?.credentials));
  if (!isMulti) {
    const credentials = toCredentials(input);
    if (credentials.length !== input.length) {
      console.warn(`[${TAG_NAME}] certains identifiants sont invalides, "label" et "value" attendus.`);
    }
    return credentials.length > 0 ? [{ label: "", credentials }] : [];
  }
  const accounts = input.filter((item) => Array.isArray(item?.credentials)).map((account) => ({
    label: typeof account.label === "string" ? account.label : "",
    credentials: toCredentials(account.credentials)
  })).filter((account) => account.credentials.length > 0);
  if (accounts.length !== input.length) {
    console.warn(`[${TAG_NAME}] certains comptes sont invalides, "label" et "credentials" attendus.`);
  }
  return accounts;
}
var IlandolsDemoBadgeElement = class extends HTMLElement {
  constructor() {
    super();
    this.open = false;
    this._credentials = [];
    this._accounts = [];
    this.onDocumentClick = (event) => {
      if (!this.open) return;
      const path = event.composedPath();
      if (!path.includes(this)) this.close();
    };
    this.onDocumentKeydown = (event) => {
      if (event.key === "Escape" && this.open) this.close();
    };
    this.root = this.attachShadow({ mode: "open" });
    this.render();
  }
  static get observedAttributes() {
    return ["icon", "heading", "description", "lang"];
  }
  connectedCallback() {
    try {
      if (sessionStorage.getItem(this.dismissKey)) this.hidden = true;
    } catch {
      console.warn(`[${TAG_NAME}] sessionStorage indisponible, l'\xE9tat masqu\xE9 ne sera pas m\xE9moris\xE9.`);
    }
    if (window.matchMedia("(min-width: 640px)").matches) {
      requestAnimationFrame(() => requestAnimationFrame(() => this.openPanel()));
    }
    const raw = this.getAttribute("credentials");
    if (raw && this._credentials.length === 0) {
      try {
        this.credentials = JSON.parse(raw);
      } catch {
        console.warn(`[${TAG_NAME}] attribut "credentials" invalide, JSON attendu.`);
      }
    }
    document.addEventListener("click", this.onDocumentClick);
    document.addEventListener("keydown", this.onDocumentKeydown);
  }
  disconnectedCallback() {
    document.removeEventListener("click", this.onDocumentClick);
    document.removeEventListener("keydown", this.onDocumentKeydown);
  }
  attributeChangedCallback(name, oldValue, newValue) {
    if (oldValue === newValue) return;
    if (name === "icon") this.badgeButton?.style.setProperty("--icon", `url("${newValue ?? DEFAULT_ICON}")`);
    if (name === "heading" && this.panelTitle) this.panelTitle.textContent = newValue ?? "Compte de d\xE9mo";
    if (name === "description" && this.panelDescription) {
      this.panelDescription.textContent = newValue ?? "";
      this.panelDescription.hidden = !newValue;
    }
    if (name === "lang" && this.dismissBtn) this.dismissBtn.textContent = this.dismissLabel;
  }
  get credentials() {
    return this._credentials;
  }
  set credentials(value) {
    this._credentials = Array.isArray(value) ? value : [];
    this._accounts = normalizeAccounts(this._credentials);
    this.renderList();
  }
  toggle() {
    this.open ? this.close() : this.openPanel();
  }
  openPanel() {
    this.open = true;
    this.panel.classList.add("open");
    this.badgeButton.setAttribute("aria-expanded", "true");
  }
  close() {
    this.open = false;
    this.panel.classList.remove("open");
    this.badgeButton.setAttribute("aria-expanded", "false");
  }
  get dismissKey() {
    return `${TAG_NAME}:dismissed:${this.id || "default"}`;
  }
  get dismissLabel() {
    return DISMISS_LABELS[this.getAttribute("lang") === "fr" ? "fr" : "en"];
  }
  dismissForSession() {
    try {
      sessionStorage.setItem(this.dismissKey, "1");
    } catch {
      console.warn(`[${TAG_NAME}] impossible d'enregistrer le masquage pour cette session.`);
    }
    this.close();
    this.hidden = true;
  }
  async copy(value, iconEl) {
    try {
      await navigator.clipboard.writeText(value);
      iconEl.innerHTML = CHECK_ICON;
      iconEl.classList.add("row-icon--copied");
      setTimeout(() => {
        iconEl.innerHTML = COPY_ICON;
        iconEl.classList.remove("row-icon--copied");
      }, 1200);
    } catch {
      console.warn(`[${TAG_NAME}] impossible de copier dans le presse-papiers.`);
    }
  }
  renderRow(cred, accountLabel) {
    const row = document.createElement("button");
    row.type = "button";
    row.className = "row";
    row.setAttribute(
      "aria-label",
      accountLabel ? `Copier ${cred.label} du compte ${accountLabel} : ${cred.value}` : `Copier ${cred.label} : ${cred.value}`
    );
    const text = document.createElement("div");
    text.className = "row-text";
    const label = document.createElement("span");
    label.className = "row-label";
    label.textContent = cred.label;
    const value = document.createElement("span");
    value.className = "row-value";
    value.textContent = cred.value;
    text.append(label, value);
    const icon = document.createElement("span");
    icon.className = "row-icon";
    icon.innerHTML = COPY_ICON;
    row.append(text, icon);
    row.addEventListener("click", () => this.copy(cred.value, icon));
    return row;
  }
  renderList() {
    this.panelList.innerHTML = "";
    const showTitles = this._accounts.length > 1;
    for (const account of this._accounts) {
      const section = document.createElement("div");
      section.className = "account";
      if (showTitles && account.label) {
        const title = document.createElement("h3");
        title.className = "account-title";
        title.textContent = account.label;
        section.appendChild(title);
      }
      const rows = document.createElement("div");
      rows.className = "account-rows";
      for (const cred of account.credentials) {
        rows.appendChild(this.renderRow(cred, showTitles ? account.label : ""));
      }
      section.appendChild(rows);
      this.panelList.appendChild(section);
    }
  }
  render() {
    const icon = this.getAttribute("icon") ?? DEFAULT_ICON;
    const heading = this.getAttribute("heading") ?? "Compte de d\xE9mo";
    const description = this.getAttribute("description") ?? "";
    this.root.innerHTML = `
      <style>${STYLES}</style>
      <div class="badge-wrap">
        <span class="sonar-ring"></span>
        <span class="sonar-ring sonar-ring--delayed"></span>
        <button class="badge" part="badge" style="--icon: url('${icon}')" aria-expanded="false" aria-label="Afficher les identifiants de d\xE9mo"></button>
      </div>
      <div class="panel" part="panel">
        <div class="panel-header">
          <h2 class="panel-title"></h2>
          <button class="close-btn" type="button" aria-label="Fermer">\u2715</button>
        </div>
        <p class="panel-description"></p>
        <div class="panel-list"></div>
        <div class="panel-footer">
          <button class="dismiss-btn" type="button"></button>
        </div>
      </div>
    `;
    this.badgeButton = this.root.querySelector(".badge");
    this.panel = this.root.querySelector(".panel");
    this.panelTitle = this.root.querySelector(".panel-title");
    this.panelDescription = this.root.querySelector(".panel-description");
    this.panelList = this.root.querySelector(".panel-list");
    this.dismissBtn = this.root.querySelector(".dismiss-btn");
    this.panelTitle.textContent = heading;
    this.panelDescription.textContent = description;
    this.panelDescription.hidden = !description;
    this.dismissBtn.textContent = this.dismissLabel;
    this.badgeButton.addEventListener("click", () => this.toggle());
    this.root.querySelector(".close-btn").addEventListener("click", () => this.close());
    this.dismissBtn.addEventListener("click", () => this.dismissForSession());
  }
};
var STYLES = `
  :host,
  :host * {
    box-sizing: border-box;
  }

  :host {
    all: initial;
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 2147483647;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }

  @media (min-width: 640px) {
    :host {
      bottom: 32px;
      right: 32px;
    }
  }

  :host([hidden]) {
    display: none;
  }

  .badge-wrap {
    position: relative;
    width: 56px;
    height: 56px;
  }

  .sonar-ring {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(75, 55, 94, 0.55);
    animation: sonar 2.4s ease-out infinite;
    pointer-events: none;
  }

  .sonar-ring--delayed {
    animation-delay: 1.2s;
  }

  .badge {
    position: relative;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    font-family: inherit;
    background-color: #111827;
    background-image: var(--icon);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
    scale: 1;
    transition: box-shadow 0.15s ease, scale 0.15s ease;
    animation: breathe 2.4s ease-in-out infinite;
  }

  .badge-wrap:hover .badge {
    animation-play-state: paused;
    scale: 1.08;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
  }

  .badge-wrap:has(.badge[aria-expanded="true"]) .badge {
    animation-play-state: paused;
  }

  @keyframes breathe {
    0%,
    100% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.06);
    }
  }

  @keyframes sonar {
    0% {
      transform: scale(1);
      opacity: 0.55;
    }
    80% {
      opacity: 0;
    }
    100% {
      transform: scale(2.1);
      opacity: 0;
    }
  }

  .panel {
    position: absolute;
    bottom: 72px;
    right: 0;
    width: 320px;
    max-width: calc(100vw - 40px);
    max-height: calc(100vh - 112px);
    max-height: calc(100dvh - 112px);
    overflow-y: auto;
    background: linear-gradient(160deg, #5a4470 0%, #4d3176 100%);
    color: #ffead2;
    border-radius: 20px;
    box-shadow: 0 16px 40px rgba(30, 15, 51, 0.45);
    padding: 18px;
    opacity: 0;
    transform: translateY(8px) scale(0.98);
    pointer-events: none;
    transition: opacity 0.15s ease, transform 0.15s ease;
  }

  .panel.open {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
  }

  .panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 4px;
  }

  .panel-title {
    font-size: 15px;
    font-weight: 700;
    margin: 0;
    color: #ffead2;
  }

  .close-btn {
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
    font-size: 13px;
    color: rgba(255, 234, 210, 0.6);
    line-height: 1;
    padding: 4px;
  }

  .close-btn:hover {
    color: #ffead2;
  }

  .panel-description {
    font-size: 13px;
    line-height: 1.5;
    color: rgba(255, 234, 210, 0.75);
    margin: 0;
  }

  .panel-description[hidden] {
    display: none;
  }

  .panel-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 12px;
  }

  .account-rows {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  /* s'ajoute au gap de .panel-list pour a\xE9rer entre deux comptes */
  .account + .account {
    margin-top: 6px;
  }

  .account-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: rgba(255, 234, 210, 0.55);
    margin: 0 0 6px;
    padding-left: 2px;
  }

  .row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    width: 100%;
    padding: 8px 10px;
    background: rgba(255, 255, 255, 0.08);
    border: none;
    border-radius: 10px;
    font: inherit;
    text-align: left;
    cursor: pointer;
    transition: transform 0.15s ease, background 0.15s ease;
  }

  .row:hover {
    transform: scale(1.02);
    background: rgba(255, 255, 255, 0.14);
  }

  .row-text {
    display: flex;
    flex-direction: column;
    min-width: 0;
  }

  .row-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: rgba(255, 234, 210, 0.6);
  }

  .row-value {
    font-size: 13px;
    font-weight: 600;
    color: #ffead2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .row-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    color: #ffead2;
  }

  .row-icon svg {
    width: 18px;
    height: 18px;
  }

  .row-icon--copied {
    color: #86efac;
  }

  .panel-footer {
    margin-top: 8px;
    text-align: center;
  }

  .dismiss-btn {
    background: none;
    border: none;
    font-family: inherit;
    font-size: 12px;
    color: rgba(255, 234, 210, 0.6);
    cursor: pointer;
    padding: 4px;
  }

  .dismiss-btn:hover {
    color: rgba(255, 234, 210, 0.9);
    text-decoration: underline;
  }
`;
if (!customElements.get(TAG_NAME)) {
  customElements.define(TAG_NAME, IlandolsDemoBadgeElement);
}

export {
  TAG_NAME,
  IlandolsDemoBadgeElement
};
