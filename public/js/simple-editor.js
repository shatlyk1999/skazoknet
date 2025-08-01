class SimpleEditor {
    constructor(selector, options = {}) {
        this.element = document.querySelector(selector);
        if (!this.element) {
            console.error("SimpleEditor: Element not found");
            return;
        }

        this.options = {
            height: options.height || "200px",
            placeholder: options.placeholder || "Введите текст...",
            toolbar: options.toolbar || [
                "bold",
                "italic",
                "underline",
                "|",
                "alignLeft",
                "alignCenter",
                "alignRight",
                "|",
                "bulletList",
                "numberedList",
                "|",
                "link",
            ],
        };

        this.init();
    }

    init() {
        this.createEditor();
        this.bindEvents();
        this.loadContent();
    }

    createEditor() {
        // Hide original textarea
        this.element.style.display = "none";

        // Create editor container
        this.container = document.createElement("div");
        this.container.className = "simple-editor";

        // Create toolbar
        this.toolbar = document.createElement("div");
        this.toolbar.className = "simple-editor-toolbar";
        this.createToolbar();

        // Create content area
        this.contentArea = document.createElement("div");
        this.contentArea.className = "simple-editor-content";
        this.contentArea.contentEditable = true;
        this.contentArea.style.height = this.options.height;
        this.contentArea.setAttribute(
            "data-placeholder",
            this.options.placeholder
        );

        // Assemble editor
        this.container.appendChild(this.toolbar);
        this.container.appendChild(this.contentArea);

        // Insert after original textarea
        this.element.parentNode.insertBefore(
            this.container,
            this.element.nextSibling
        );
    }

    createToolbar() {
        const toolbarButtons = {
            bold: { icon: "mdi-format-bold", title: "Жирный", command: "bold" },
            italic: {
                icon: "mdi-format-italic",
                title: "Курсив",
                command: "italic",
            },
            underline: {
                icon: "mdi-format-underline",
                title: "Подчеркнутый",
                command: "underline",
            },
            alignLeft: {
                icon: "mdi-format-align-left",
                title: "По левому краю",
                command: "justifyLeft",
            },
            alignCenter: {
                icon: "mdi-format-align-center",
                title: "По центру",
                command: "justifyCenter",
            },
            alignRight: {
                icon: "mdi-format-align-right",
                title: "По правому краю",
                command: "justifyRight",
            },
            bulletList: {
                icon: "mdi-format-list-bulleted",
                title: "Маркированный список",
                command: "insertUnorderedList",
            },
            numberedList: {
                icon: "mdi-format-list-numbered",
                title: "Нумерованный список",
                command: "insertOrderedList",
            },
            link: { icon: "mdi-link", title: "Ссылка", command: "createLink" },
        };

        this.options.toolbar.forEach((item) => {
            if (item === "|") {
                const separator = document.createElement("div");
                separator.className = "toolbar-separator";
                this.toolbar.appendChild(separator);
            } else if (toolbarButtons[item]) {
                const button = document.createElement("button");
                button.type = "button";
                button.className = "toolbar-btn";
                button.title = toolbarButtons[item].title;
                button.innerHTML = `<i class="mdi ${toolbarButtons[item].icon}"></i>`;
                button.addEventListener("click", (e) => {
                    e.preventDefault();
                    this.execCommand(toolbarButtons[item].command);
                });
                this.toolbar.appendChild(button);
            }
        });
    }

    execCommand(command) {
        this.contentArea.focus();

        if (command === "createLink") {
            const url = prompt("Введите URL:");
            if (url) {
                document.execCommand(command, false, url);
            }
        } else {
            document.execCommand(command, false, null);
        }

        this.updateContent();
    }

    bindEvents() {
        // Update textarea when content changes
        this.contentArea.addEventListener("input", () => {
            this.updateContent();
        });

        this.contentArea.addEventListener("paste", (e) => {
            e.preventDefault();
            const text = e.clipboardData.getData("text/plain");
            document.execCommand("insertText", false, text);
        });

        // Handle placeholder
        this.contentArea.addEventListener("focus", () => {
            if (this.contentArea.textContent.trim() === "") {
                this.contentArea.classList.add("focused");
            }
        });

        this.contentArea.addEventListener("blur", () => {
            this.contentArea.classList.remove("focused");
            this.updatePlaceholder();
        });

        // Prevent form submission on Enter in toolbar
        this.toolbar.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
            }
        });
    }

    updateContent() {
        this.element.value = this.contentArea.innerHTML;
        this.updatePlaceholder();
    }

    updatePlaceholder() {
        if (this.contentArea.textContent.trim() === "") {
            this.contentArea.classList.add("empty");
        } else {
            this.contentArea.classList.remove("empty");
        }
    }

    loadContent() {
        if (this.element.value) {
            this.contentArea.innerHTML = this.element.value;
        }
        this.updatePlaceholder();
    }

    getContent() {
        return this.contentArea.innerHTML;
    }

    setContent(content) {
        this.contentArea.innerHTML = content;
        this.updateContent();
    }
}

// Auto-initialize editors
document.addEventListener("DOMContentLoaded", function () {
    // Initialize editors for elements with data-simple-editor attribute
    document.querySelectorAll("[data-simple-editor]").forEach((element) => {
        const options = {};
        if (element.dataset.height) options.height = element.dataset.height;
        if (element.dataset.placeholder)
            options.placeholder = element.dataset.placeholder;

        new SimpleEditor(`#${element.id}`, options);
    });
});
