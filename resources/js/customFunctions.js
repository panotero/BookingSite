window.initModal = function initModal({ modalId }) {
  const modal = document.getElementById(modalId);
  const closeBtn = modal?.querySelectorAll(".modal-close");

  if (!modal || !closeBtn) {
    console.warn("Missing modal elements. Check your IDs.");
    return;
  }

  // Save current scroll position
  const scrollY = window.scrollY;

  // Show modal
  modal.classList.remove("hidden");
  let openmodalcount = checkopenmodal();
  // Disable background scrolling
  document.body.style.position = "fixed";
  document.body.style.top = `-${scrollY}px`;
  document.body.style.left = "0";
  document.body.style.right = "0";
  document.body.style.overflow = "hidden";
  closeBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      modal.classList.add("hidden");

      openmodalcount = checkopenmodal();
      if (openmodalcount > 0) {
        return;
      } else {
        // Restore scroll position and allow scrolling
        document.body.style.position = "";
        document.body.style.top = "";
        document.body.style.left = "";
        document.body.style.right = "";
        document.body.style.overflow = "";
        window.scrollTo(0, scrollY);
      }
    });
  });
};

function checkopenmodal() {
  const opennedmodal = document.querySelectorAll(".modal");
  let openmodalcount = 0;
  opennedmodal.forEach((mdl) => {
    if (!mdl.classList.contains("hidden")) {
      openmodalcount++;
    }
  });
  return openmodalcount;
}

window.closemodals = function closemodals(modalId = null) {
  // Helper function to reset and close a modal
  const closeModal = (mdl) => {
    if (!mdl || mdl.classList.contains("hidden")) return;

    // RESET FORM ELEMENTS
    const forms = mdl.querySelectorAll("form");
    forms.forEach((form) => form.reset());

    // RESET INPUTS NOT INSIDE FORM (fallback)
    const inputs = mdl.querySelectorAll("input, textarea, select");

    inputs.forEach((input) => {
      if (input.type === "checkbox" || input.type === "radio") {
        input.checked = false;
      } else if (input.type !== "hidden") {
        input.value = "";
      }
    });

    // OPTIONAL: reset custom UI
    mdl.querySelectorAll("[data-shipper], [data-consignee]").forEach((el) => {
      el.textContent = "—";
    });

    // HIDE MODAL
    mdl.classList.add("hidden");
  };

  // Close specific modal
  if (modalId) {
    closeModal(document.getElementById(modalId));
    return;
  }

  // Close all open modals
  document.querySelectorAll(".modal:not(.hidden)").forEach(closeModal);
};

window.renderRows = function renderRows(
  tablebodyID,
  data,
  clickableRow = false,
  functionToCallOnRowClick = null,
) {
  const tbody = document.getElementById(tablebodyID);

  if (!tbody) {
    console.error(`Table body "${tablebodyID}" not found.`);
    return;
  }

  tbody.innerHTML = "";

  if (!Array.isArray(data) || data.length === 0) {
    tbody.innerHTML = `
            <tr>
                <td colspan="100%" class="text-center py-5 text-gray-500">
                    No records found.
                </td>
            </tr>
        `;
    return;
  }

  data.forEach((row) => {
    const tr = document.createElement("tr");

    tr.className = `
            border-b border-gray-200
            hover:bg-gray-50
            transition
        `;

    let rowId = row.id ?? null;

    if (clickableRow) {
      tr.classList.add("cursor-pointer");

      tr.addEventListener("click", (e) => {
        if (e.target.closest("button")) {
          return;
        }
        if (typeof functionToCallOnRowClick === "function") {
          functionToCallOnRowClick(rowId);
        }
      });
    }

    Object.entries(row).forEach(([key, value]) => {
      // ✅ SKIP ID COLUMN
      if (key === "id") return;
      const td = document.createElement("td");
      td.className = "px-4 py-3";

      // Action column (HTML allowed)
      if (key.toLowerCase() === "action") {
        td.innerHTML = value;
      } else {
        td.textContent = value ?? "-";
      }

      tr.appendChild(td);
    });

    tbody.appendChild(tr);
  });

  initDataTables(10);
};

window.clearInputs = function clearInputs() {
  document.querySelectorAll("input").forEach((input) => {
    if (input.hasAttribute("disabled")) return;
    input.value = "";
  });

  document.querySelectorAll("select").forEach((input) => {
    if (input.hasAttribute("disabled")) return;
    input.value = "";
  });
};

window.renderPhotoGallery = function renderPhotoGallery({
  container,
  photos = [],
  modelId,
  deleteUrl,
  onDeleteSuccess,
}) {
  if (!container) return;

  container.innerHTML = "";

  // =========================
  // Render HTML
  // =========================
  const html = photos
    .map(
      (
        photo,
      ) => `<div class="relative w-full aspect-square border rounded-xl overflow-hidden shadow-sm cursor-pointer">

    <button
        class="deleteRoomPhotoBtn absolute top-1 right-1 bg-red-500 text-white px-1.5 py-0.5 text-[10px] rounded-md"
        data-delete-photo="${photo}"
        data-model-id="${modelId}"
    >
        ✕
    </button>

    <img
        src="${photo}"
        class="w-full h-full object-cover"
    >

</div>
    `,
    )
    .join("");

  container.innerHTML = html;

  // =========================
  // Bind delete events
  // =========================
  container.querySelectorAll(".deleteRoomPhotoBtn").forEach((btn) => {
    btn.addEventListener("click", async function (e) {
      e.stopPropagation();

      const payload = {
        roomID: this.dataset.modelId,
        photo: this.dataset.deletePhoto,
      };

      await apiCall({
        mode: "DELETE",
        isJson: true,
        payload,
        url: deleteUrl,
        button: btn,
      });

      // callback after delete
      if (typeof onDeleteSuccess === "function") {
        onDeleteSuccess();
      }
    });
  });
};
