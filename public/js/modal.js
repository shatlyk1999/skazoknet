const searchInput = document.querySelector('#modalBody input[type="text"]');
const cityListContainer = document.getElementById("cityListContainer");
const selectedCityDisplay = document.getElementById("selectedCityDisplay");

async function fetchCities() {
    try {
        const response = await fetch("/index-cities"); // Replace with your actual endpoint
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const cities = await response.json();
        return cities; // Expecting array of { name, label } objects
    } catch (error) {
        console.error("Error fetching cities:", error);
        cityListContainer.innerHTML =
            '<p class="text-text2 p-2">Ошибка загрузки городов.</p>';
        return [];
    }
}

async function renderCities(cities) {
    cityListContainer.innerHTML = "";

    if (cities.length === 0 && searchInput.value.trim() !== "") {
        cityListContainer.innerHTML =
            '<p class="text-text2 p-2">Город не найден.</p>';
        return;
    }

    cities.forEach((city) => {
        const cityElement = document.createElement("div");
        cityElement.className =
            "flex items-center gap-x-2 cursor-pointer city-item hover:bg-gray-100 p-2 rounded transition-colors duration-150";
        cityElement.innerHTML = `
      <span class="text-primary text-base font-bold">${city.name}</span>
      <span class="text-base text-text2 font-bold">(${city.label})</span>
    `;
        cityElement.addEventListener("click", () => selectCity(city));
        cityListContainer.appendChild(cityElement);
    });
}

async function selectCity(city) {
    try {
        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.content;
        if (!csrfToken) {
            console.error("CSRF token not found");
            this.showServerErrors("CSRF token not found.");
            return;
        }
        // Send POST request to your endpoint
        const response = await fetch("/update-city", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
            body: JSON.stringify({
                name: city.name,
                label: city.label,
                id: city.id,
            }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log("City selection response:", result);

        // Update the selected city display
        if (selectedCityDisplay) {
            selectedCityDisplay.textContent = city.name;
            location.reload();
        } else {
            console.warn(
                "Элемент отображения города с ID 'selectedCityDisplay' не найден."
            );
        }

        // Close the modal
        closeModal("reusableModal");
    } catch (error) {
        console.error("Error sending city selection:", error);
        // Optionally, show an error message in the UI
        cityListContainer.innerHTML =
            '<p class="text-text2 p-2">Ошибка при выборе города.</p>';
    }
}

async function filterAndRenderCities() {
    const searchTerm = searchInput.value.toLowerCase().trim();
    const allCities = await fetchCities();

    const filteredCities =
        searchTerm === ""
            ? allCities
            : allCities.filter(
                  (cityData) =>
                      cityData.name.toLowerCase().includes(searchTerm) ||
                      cityData.label.toLowerCase().includes(searchTerm)
              );
    await renderCities(filteredCities);
}

if (searchInput) {
    searchInput.addEventListener("input", filterAndRenderCities);
    // Initial render
    filterAndRenderCities();
} else {
    console.error(
        "Элемент ввода для поиска не найден. Проверьте селектор: '#modalBody input[type=\"text\"]'"
    );
}

const MODAL_TRANSITION_DURATION = 300;

const openModal = (modalId) => {
    const modalOverlay = document.getElementById("modalOverlay");
    const modalElement = document.getElementById(modalId);

    if (modalOverlay && modalElement) {
        modalOverlay.classList.remove("hidden");
        modalElement.classList.remove("hidden");

        if (searchInput) {
            searchInput.value = "";
            filterAndRenderCities();
        }

        requestAnimationFrame(() => {
            modalOverlay.classList.remove("opacity-0");
            modalElement.classList.remove("opacity-0");
            modalElement.classList.remove("scale-95");
            modalElement.classList.remove("-translate-y-5");
        });
    }
};

const closeModal = (modalId) => {
    const modalOverlay = document.getElementById("modalOverlay");
    const modalElement = document.getElementById(modalId);

    if (modalOverlay && modalElement) {
        modalOverlay.classList.add("opacity-0");
        modalElement.classList.add("opacity-0");
        modalElement.classList.add("scale-95");
        modalElement.classList.add("-translate-y-5");
        setTimeout(() => {
            modalOverlay.classList.add("hidden");
            modalElement.classList.add("hidden");
        }, MODAL_TRANSITION_DURATION);
    }
};

document.addEventListener("keydown", function (event) {
    const reusableModal = document.getElementById("reusableModal");
    if (
        event.key === "Escape" &&
        reusableModal &&
        !reusableModal.classList.contains("hidden")
    ) {
        closeModal("reusableModal");
    }
});
