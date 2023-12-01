# Оголошення змінних
SRC_DIR := $(shell find . -type d)
CHANGED_FILES := $(shell git diff --name-only)

# Оголошення правила для детекції змін
detect_changes:
	@for file in $(CHANGED_FILES); do \
        dir=$$(dirname $$file); \
        while [ "$$dir" != "." ]; do \
            makefile_merge=$$dir/script/merge/makefile; \
            makefile_release=$$dir/script/release/makefile; \
            if [ -f $$makefile_merge ]; then \
                echo "Зміни виявлені в папці $$dir (merge):"; \
                make -C $$dir/script/merge -f makefile; \
            fi; \
            if [ -f $$makefile_release ]; then \
                echo "Зміни виявлені в папці $$dir (release):"; \
                make -C $$dir/script/release -f makefile; \
            fi; \
            if [ "$$dir" = "core" ]; then \
                banks=$$(find . -maxdepth 1 -type d -not -name "core"); \
                for bank in $$banks; do \
                    makefile_bank_merge=$$bank/script/merge/makefile; \
                    if [ -f $$makefile_bank_merge ]; then \
                        echo "Зміни виявлені в папці $$bank (merge):"; \
                        make -C $$bank/script/merge -f makefile; \
                    fi; \
                    makefile_bank_release=$$bank/script/release/makefile; \
                    if [ -f $$makefile_bank_release ]; then \
                        echo "Зміни виявлені в папці $$bank (release):"; \
                        make -C $$bank/script/release -f makefile; \
                    fi; \
                done \
            fi; \
            dir=$$(dirname $$dir); \
        done \
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
