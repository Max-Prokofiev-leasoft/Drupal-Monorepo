# Оголошення змінних
SRC_DIR := $(shell find . -type d)
CHANGED_FILES := $(shell git diff --name-only)

# Оголошення правила для детекції змін
detect_changes:
	@for dir in $(SRC_DIR); do \
        changed_files=$$(git diff --name-only $$dir); \
        if [ -n "$$changed_files" ]; then \
            echo "Зміни виявлені в папці $$dir:"; \
            echo "$$changed_files"; \
        fi \
    done

# Оголошення основного завдання
detective: detect_changes
	@echo "Детектив завершив роботу."

# Правило для перевірки коду на оптимізацію
lint:
	@echo "Ваш код тут буде перевірений на оптимізацію."

# Основне завдання для оптимізації
optimize: lint
	@echo "Код оптимізовано."

# Завдання за замовчуванням
.DEFAULT_GOAL := detective
