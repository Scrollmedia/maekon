document.addEventListener('filament-tiptap:init', ({ detail: { editor } }) => {
    // Разрешаем расширению Paragraph принимать атрибут class
    editor.extensionManager.extensions.forEach(extension => {
        if (extension.name === 'paragraph') {
            extension.config.addAttributes = function() {
                return {
                    class: {
                        default: null,
                        // Заставляет парсер сохранять класс при переключении режимов
                        parseHTML: element => element.getAttribute('class'),
                        renderHTML: attributes => {
                            if (!attributes.class) return {};
                            return { class: attributes.class };
                        },
                    },
                };
            };
        }
    });
});
