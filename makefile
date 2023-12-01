# Оголошення змінних
SRC_DIR := $(shell find . -type d)
CHANGED_FILES := $(shell git diff --name-only)

detect_changes:
	@for file in $(CHANGED_FILES); do \
        dir=$$(dirname $$file); \
        while [ "$$dir" != "." ]; do \
            makefile_merge=$$dir/script/merge/makefile; \
            makefile_release=$$dir/script/release/makefile; \
            if [ -f $$makefile_merge ]; then \
                echo "Сhange detected in $$dir (merge):"; \
                make -C $$dir/script/merge -f makefile; \
            fi; \
            if [ -f $$makefile_release ]; then \
                echo "Сhange detected in $$dir (release):"; \
                make -C $$dir/script/release -f makefile; \
            fi; \
            if [ "$$dir" = "core" ]; then \
                banks=$$(find . -maxdepth 1 -type d -not -name "core"); \
                for bank in $$banks; do \
                    makefile_bank_merge=$$bank/script/merge/makefile; \
                    if [ -f $$makefile_bank_merge ]; then \
                        echo "Change detected in $$bank (merge):"; \
                        make -C $$bank/script/merge -f makefile; \
                    fi; \
                    makefile_bank_release=$$bank/script/release/makefile; \
                    if [ -f $$makefile_bank_release ]; then \
                        echo "Change detected in $$bank (release):"; \
                        make -C $$bank/script/release -f makefile; \
                    fi; \
                done \
            fi; \
            dir=$$(dirname $$dir); \
        done \
    done

detective: detect_changes
	@echo "Finish work"
.DEFAULT_GOAL := detective
