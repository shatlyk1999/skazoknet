// Function to toggle sidebar - can be called directly from onclick
const toggleSidebar = (toggleId, sidebarId, overlayId, closeId = null) => {
    const toggle = document.getElementById(toggleId);
    const sidebar = document.getElementById(sidebarId);
    const overlay = document.getElementById(overlayId);
    const html = document.documentElement;

    if (toggle && sidebar && overlay) {
        // Toggle sidebar classes
        const isActive = sidebar.classList.contains("active");

        if (isActive) {
            // Close sidebar
            html.style.overflow = "auto";
            toggle.classList.remove("active");
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        } else {
            // Open sidebar
            html.style.overflow = "hidden";
            toggle.classList.add("active");
            sidebar.classList.add("active");
            overlay.classList.add("active");
        }
    } else {
        console.warn(
            `Sidebar toggle failed: Missing elements for toggleId: ${toggleId}, sidebarId: ${sidebarId}, or overlayId: ${overlayId}`
        );
    }
};

// Initialize sidebar event listeners when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const closeButton = document.getElementById("closeSidebar");
    const html = document.documentElement;

    if (sidebar && overlay) {
        // Close sidebar on overlay click
        overlay.addEventListener("click", () => {
            html.style.overflow = "auto";
            document.getElementById("menuToggle")?.classList.remove("active");
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        });

        // Close sidebar on close button click (if provided)
        if (closeButton) {
            closeButton.addEventListener("click", () => {
                html.style.overflow = "auto";
                document
                    .getElementById("menuToggle")
                    ?.classList.remove("active");
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            });
        }
    }
});

const toggleCollapse = (contentSelector, buttonSelector) => {
    const content = document.querySelector(contentSelector);
    const toggleButton = document.querySelector(buttonSelector);
    const icon = toggleButton.querySelector("img");

    if (!content || !toggleButton || !icon) {
        console.error("Content, button, or icon not found");
        return;
    }

    // Toggle content visibility with Tailwind classes
    if (content.classList.contains("h-[2.5rem]")) {
        content.classList.remove("h-[2.5rem]");
        content.classList.add("h-full");
        toggleButton.querySelector("span").textContent = "Свернуть";
        icon.src = "../public/icons/up.svg";
    } else {
        content.classList.add("h-[2.5rem]");
        content.classList.remove("h-full");
        toggleButton.querySelector("span").textContent = "Развернуть";
        icon.src = "../public/icons/down.svg";
    }
};

document.querySelectorAll(".dropdown").forEach((dropdown) => {
    const dropdownContent = dropdown.querySelector(".dropdown-content");
    const dropdownItems = dropdown.querySelectorAll(".dropdown-item");
    let selectedItem = dropdown.querySelector(".dropdown-item");

    dropdown.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdownContent.classList.toggle("hidden");
    });

    dropdownItems.forEach((item) => {
        item.addEventListener("click", () => {
            selectedItem.querySelector(".check-icon").classList.add("hidden");
            selectedItem = item;
            item.querySelector(".check-icon").classList.remove("hidden");
            dropdownContent.classList.add("hidden");
        });
    });
});

document.addEventListener("click", (e) => {
    document.querySelectorAll(".dropdown-content").forEach((content) => {
        if (!content.closest(".dropdown").contains(e.target)) {
            content.classList.add("hidden");
        }
    });
});
